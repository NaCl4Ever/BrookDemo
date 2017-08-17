<?php
App::uses('JsBaseEngineHelper', 'View/Helper');

class ProjectsController extends AppController {
    public $helpers = array('Html', 'Form');
    public $components = array('RequestHandler');
    
    public function index() {
        $this->log("I shouldn't be here...");
        $this->set('projects', $this->Project->find('all'));
    }
    public function create() {
        $this->loadModel('Category');
        $this->set('categories', $this->Category->find('all'));
    }
    public function add() {
        $formatted = $this->request->data['Project'];
        $this->log($this->request->data);
        $this->log($this->request->data['Files']);
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
        
        $this->Project->save($formatted);
        $this->layout = null ;
        $this->autoRender = false;
        return json_encode($this->Project->find('all'));
        
        
    }
    public function attachimages() {
        $uploads_dir = '/uploads';
        $this->log(print_r($_FILES,true));
        foreach ($_FILES as $key => $value) {
            $this->log($key);
            $this->log(print_r($value,true));
        }
        $this->layout = null ;
        $this->autoRender = false;
    }
}
?>