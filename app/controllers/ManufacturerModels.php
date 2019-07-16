<?php
class ManufacturerModels extends Controller{
	public function __construct(){
		$this->manufacturerModelModel=$this->model('ManufacturerModel');
		$this->manufacturerModel=$this->model('Manufacturer');
	}
	public function index(){
		if ($_SESSION['user']=='admin') {
			$manufacturer_models=ManufacturerModel::getManufacturerModel();
			$manufacturer=Manufacturer::getManufacturers();
			
			$data = [
                'title' => 'Manufacturer models',
                'models'=>$manufacturer_models,
                'manufacturer'=>$manufacturer,
            ];
        	$this->view('pages/admin/manufacturer_models', $data);
		}else{
			$data = [
                'title' => 'Login'
            ];
			$this->view('pages/index', $data);

		}
	}

	public function update(){
		if ($_SESSION['user']=='admin') {
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['insurance_form'] == 1){
                if(isset($_POST['form_data'])){
                	$id_manufacturer=$_POST['form_data']['id_manufacturer'];
                	$id_model=$_POST['form_data']['id_model'];
                	$model=$_POST['form_data']['model'];

					$manufacturers=ManufacturerModel::updateManufacturers($id_manufacturer,$id_model,$model);
		            echo json_encode(true);
		        	
        		}
    		}
		}else{
			$data = [
                'title' => 'Login'
            ];
			$this->view('pages/index', $data);

		}
	}
	public function delete(){
		if ($_SESSION['user']=='admin') {
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['insurance_form'] == 1){
                if(isset($_POST['form_data'])){
                	$id=$_POST['form_data'];

					$manufacturers=ManufacturerModel::deleteModel($id);
		            echo json_encode($manufacturers);
		        	
        		}
    		}
		}else{
			$data = [
                'title' => 'Login'
            ];
			$this->view('pages/index', $data);

		}
	}
	public function store(){
		if ($_SESSION['user']=='admin') {
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['insurance_form'] == 1){
                if(isset($_POST['form_data'])){
                	$id_manufacturer=$_POST['form_data']['id_manufacturer'];
                	$model=$_POST['form_data']['model'];

					$manufacturers=ManufacturerModel::storeModel($id_manufacturer,$model);
		            echo json_encode($manufacturers);
		        	
        		}
    		}
		}else{
			$data = [
                'title' => 'Login'
            ];
			$this->view('pages/index', $data);

		}
	}
	public function getModelsManufacturer(){
			if ($_SESSION['user']=='admin') {
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['insurance_form'] == 1){
                if(isset($_POST['form_data'])){
                	$id_manufacturer=$_POST['form_data'];

					$models=ManufacturerModel::getModelsManufacturer($id_manufacturer);
		            echo json_encode($models);
		        	
        		}
    		}
		}else{
			$data = [
                'title' => 'Login'
            ];
			$this->view('pages/index', $data);

		}
	}


}