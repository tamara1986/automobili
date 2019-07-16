<?php

class DB{
	private static $conn;
	private static $instance;
	private static function getInstance(){
		if(!isset(self::$conn)){
			self::$instance = new self;
		}
		return self::$conn;
	}
	public function __construct(){
		self::$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		self::$conn->set_charset('utf8');
		
	}
	protected static function executeSQL($sql) {
		$db = self::getInstance();
		$req = $db->query($sql);
		return $req;
	}
}