<?php
	require_once("models/transaction.php");
	
	/**
	 *  Account class which contains the amount attribute
	 *	Account class belongs to a customer so it contains a foreign key customer_id
	 */

	class Account extends jsonObject {
		
		public $id;
		public $customer_id;
		public $amount;
		protected $table = "accounts.json";
		
		//constructor, if argument is passed (fetch from table), create a new instance for it
		public function __construct($params = []) {
			if ($params != []) {
				$this->id = $params->id;
				$this->customer_id = $params->customer_id;
				$this->amount = $params->amount;
			} else {
				$this->amount = 0;
			}
		}
		
		/**
		 *	function for getting related customer
		 *	return the customer instance or null if cannot find the related customer
		 */
		public function customer() {
			if (!$this->customer_id) {
				return null;
			}
			return Customer::getById($this->customer_id);
		}
		
		/**
		 *	function for creating new transaction, using static so that it can be called from the class directly
		 *	@param Account $from, Account $to, number $amount
		 *	return Transaction instance or false if invalid param
		 */
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