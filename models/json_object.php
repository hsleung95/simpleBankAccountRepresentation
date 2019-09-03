<?php

/**
 *	The base class of the system, using json files as tables to store the data and handling the crud operations
 */
class jsonObject {
	
	//fetch all data from the table
	public static function fetch($table) {
		try {
			$dataStr = file_get_contents("data/".$table);
			$data = json_decode($dataStr);
			if (!$data) {$data = [];}
			return $data;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}
	
	//write received data into the table
	public static function commit($table, $data) {
		try {
			$dataStr = json_encode($data);
			if(file_put_contents("data/".$table, $dataStr)) {
				return 1;
			}
		    else {
				return 0;
			}
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}
	
	//the static function for getting the child class table
	public static function getTable() {
		$selfClass = get_called_class();
		$res = new $selfClass();
		return $res->table;
	}

	//get all data in the table, make it static so that it can be called without an instance of object
	public static function all() {
		return self::fetch(static::getTable());
	}
	
	//get an element by id, make it static so that it can be called without an instance of object
	public static function getById($id) {
		$data = self::all();
		$table = static::getTable();
		foreach($data as $i => $v) {
			if($v->id == $id) {
				$newClass = get_called_class();
				$res = new $newClass($v);
				return $res;
			}
		}
		return false;
	}
	
	//create an instance of the class and write it into the table, make it static so that it can be called without an instance of object
	public static function create($param) {
		$data = self::all();
		$table = static::getTable();
		$obj = new stdClass;
		$obj->id = ($data == []) ? 1 : end($data)->id +1;
			foreach($param as $key => $val) {
				$obj->$key = $val;
			}
		array_push($data, $obj);
		if (self::commit($table, $data) == 1) {
			$newClass = get_called_class();
			$res = new $newClass;
			$res->id = $obj->id;
			foreach($param as $key => $val) {
				$res->$key = $val;
			}
			return $res;
		} else {
			return false;
		}
	}
	
	//update the instance of the class and write it into the table
	public function update($param) {
		$data = self::all();
		$table = $this->getTable();
		foreach($data as $i => $v) {
			if($v->id == $this->id) {
				foreach($param as $key => $val) {
					$data[$i]->$key = $val;
					$this->$key = $val;
				}
				break;
			}
		}
		if (self::commit($table, $data) == 1) {
			return $this;
		} else {
			return false;
		}
	}
	
	//delete the instance of the class and write it into the table
	public function delete() {
		$data = $this->all();
		$table = $this->getTable();
		$newData = [];
		foreach($data as $i => $v) {
			if ($v->id != $this->id) {
				array_push($newData, $v);
			}
		}
		if (self::commit($table, $newData) == 1) {
			return $newData;
		} else {
			return false;
		}
	}}