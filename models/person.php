<?php

	/**
	 *  Person class which contains the name attribute only
	 */
	class Person extends jsonObject {
		
		public $id;
		public $name;
		protected $table = "people.json";
		
		//constructor, if argument is passed (fetch from table), create a new instance for it
		public function __construct($params = []) {
			if ($params != []) {
				$this->id = $params->id;
				$this->name = $params->name;
			}
		}
	}