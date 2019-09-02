<?php
	require_once("models/json_object.php");
	require_once("models/person.php");
	require_once("models/customer.php");
	require_once("models/account.php");

	$tom = Person::create(["name" => "Tom"]);
	$customerTom = Customer::create([
		"bank" => "HSBC",
		"person_id" => $tom->id
	]);
	$accountTom = Account::create(["customer_id" => $customerTom->id]);
	$accountTom = $accountTom->update(["amount" => 1000]);
	
	echo "account detail of Tom: <br> name: $tom->name <br> bank: $customerTom->bank <br> amount: $accountTom->amount <br><br>";

	$jerry = Person::create(["name" => "Jerry"]);
	$customerJerry = Customer::create([
		"bank" => "HSBC",
		"person_id" => $jerry->id
	]);
	$accountJerry = Account::create(["customer_id" => $customerJerry->id]);

	echo "account detail of Jerry: <br> name: $jerry->name <br> bank: $customerJerry->bank <br> amount: $accountJerry->amount <br><br>";

	echo "Tom has changed his name to Peter <br><br>";

	$tom = $tom->update(["name" => "Peter"]);

	echo "account detail of Tom: <br> name: $tom->name <br> bank: $customerTom->bank <br> amount: $accountTom->amount <br><br>";
	
	$newTransaction = Account::newTransaction($accountTom, $accountJerry, 100);
	echo "$tom->name is transferring 100 to $jerry->name. <br>";
	echo "account detail of Tom: <br> name: $tom->name <br> bank: $customerTom->bank <br> amount: $accountTom->amount <br><br>";
	echo "account detail of Jerry: <br> name: $jerry->name <br> bank: $customerJerry->bank <br> amount: $accountJerry->amount <br><br>";
	

	$accountTom->delete();
	$customerTom->delete();
	$tom->delete();
	$accountJerry->delete();
	$customerJerry->delete();
	$jerry->delete();
	echo "<br>";
