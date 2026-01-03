<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/TypeAssurance.php';

class TypeAssuranceController extends Controller {
    private $model;

    public function __construct(){
        $this->model = new TypeAssurance();
    }

    public function index(){
        $types = $this->model->all();
        $this->render('type_assurance/index', ['types'=>$types]);
    }

    public function create(){
        $this->render('type_assurance/create');
    }

    public function store(){
        if($_POST){
            $this->model->create($_POST);
            header("Location: /type_assurance");
        }
    }

    public function edit($id){
        $type = $this->model->find($id);
        $this->render('type_assurance/edit', ['type'=>$type]);
    }

    public function update($id){
        if($_POST){
            $this->model->update($id, $_POST);
            header("Location: /type_assurance");
        }
    }

    public function delete($id){
        $this->model->delete($id);
        header("Location: /type_assurance");
    }
}
?>
