<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Assurance.php';

class AssuranceController extends Controller {
    private $model;

    public function __construct(){
        $this->model = new Assurance();
    }

    public function index(){
        $assurances = $this->model->all();
        $this->render('assurances/index', ['assurances'=>$assurances]);
    }

    public function create(){
       $types_assurance = $this->model->getTypes();
        $this->render('assurances/create', ['types_assurance'=>$types_assurance]);

    }

    public function store(){
        if($_POST){
            $this->model->create($_POST);
            header("Location: /assurances");
        }
    }

    public function edit($id){
        $assurance = $this->model->find($id);
        $this->render('assurances/edit', ['assurance'=>$assurance]);
    }

    public function update($id){
        if($_POST){
            $this->model->update($id, $_POST);
            header("Location: /assurances");
        }
    }

    public function delete($id){
        $this->model->delete($id);
        header("Location: /assurances");
    }
}
