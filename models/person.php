<?php
	require "json_object.php";

class Person extends jsonObject {
	
	public $id;
	public $name;
	protected $table = "people.json";
	
	public function __construct($params = []) {
		if ($params != []) {
			$this->id = $params->id;
			$this->name = $params->name;
		}
	}
	
	public static function getTable() {
		$res = new self();
		return $res->table;
	}
}