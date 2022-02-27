<?php 

require('config/Database.php');

/**
 * 
 */
class CrudOperation extends Database
{
	public function insert($table,$fields)
	{		
		$sql = "";
		$sql .= "INSERT INTO $table";
		$sql .= "(".implode(',', array_keys($fields)).") VALUES";
		$sql .= "('".implode("','", array_values($fields))."')";
		
		$insert_query = mysqli_query($this->connection,$sql);
		if ($insert_query) {
			return true;
		}

	}

	public function fetch_records_by_table($table)
	{
		$sql = "SELECT * FROM ".$table;
		$array = array();
		$query = mysqli_query($this->connection,$sql);
		while ($row = mysqli_fetch_assoc($query)) {
			$array[] = $row;
		}
		return $array;
	}

	public function select_record($table,$where)
	{
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			$condition .= $key."='".$value."' AND ";
		}
		$condition = substr($condition, 0,-5);
		$sql .= "SELECT * FROM ".$table." WHERE ".$condition;
		$result = mysqli_query($this->connection,$sql);
		$row = mysqli_fetch_assoc($result);
		return $row;
	}

	public function update_record($table,$values,$where)
	{
		$sql = "";
		$condition = "";
		$whereCondition = "";
		foreach ($values as $key => $value) {
			$condition .= $key."='".$value."', ";
		}
		$condition = substr($condition,0,-2);

		foreach ($where as $key => $value) {
			$whereCondition = $key."='".$value."' AND ";
		}
		$whereCondition = substr($whereCondition,0,-5);
		$sql = "UPDATE ".$table." SET ";
		$query = $sql.$condition." WHERE ".$whereCondition;
		$query = mysqli_query($this->connection,$query);
		if ($query) {
			return true;
		}
		
	}

	public function delete_by_id($table,$delete_id)
	{
		$sql = "DELETE FROM ".$table." WHERE id =".$delete_id;
		$result = mysqli_query($this->connection,$sql);
		if ($result) {
			return true;
		}
	}

	public function filter_data($field)
	{
		$field = trim($field);
		$field = stripslashes($field);
		$field = htmlspecialchars($field);
		return $field;
	}
}

$obj = new CrudOperation();

if (isset($_POST['submit'])) {

	$fields = [
		'title' => $obj->filter_data($_POST['title']),
		'quantity' => $obj->filter_data($_POST['quantity'])
	];

	if($obj->insert('products',$fields)){
		header('location:index.php?msg="Record Add Succesfully!"');
	}
}

if (isset($_POST['edit'])) {
	$id = $_POST['id'];
	$where = [
		'id' => $id
	];
	$values = [
		'title' => $obj->filter_data($_POST['title']),
		'quantity' => $obj->filter_data($_POST['quantity'])
	];
	// $obj->update_record('products',$values,$where);

	if ($obj->update_record('products',$values,$where)) {
		header('location:index.php?msg="Update Record Successfully!"');
	}
}




?>