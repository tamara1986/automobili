<?php 
class Manufacturer extends DB{
	public static function getManufacturers(){
		$sql = "select * from manufacturers";
		$req=self::executeSQL($sql);
		$rez = $req->fetch_all(MYSQLI_ASSOC);
		return $rez;
	}
	public static function storeManufacturers($manufacturer){
		$sql="INSERT INTO manufacturers VALUES (null,'".$manufacturer."')";
		$req=self::executeSQL($sql);
		return true;
	}
	public static function editManufacturers($id,$title){
		$sql="UPDATE manufacturers SET manufacturer='".$title."' WHERE id=".$id;
		$req=self::executeSQL($sql);
		return true;
	}
	public static function deleteManufacturers($id){
		$sql="SELECT manufacturer_models.id FROM manufacturer_models WHERE id_manufacturer=$id";
		$req=self::executeSQL($sql);
		$rez = $req->fetch_all(MYSQLI_ASSOC);
		
		
		foreach ($rez as $key => $value) {
			$sql="SELECT cars.id FROM cars WHERE id_manufacturer_models=".$value['id'];
			$req=self::executeSQL($sql);
			$rezz = $req->fetch_all(MYSQLI_ASSOC);

			foreach ($rezz as $key => $value) {
				$sql="DELETE from pictures where id_cars=".$value['id'];
				$reqq=self::executeSQL($sql);
				$sql="DELETE from cars where id=".$value['id'];
				$reqq=self::executeSQL($sql);
			}

		}
		foreach ($rez as $key => $value) {
			$sql="DELETE from manufacturer_models where id=".$value['id'];
			$req=self::executeSQL($sql);
		}
		

		$sql="DELETE FROM manufacturers WHERE id=$id";
		$req=self::executeSQL($sql);
		
	}
}