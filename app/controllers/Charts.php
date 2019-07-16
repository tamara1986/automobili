<?php 
class Charts extends Controller{
	public function __construct(){
		$this->carModel=$this->model('Car');
		$this->manufacturerModel=$this->model('Manufacturer');
		$this->manufacturerModelModel=$this->model('ManufacturerModel');
	}
	public function index(){
		if ($_SESSION['user']=='admin') {
			$data = [
                'title' => 'Charts1',
            ];
        	$this->view('pages/admin/charts', $data);
		}else{
			$data = [
                'title' => 'Login'
            ];
			$this->view('pages/index', $data);

		}
	}
	public function index2(){
		if ($_SESSION['user']=='admin') {
			$manuf=Manufacturer::getManufacturers();
			$data = [
                'title' => 'Charts2',
                'manuf'=>$manuf
            ];
        	$this->view('pages/admin/charts2', $data);
		}else{
			$data = [
                'title' => 'Login'
            ];
			$this->view('pages/index', $data);

		}
	}
	public function index3(){
		if ($_SESSION['user']=='admin') {
			$manuf=Manufacturer::getManufacturers();
			$data = [
                'title' => 'Charts2',
                'manuf'=>$manuf
            ];
        	$this->view('pages/admin/charts3', $data);
		}else{
			$data = [
                'title' => 'Login'
            ];
			$this->view('pages/index', $data);

		}
	}
	public function getDataForFirstCharts(){
		if ($_SESSION['user']=='admin') {
			$data = [
                'title' => 'Charts',
            ];
        	if ($_GET['insurance_form']==1) {
        		$cars=Car::numberOfCarsByManufacturer();
        		 echo json_encode($cars);
        	}
		}else{
			$data = [
                'title' => 'Login'
            ];
			$this->view('pages/index', $data);

		}
	}
	public function getDataSecondCharts(){
		if ($_SESSION['user']=='admin') {
			
        	if ($_POST['insurance_form']==1) {
        		$date1=$_POST['form_data']['date1'];
        		$date2=$_POST['form_data']['date2'];
        		$id_manufacturer=$_POST['form_data']['manufacturer'];
        		$cars=Car::yearAndPriceCars($date1,$date2,$id_manufacturer);
        		 echo json_encode($cars);
        	}
		}else{
			$data = [
                'title' => 'Login'
            ];
			$this->view('pages/index', $data);

		}
	}
	public function getDataThirdCharts(){
		if ($_SESSION['user']=='admin') {
			
        	if ($_POST['insurance_form']==1) {
        		$date1=$_POST['form_data']['date1'];
        		$date2=$_POST['form_data']['date2'];
        		$km=$_POST['form_data']['km'];
        		$km2=$_POST['form_data']['km2'];
        		$rez=Car::kmChart($date1,$date2,$km,$km2);
        		 echo json_encode($rez);
        	}
		}else{
			$data = [
                'title' => 'Login'
            ];
			$this->view('pages/index', $data);

		}
	}
}