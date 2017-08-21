<?php
App::uses('JsBaseEngineHelper', 'View/Helper');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
class ProjectsController extends AppController {
    public $helpers = array('Html', 'Form');
    public $components = array('RequestHandler');
    
    public function index() {
        // $this->set('projects', $this->Project->find('all'));
        $this->loadModel('Category');
        $categories = $this->Category->query("Select cate.id, cate.description, count(proj.id) as count from categories as cate LEFT OUTER JOIN projects as proj on  proj.category_id = cate.id GROUP BY cate.id, cate.description");
        $this->set('categories', $categories);

    }
    public function create() {
        $this->loadModel('Category');
        $this->set('categories', $this->Category->find('all'));
    }
    public function add() {
        $formatted = $this->request->data['Project'];
        // $this->log($this->request->data);
        // $this->log($this->request->data['Files']);
        $this->loadModel('Category');
        $category = $this->Category->find('first', array(
            'conditions' => array('Category.description' => trim($formatted['category_id']))
        ));
        // Simple check to see if category exists if not, we create it and then convert and store it in the project record
        if(!empty($category)){
            $formatted['category_id'] = $category['Category']['id'];
        }
        else {
            $category = $this->Category->save(array('description' => $formatted['category_id']))['Category'];
            $formatted['category_id'] = $category['id'];
        }
        
        $project = $this->Project->save($formatted)['Project'];
        $this->log($project);
        $this->layout = null ;
        $this->set('data', $project);
        $this->render('test');
        
        
    }
    public function attachimages() {
        $project_id = $this->params['url']['project_id'];
        $this->loadModel('ProjectImage');
        $status = array();
        $error = array();
        if (!file_exists(WWW_ROOT . "media/"."$project_id")) {
            mkdir(WWW_ROOT . "media/"."$project_id", 0777, true);
        }
        foreach ($_FILES as $key => $file) {
            $name = $file['name'];
            $currLocation = $file['tmp_name'];
            if(strpos($file['type'], 'image') !== false)
            {
                
                move_uploaded_file($currLocation, WWW_ROOT . "media/"."$project_id/$name");    
                $this->ProjectImage->create();
                $this->ProjectImage->save(array(
                    'name' => $name,
                    'path' => WWW_ROOT . "media/"."$project_id/$name",
                    'display_picture' => 0,
                    'project_id' => $project_id
                ));
                array_push( $status, "$name written successfully.");
            }
            else {
                array_push( $error, "$name not an image, please send a correct file type"); 
            }
            if($file['size']/1000000 > 2)
            {
                $this->log('This image is too large!');
                array_push( $error, "$name is oversized, please attemp cropping the image and reuploading."); 
            }
        }
        $this->layout = null ;
        $data = array(
            'status' => $status,
            'error' => $error
        );
        $this->set('data', $data);
        $this->render('test');
    }
    public function show($categoryId = null, $projectId = null) {
        $this->loadModel('Category');
        $this->loadModel('ProjectImage');
        //Load category
        $category = $this->Category->find('first', array(
            'conditions' => array('Category.id' => $categoryId)
        ))['Category']['description'];
        //Load project name if the project id is set
        $projectName =  !empty($this->Project->find('first', array(
            'conditions' => array('Project.id' => $projectId)
        ))) ? $this->Project->find('first', array(
            'conditions' => array('Project.id' => $projectId)
        ))['Project']['name'] : null;
        //Load information we have so far into the page
        $this->set(compact('category', 'projectId', 'projectName', 'categoryId'));

        $this->autorender = null ;
        if($projectId === null){
            $projects  = $this->Project->find('all', array(
                'conditions' => array('Project.category_id' => $categoryId)
            ));
            $this->set('projects', $projects);
            $this->render('category');
        }

        else{
            $images = $this->ProjectImage->find('all', array(
                'conditions' => array('ProjectImage.project_id' => $projectId)
            ));
            $selectedImage = $this->ProjectImage->find('first')['ProjectImage'];
            $this->log($images);
            $project  = $this->Project->find('first', array(
                'conditions' => array('Project.id' => $projectId)
            ));
            
            $this->set(compact('images', 'project', 'selectedImage'));
            $this->render('project');
        }
    }
   
}
?>