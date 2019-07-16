<?php
class Cars extends Controller{
	public function __construct(){
		$this->carModel=$this->model('Car');
		$this->manufacturerModel=$this->model('Manufacturer');
		$this->manufacturerModelModel=$this->model('ManufacturerModel');
	}
	public function index(){
		if ($_SESSION['user']=='admin') {
			$manufacturer=Manufacturer::getManufacturers();
			$color=Car::getColors();
			$data = [
                'title' => 'Cars',
                'manufacturer'=>$manufacturer,
                'color'=>$color,
            ];
        	$this->view('pages/admin/cars', $data);
		}else{
			$data = [
                'title' => 'Login'
            ];
			$this->view('pages/index', $data);

		}
	}
	public function store(){
		if ($_SESSION['user']=='admin') {
			if(isset($_POST['manufSelect']) && isset($_POST['colorSelect']) && isset($_POST['yearSelect']) && isset($_POST['price'])&& isset($_POST['kmSelect']) && isset($_POST['state']) ){

				$post=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$manufSelect=$post['manufSelect'];
				$modelSelect=$post['modelSelect'];
				$colorSelect=$post['colorSelect'];
				$yearSelect=$post['yearSelect'];
				$kmSelect=$post['kmSelect'];
				$state=$post['state'];
				$price=$post['price'];
				$picture=$_FILES['picture'];
				$car=Car::insertCar($manufSelect,$modelSelect,$colorSelect,$yearSelect,$kmSelect,$state,$price,$picture);
				$manufacturer=Manufacturer::getManufacturers();
				$color=Car::getColors();
				$data = [
	                'title' => 'Cars',
	                'manufacturer'=>$manufacturer,
	                'color'=>$color,
	                'msg'=>'Car added'
            	];
        		$this->view('pages/admin/cars', $data);
        		
        	}else{
        		$manufacturer=Manufacturer::getManufacturers();
				$color=Car::getColors();
				$data = [
	                'title' => 'Cars',
	                'manufacturer'=>$manufacturer,
	                'color'=>$color,
	                'msgErr'=>'You must fill in all fields'
            	];
        		$this->view('pages/admin/cars', $data);
        	}
			
		}else{
			$data = [
                'title' => 'Login'
            ];
			$this->view('pages/index', $data);

		}
	}
	

}