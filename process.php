<?php
	session_start();

	date_default_timezone_set('Asia/Jakarta');

	$myFile = "data.js";
	$arr_data = array(); // create empty array

	//Get product from existing json file
	$jsondata = file_get_contents($myFile);

	// converts json product into array
	$arr_data = json_decode($jsondata, true);

	if (isset($_POST["action"]) && $_POST["action"] == "add") {
		add_product($_POST);
	} elseif (isset($_POST["action"]) && $_POST["action"] == "delete") {
		delete_product($_POST);
	} elseif (isset($_POST["action"]) && $_POST["action"] == "update") {
		update_product($_POST);
	} elseif (isset($_POST["action"]) && $_POST["action"] == "save") {
		save_product($_POST);
	} else {
		kill_sess();
	}

	update_json();

	function update_json() {
		global $myFile;
		global $arr_data;

		//Convert updated array to JSON
		$jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);

		//write json product into product.json file
		if(file_put_contents($myFile, $jsondata)) {
			// echo 'product successfully saved';
			header('Location: admin.php');
			die();
		}
		else 
			echo "error";
	}

	function add_product($posted) {
		global $arr_data;
		
		//Get form data
		$formdata = array(
			'productName'=> $posted['productName'],
			'images'=> $posted['images'],
			'description'=> $posted['description'],
			'detail'=> $posted['detail'],
			'quantity'=> $posted['quantity'],
			'price'=>$posted['price'],
			'date'=>date_create()
		);

		// Push user data to array
		array_push($arr_data,$formdata);

	}	// END add_product

	function delete_product($posted){
		global $arr_data;
		array_splice($arr_data, $posted['id'], 1);
	}

	function update_product($posted) {
		global $arr_data;
		session_unset();
		$id = $posted['id'];
		$_SESSION['id'] = $id;
		$_SESSION['change'] = $arr_data[$id];
		header('Location: edit.php');
		die();
	}

	function save_product($posted) {
		global $myFile;
		global $arr_data;
		$arr_data[$posted['id']]['productName'] = $posted['productName'];
		$arr_data[$posted['id']]['images'] = $posted['images'];
		$arr_data[$posted['id']]['description'] = $posted['description'];
		$arr_data[$posted['id']]['detail'] = $posted['detail'];
		$arr_data[$posted['id']]['quantity'] = $posted['quantity'];
		$arr_data[$posted['id']]['price'] = $posted['price'];
		$arr_data[$posted['id']][date] = date_create();

		update_json();
		die();
	}

	function kill_sess() {
		session_destroy();
		header('Location: admin.php');
		die();
	}
?>