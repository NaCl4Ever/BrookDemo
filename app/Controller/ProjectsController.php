<?php
App::uses('JsBaseEngineHelper', 'View/Helper');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
class ProjectsController extends AppController {
    public $helpers = array('Html', 'Form');
    public $components = array('RequestHandler');
    
    public function index() {
        $this->set('projects', $this->Project->find('all'));
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
                    'display_picture' => 0
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
    public function show($category = null, $projectId = null) {
        $this->log($category);
        $this->log($projectId);
        $projectName =  $projectId !== null ? $this->Project->find('first', array(
            'conditions' => array('Project.id' => $projectId)
        ))['Project']['name'] : null;
        $this->set(compact('category', 'projectId', 'projectName'));
        
        $this->autorender = null ;
    }
}
?>