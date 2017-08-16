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
    public function show() {
        $this->log($this->request->data);
        $this->Project->save($this->request->data);
        $this->layout = null ;
        $this->autoRender = false;
        return json_encode($this->Project->find('all'));
        
        
    }
}
?>