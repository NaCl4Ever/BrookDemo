<?php
App::uses('JsBaseEngineHelper', 'View/Helper');

class CategoriesController extends AppController {
    public $helpers = array('Html', 'Form');
    public $components = array('RequestHandler');
    
    public function index() {
        $this->log("I shouldn't be here...");
        $this->set('projects', $this->Category->find('all'));
    }
    
}
?>