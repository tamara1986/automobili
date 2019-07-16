<?php 
class User extends Controller{
	public function __construct(){
		$this->carModel=$this->model('Car');
		$this->manufacturerModel=$this->model('Manufacturer');
		$this->manufacturerModelModel=$this->model('ManufacturerModel');
	}
	public function index(){
		if ($_SESSION['user']=='user') {
			$cars=Car::getAllCars();
			$data = [
                'title' => 'Home',
                'cars' => $cars,
            ];

        	$this->view('pages/users', $data);
		}else{
			$data = [
                'title' => 'Login'
            ];
			$this->view('pages/index', $data);

		}
		
	}
}