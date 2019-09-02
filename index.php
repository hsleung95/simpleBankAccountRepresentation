<?php
	require "models/person.php";
	
	print_r(Person::all());
	echo "<br>";
	$tom = Person::create(["name" => "Tom"]);
	print_r(Person::all());
	echo "<br>";
	$tom = Person::getById($tom->id);
	print_r($tom);
	echo "<br>";
	$tina = $tom->update(["name" => "Tina"]);
	print_r(Person::all());
	echo "<br>";
	$tina->delete();
	print_r(Person::all());
	echo "<br>";
