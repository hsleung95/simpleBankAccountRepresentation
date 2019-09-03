<?php

	/**
	 *  Transaction class keeps the transaction between two accounts, the amount and the timestamp
	 *	Transaction class belongs to two account class, so it has two foreign key from and to representing id of the accounts
	 */
	class Transaction extends jsonObject {
		
		public $id;
		public $from;
		public $to;
		public $amount;
		public $timestamp;
		protected $table = "transactions.json";
		
		//constructor, if argument is passed (fetch from table), create a new instance for it
		public function __construct($params = []) {
			if ($params != []) {
				$this->id = $params->id;
				$this->from = $params->from;
				$this->to = $params->to;
				$this->timestamp = $params->timestamp;
				$this->amount = $params->amount;
			}
		}
	}