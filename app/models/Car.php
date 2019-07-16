<?php 
class Car extends DB{
	public static function getCars(){
		$sql="SELECT * FROM cars";
	}
	public static function getColors(){
		$sql="SELECT * FROM colors";
		$req=self::executeSQL($sql);
		$rez = $req->fetch_all(MYSQLI_ASSOC);
		return $rez;
	}
	public static function insertCar($manufSelect,$modelSelect,$colorSelect,$yearSelect,$kmSelect,$state,$price,$picture){
		
		$sql="INSERT INTO cars VALUES (null,$modelSelect,$yearSelect,CURRENT_TIMESTAMP,$colorSelect,$kmSelect,$state,$price)";
			
		$req=self::executeSQL($sql);

		$lastInsertId=self::lastInsertId();

		if ($picture['name'] !='') {
			$img=$picture;
			$ime_fajla=time().'_'.$img['name'];
			$uploads_dir = $_SERVER['DOCUMENT_ROOT']."/automobili/public/img/cars/".$ime_fajla;
			move_uploaded_file($img['tmp_name'], $uploads_dir);
			$sql="INSERT INTO pictures VALUES (null,'".$ime_fajla."',0,".$lastInsertId.")";
		
			$req = self::executeSQL($sql);
			
		}	
		return true;
	}
	public static function lastInsertId(){
		$sql="SELECT id FROM cars ORDER BY id DESC limit 1";
		$req = self::executeSQL($sql);
		$rez = $req->fetch_assoc();
		$id=intval($rez['id']);
		return $id;
	}
	public static function getAllCars(){
		$sql="SELECT c.id as id,m.manufacturer as manufacturer,mm.model as model,p.pictures as picture,c.price,c.year FROM cars as c
			join manufacturer_models as mm
			on mm.id=c.id_manufacturer_models 
			join manufacturers as m 
			on mm.id_manufacturer=m.id 
			join pictures as p 
			on c.id=p.id_cars ";
		$req = self::executeSQL($sql);
		$rez = $req->fetch_all(MYSQL_ASSOC);
		return $rez;
	}
	public static function numberOfCarsByManufacturer(){
		$sql="SELECT m.manufacturer,count(c.id) as count FROM manufacturers as m
			join manufacturer_models as mm
			on m.id=mm.id_manufacturer 
			join cars as c
			on mm.id=c.id_manufacturer_models
			GROUP BY m.id";
		$req = self::executeSQL($sql);
		$rez = $req->fetch_all(MYSQL_ASSOC);
		$chart1=[['Manufacturer', 'Cars']];
		foreach ($rez as $key => $value) {
			$niz=[$value['manufacturer'],intval($value['count'])];
			array_push($chart1,$niz);
		}

		$sql="SELECT c.color,count(car.id) as count FROM colors as c
			join cars as car
			on c.id=car.id_color
			GROUP BY c.id";
		$req = self::executeSQL($sql);
		$rez2 = $req->fetch_all(MYSQL_ASSOC);
		$chart2=[['Colors', 'Cars']];
		$color=[];
		foreach ($rez2 as $key => $value) {
			$niz=[$value['color'],intval($value['count'])];
			array_push($chart2,$niz);
			array_push($color,$value['color']);
		}
		$chart=[$chart1,$chart2,$color];
		return $chart;
	}
	public static function yearAndPriceCars($date1,$date2,$id_manufacturer){
		$sql="SELECT c.year,avg(c.price) as price FROM cars as c
			join manufacturer_models as m 
			on m.id=c.id_manufacturer_models 
			join manufacturers as man 
			on man.id=m.id_manufacturer 
			WHERE c.year<$date2 and c.year>$date1 and man.id=$id_manufacturer 
			GROUP BY c.year";
		$req = self::executeSQL($sql);
		$rez = $req->fetch_all(MYSQL_ASSOC);
		return $rez;
	}
	public static function kmChart($date1,$date2,$km,$km2){
		$sql="SELECT c.year,avg(c.km) as km FROM cars as c
			WHERE c.year<$date2 and c.year>$date1 and c.km<$km2 and c.km>$km 
			GROUP BY c.year";
		$req = self::executeSQL($sql);
		$rez = $req->fetch_all(MYSQL_ASSOC);
		return $rez;
	}
}