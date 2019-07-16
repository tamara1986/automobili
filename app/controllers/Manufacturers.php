<?php
class Manufacturers extends Controller{
	public function __construct(){
		$this->manufacturerModel=$this->model('Manufacturer');
	}
	public function index(){
		if ($_SESSION['user']=='admin') {
			$manufacturers=Manufacturer::getManufacturers();
			$data = [
                'title' => 'Manufacturers',
                'manufacturers'=>$manufacturers
            ];
        	$this->view('pages/admin/manufacturers', $data);
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
                	$new=$_POST['form_data'];

					$manufacturers=Manufacturer::storeManufacturers($new);
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
	public function edit(){
		if ($_SESSION['user']=='admin') {
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['insurance_form'] == 1){
                if(isset($_POST['form_data'])){
                	$id=$_POST['form_data']['id'];
                	$title=$_POST['form_data']['title'];

					$manufacturers=Manufacturer::editManufacturers($id,$title);
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
	public function delete(){
		if ($_SESSION['user']=='admin') {
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['insurance_form'] == 1){
                if(isset($_POST['form_data'])){
                	$id=$_POST['form_data'];

					$manufacturers=Manufacturer::deleteManufacturers($id);
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

}