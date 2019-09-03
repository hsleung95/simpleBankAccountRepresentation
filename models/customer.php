<?php

	/**
	 *  Customer class which contains the bank attribute
	 *	Customer belongs to a person so it contains the foreign key person_id
	 */
	class Customer extends jsonObject {
		
		public $id;
		public $bank;
		public $person_id;
		protected $table = "customers.json";
		
		//constructor, if argument is passed (fetch from table), create a new instance for it
		public function __construct($params = []) {
			if ($params != []) {
				$this->id = $params->id;
				$this->bank = $params->bank;
				$this->person_id = $params->person_id;
			}
		}
		
		/**
		 *	function for getting related person
		 *	return the person instance or null if cannot find the related person
		 */
		public function person() {
			if (!$this->person_id) {
				return null;
			}
			return Person::getById($this->person_id);
		}
	}