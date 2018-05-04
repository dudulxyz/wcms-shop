<?php
	session_start();

	// var_dump($_SESSION); 

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>

	<link rel="stylesheet" href="css/bootstrap.min.css">	
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<div class="container">
		<div class="col-xs-6">
		<div class="wrapper-stock">
			<h2>Update Product Info:</h2>
			<form action="process.php" method="post">
				<input type="hidden" name="action" value="save">
				<input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
				<div class="row">
					<div class="form-group">
						<label for="productName">Product Name</label>
						<input type="text" class="form-control" name="productName" placeholder="Name" value="<?= $_SESSION['change']['productName'] ?>" required>
					</div>
					<div class="form-group">
						<label for="productName">Image Url:</label>
						<input type="text" class="form-control" name="images" placeholder="Image Url" value="<?= $_SESSION['change']['images'] ?>" required>
					</div>
					<div class="form-group">
						<label for="productName">Description:</label>
						<input type="text" class="form-control" name="description" placeholder="Description" value="<?= $_SESSION['change']['description'] ?>" required>
					</div>
					<div class="form-group">
						<label for="productName">Detail:</label>
						<input type="text" class="form-control" name="detail" placeholder="Detail" value="<?= $_SESSION['change']['detail'] ?>" required>
					</div>
					<div class="form-group">
						<label for="productName">Quantity:</label>
						<input type="number" class="form-control" name="quantity" placeholder="Quantity" value="<?= $_SESSION['change']['quantity'] ?>" required>
					</div>
					<div class="form-group">
						<label for="productName">Price:</label>
						<input type="number" class="form-control" step="0.01" min=0 name="price" value="<?= $_SESSION['change']['price'] ?>" required>
					</div>
				<div class="row">
					<div class="form-group">
						<div class="tstr col-md-4">
							<input class="btn btn-default" type="submit" value="SAVE">
							<a href="admin.php" class="btn btn-default" role="button">CANCEL</a></br>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	</div>
	
</body>
	<script src="js/jquery-2.2.4.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/app.js"></script>
</html>