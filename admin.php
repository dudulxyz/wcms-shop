<?php
	session_start();
// 	if (isset($_SESSION))
// {
//     unset($_SESSION);
//     session_unset();
//     session_destroy();
// }

$_SESSION['productList'] = json_decode(file_get_contents("data.js"), true);
	// session_start();
	// var_dump($_SESSION);
	$password = "admin212";
?>

	<?php 
	  print "<h2 align=\"center\">Login To Product Editor</h2>";
	// If password is valid let the user get access
	if (isset($_POST["password"]) && ($_POST["password"]=="$password")) {
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

	<!-- ADMIN PAGE -->
	<div class="container">
		<h1>PRODUCT DISPLAY PAGE</h1>

		<?php
			if(isset($_SESSION['errors'])) {
				foreach($_SESSION['errors'] as $error) {
					echo "<p class='error'>" . $error .  "</p>";
				}
				unset($_SESSION['errors']);
			}

			if(isset($_SESSION['success_message'])) {
				echo "<p class='success'>" . $_SESSION['success_message'] . "</p>";;
				unset($_SESSION['success_message']);
			}
		?>

	<div class="container">
    		<div class="row">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Product List</h3>
					</div>
					<div class="table-responsive"> 
					<table class="table table-hover" id="dev-table">
						<thead>
							<tr>
								<th>Product Name</th>
								<th>Images</th>
								<th>Description</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Total Value</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
		<?php
			$i=0;
			foreach ($_SESSION['productList'] as $product) {
		?>
							<tr><form class="frm-tool" action="process.php" method="post">
								<td><?=$product['productName']?></td>
								<td><?=$product['images']?></td>
								<td><?=$product['description']?></td>
								<td><?=$product['quantity']?></td>
								<td><?='Rp'.number_format($product['price'], 2, '.', ',')?></td>
								<td><?='Rp'.number_format($product['quantity']*$product['price'], 2, '.', ',')?></td>
								
								<td>	
									<input type="hidden" name="id" value="<?=$i?>">
									<input class="btn btn-success btn-xs" type="submit" name="action" value="delete">
									<input class="btn btn-success btn-xs" type="submit" name="action" value="update">
								</td>
								</form>
							</tr>
							</tbody>
		<?php $i++; }?>
						</table>
				</div>
			</div> 
    	</div>
	</div>

<div class="container">
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#AddModal">Add Product</button>
  <!-- Modal -->
  <div class="modal fade" id="AddModal" role="dialog">
		<div class="modal-dialog modal-lg">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Modal Header</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-6">
						<form action="process.php" method="post">
								<h3>Add New Product:</h3>
								<input type="hidden" name="action" value="add">

								<form>
									<div class="form-group">
										<label for="productName">Product Name</label>
										<input type="text" class="form-control" name="productName" placeholder="Name" required>
									</div>
									<div class="form-group">
										<label for="productName">Image Url:</label>
										<input type="text" class="form-control" name="images" placeholder="Image Url" required>
									</div>
									<div class="form-group">
										<label for="productName">Description:</label>
										<input type="text" class="form-control" name="description" placeholder="Description" required>
									</div>
									<div class="form-group">
										<label for="productName">Detail:</label>
										<input type="text" class="form-control" name="detail" placeholder="Detail" required>
									</div>
									<div class="form-group">
										<label for="productName">Quantity:</label>
										<input type="number" class="form-control" name="quantity" placeholder="Quantity" required>
									</div>
									<div class="form-group">
										<label for="productName">Price:</label>
										<input type="number" class="form-control" step="0.01" min=0 name="price" required>
									</div>
									<input class="btn btn-success" type="submit" value="submit">
								</form>
							</div>


							<!--Upload Image -->
							<div class="col-xs-6">
								<div style="max-width: 650px; margin: auto;">
										<p class="lead">Select a PNG or JPEG image, having maximum size <span id="max-size"></span> KB.</p>
									<form id="upload-image-form" action="" method="post" enctype="multipart/form-data">
									  <div id="image-preview-div" style="display: none">
										<label for="exampleInputFile">Selected image:</label><br>
										<img id="preview-img" src="noimage" class="img-responsive" alt="Responsive image">
									  </div>
									  <div class="form-group">
										<input type="file" name="file" id="file" required>
									  </div>
										<button class="btn btn-lg btn-primary" id="upload-button" type="submit" disabled>Upload image</button>
									</form>
									<br>
									<div class="alert alert-info" id="loading" style="display: none;" role="alert">
									  Uploading image...
									<div class="progress">
										<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin=aria-valuemax="100" style="width: 100%"></div>
									</div>
									</div>
									<div id="message"></div>
								</div>
							</div>
				</div>
			</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			  </div>
		</div>
	  </div>
	</div>
</div>
<?php 
	}
	else
	{
	// Wrong password or no password entered display this message
	if (isset($_POST['password']) || $password == "") {
	  print "<p align=\"center\"><font color=\"red\"><b>Incorrect Password</b><br>Please enter the correct password</font></p>";}
	  print "<form method=\"post\"><p align=\"center\">Please enter your password for access<br>";
	  print "<input name=\"password\" type=\"password\" size=\"25\" maxlength=\"10\"><input value=\"Login\" type=\"submit\"></p></form>";
	}
?>
	<!-- END OF ADMIN -->
</body>

	<script src="js/jquery-2.2.4.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/app.js"></script>
	<script src="js/upldimg.js"></script>
</html>