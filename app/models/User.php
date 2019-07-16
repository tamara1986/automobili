<?php 
class User extends DB{
	public static function validateData($username,$password){
		$sql = "select * from users where username ='".$username."' and password='".$password."'";
		$req=self::executeSQL($sql);
		$rez = $req->fetch_all(MYSQLI_ASSOC);
		return $rez;
	}
}