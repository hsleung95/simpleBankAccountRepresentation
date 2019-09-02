<?php
	class Transaction extends jsonObject {
		
		public $id;
		public $from;
		public $to;
		public $amount;
		public $timestamp;
		protected $table = "transactions.json";
		
		public function __construct($params = []) {
			if ($params != []) {
				$this->id = $params->id;
				$this->from = $params->from;
				$this->to = $params->to;
				$this->timestamp = $params->timestamp;
				$this->amount = $params->amount;
			}
		}
		
		public static function getTable() {
			$res = new self();
			return $res->table;
		}
	}