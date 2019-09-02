<?php
	class Customer extends jsonObject {
		
		public $id;
		public $bank;
		public $person_id;
		protected $table = "customers.json";
		
		public function __construct($params = []) {
			if ($params != []) {
				$this->id = $params->id;
				$this->bank = $params->bank;
				$this->person_id = $params->person_id;
			}
		}
		
		public static function getTable() {
			$res = new self();
			return $res->table;
		}
		
		public function person() {
			if (!$this->person_id) {
				return null;
			}
			return Person::getById($this->person_id);
		}
	}