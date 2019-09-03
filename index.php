<?php
	require_once("models/json_object.php");
	require_once("models/person.php");
	require_once("models/customer.php");
	require_once("models/account.php");
	/*
		The index.php is to demonstrate the usage of the classes
	*/

	$tom = Person::create(["name" => "Tom"]);	//create new person tom
	$customerTom = Customer::create([			//create new customer entity for tom
		"bank" => "HSBC",
		"person_id" => $tom->id
	]);
	$accountTom = Account::create(["customer_id" => $customerTom->id]);		//create new account for tom
	$accountTom = $accountTom->update(["amount" => 1000]);					//add 1000 for tom's account
	
	echo "account detail of Tom: <br> name: $tom->name <br> bank: $customerTom->bank <br> amount: $accountTom->amount <br><br>";	//display the result

	$jerry = Person::create(["name" => "Jerry"]);	//create new person jerry
	$customerJerry = Customer::create([				//create new customer entity for jerry
		"bank" => "HSBC",
		"person_id" => $jerry->id
	]);
	$accountJerry = Account::create(["customer_id" => $customerJerry->id]);		//create new account for jerry

	echo "account detail of Jerry: <br> name: $jerry->name <br> bank: $customerJerry->bank <br> amount: $accountJerry->amount <br><br>";	//display the result

	echo "Tom has changed his name to Peter <br><br>";

	$tom = $tom->update(["name" => "Peter"]);		//change tom's name to Peter

	echo "account detail of Tom: <br> name: $tom->name <br> bank: $customerTom->bank <br> amount: $accountTom->amount <br><br>";			//display the result
	
	//create a new transaction that Tom transfer 100 to Jerry's account
	$newTransaction = Account::newTransaction($accountTom, $accountJerry, 100);
	echo "$tom->name is transferring 100 to $jerry->name. <br>";
	echo "account detail of Tom: <br> name: $tom->name <br> bank: $customerTom->bank <br> amount: $accountTom->amount <br><br>";
	echo "account detail of Jerry: <br> name: $jerry->name <br> bank: $customerJerry->bank <br> amount: $accountJerry->amount <br><br>";
	
	//display the result
	
	//clear the records, can remove to keep the records
	$accountTom->delete();
	$customerTom->delete();
	$tom->delete();
	$accountJerry->delete();
	$customerJerry->delete();
	$jerry->delete();
	echo "<br>";
