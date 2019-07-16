<?php 
class Admin extends Controller{
	public function __construct(){
		$this->manufacturerModel=$this->model('Manufacturer');
	}
	public function index(){
		if ($_SESSION['user']=='admin') {
			$manufacturers=Manufacturer::getManufacturers();
			$data = [
                'title' => 'Home',
                'manufacturers'=>$manufacturers
            ];
        	$this->view('pages/admin/manufacturers', $data);
		}
		elseif ($_SESSION['user']=='user') {
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