<?php 
class ManufacturerModel extends DB{
	public static function getManufacturerModel(){
		$sql="SELECT mf.id as id_manufacturer,mf.manufacturer as manufacturer,mm.id as id_model,mm.model as model_name FROM manufacturer_models as mm
			join manufacturers as mf
			on mm.id_manufacturer=mf.id";
		$req = self::executeSQL($sql);
		$rez = $req->fetch_all(MYSQL_ASSOC);
		return $rez;
	}
	public static function updateManufacturers($id_manufacturer,$id_model,$model){
		$sql="UPDATE manufacturer_models SET model='".$model."', id_manufacturer=$id_manufacturer WHERE id=".$id_model;
		$req=self::executeSQL($sql);
		return true;
	
	}
	public static function deleteModel($id){
		$sql="SELECT cars.id from cars WHERE id_manufacturer_models=$id";
		$req=self::executeSQL($sql);
		$rez = $req->fetch_all(MYSQL_ASSOC);
		foreach ($rez as $key => $value) {
			$sql="DELETE FROM pictures WHERE id_cars=".$value['id'];
			$req=self::executeSQL($sql);
		}
		foreach ($rez as $key => $value) {
			$sql="DELETE FROM cars WHERE id=".$value['id'];
			$req=self::executeSQL($sql);
		}
				
		$sql="DELETE FROM manufacturer_models WHERE id=$id";
		$req=self::executeSQL($sql);
		return true;
	}
	public static function storeModel($id_manufacturer,$model){
		$sql="INSERT INTO manufacturer_models VALUES (null,'".$model."',".$id_manufacturer.")";
		$req=self::executeSQL($sql);
		return true;
	}
	public static function getModelsManufacturer($id){
		$sql="SELECT * FROM manufacturer_models WHERE id_manufacturer=$id";
		$req=self::executeSQL($sql);
		$rez = $req->fetch_all(MYSQL_ASSOC);
		return $rez;
		
	}
}