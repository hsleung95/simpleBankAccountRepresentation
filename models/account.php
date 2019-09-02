<?php
	require_once("models/transaction.php");

	class Account extends jsonObject {
		
		public $id;
		public $customer_id;
		public $amount;
		protected $table = "accounts.json";
		
		public function __construct($params = []) {
			if ($params != []) {
				$this->id = $params->id;
				$this->customer_id = $params->customer_id;
				$this->amount = $params->amount;
			} else {
				$this->amount = 0;
			}
		}
		
		public static function getTable() {
			$res = new self();
			return $res->table;
		}
		
		public function customer() {
			if (!$this->customer_id) {
				return null;
			}
			return Customer::getById($this->customer_id);
		}
		
		public static function newTransaction($from, $to, $amount) {
			if (!$from || !$to || $from->amount < $amount){
				return false;
			}
			$trans = Transaction::create([
				"from" => $from->id,
				"to" => $to->id,
				"amount" => $amount,
				"timestamp" => date('m/d/Y h:i:s', time())
			]);
			$from->update(["amount" => $from->amount-$amount]);
			$to->update(["amount" => $to->amount+$amount]);
			
			return $trans;
		}
	}