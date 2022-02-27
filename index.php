<?php include('action.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
	<!-- <script>
	  window.OneSignal = window.OneSignal || [];
	  OneSignal.push(function() {
	    OneSignal.init({
	      appId: "07c5cf47-2a14-4f53-8295-6bf295e4b6de",
	    });
	  });
	</script> -->
</head>
<body>

		<div class="container">
			<div class="row">
				<div class="col-md-6">
					  <h2>Store Medicine</h2>
					  <div class="panel panel-primary">
					    <div class="panel-heading">Add Medicines</div>
					    <div class="panel-body">
					      <div style="margin-bottom: 10px;">
					      	<?php 
					      		if (isset($_GET['msg'])) { $message = $_GET['msg']; ?>			
					      		<div class="alert alert-success"><?= $message; ?></div>
					      		<?php }
					      	 ?>
					            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
					            	<label for="">Title</label>
					            	<input type="text" name="title" class="form-control" placeholder="Add Medicine">
					            	<label for="">Quantity</label>
					            	<input type="number" max="10" class="form-control" name="quantity">
					            	<input type="submit" name="submit" style="margin-top: 10px;width: 100%;" value="Add" class="btn btn-success">
					            </form>
					       </div>
					    </div>
					    <div class="panel-footer">Pharma House</div>
					  </div>

					  <?php if (isset($_GET['update'])): ?>
			  		<div class="panel panel-primary">
					    <div class="panel-heading">Edit Medicines</div>
					    <div class="panel-body">
					      <div style="margin-bottom: 10px;">
					      	<?php 
					      		if (isset($_GET['msg'])) { $message = $_GET['msg']; ?>			
					      		<div class="alert alert-success"><?= $message; ?></div>
					      		<?php }
					      	 ?>
					      	 <?php 

					           	$id = $_GET['id'] ?? null;
					           	// $update = $_GET['update'] ?? null;
					           	$where = [
					           		'id' => $id
					           	];
					           	$row = $obj->select_record('products',$where);

					      	  ?>
					            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
					            	<label for="">Title</label>
					            	<input type="hidden" value="<?php echo $row['id']; ?>" name="id">
					            	<input type="text" name="title" value="<?php echo $row['title']; ?>" class="form-control" placeholder="Add Medicine">
					            	<label for="">Quantity</label>
					            	<input type="number" max="10" class="form-control" value="<?php echo $row['quantity']; ?>" name="quantity">
					            	<input type="submit" name="edit" style="margin-top: 10px;width: 100%;" value="Edit" class="btn btn-success">
					            </form>
					       </div>
					    </div>
					    <div class="panel-footer">Pharma House</div>
					  </div>
			  		<?php endif ?>

				  </div>

				  <div class="col-md-6">
					  <h2>Store Medicine</h2>
					  <div class="panel panel-primary">
					    <div class="panel-heading">View Medicines</div>
					    <div class="panel-body">
					      <div style="margin-bottom: 10px;">
					           <table class="table table-hover">
					          
					           		<tr>
					           			<th>S.No</th>
					           			<th>Product Name</th>
					           			<th>Quantity</th>
					           			<th>Edit</th>
					           			<th>Delete</th>
					           		</tr>
					           		<?php $product_rows = $obj->fetch_records_by_table('products');
					           		foreach ($product_rows as $row): ?>					
					           		<tr>
					           			<td><?php echo $row['id']; ?></td>
					           			<td><?php echo $row['title']; ?></td>
					           			<td><?php echo $row['quantity']; ?></td>
					           			<td><a href="index.php?update=1&id=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a></td>
					           			<td><a href="index.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
					           		</tr>
					           		<?php endforeach ?>
					           </table>
					       </div>
					    </div>
					    <div class="panel-footer">Pharma House</div>
					  </div>
				  </div>
			  </div>
			  <?php 
			  $delete_id = $_GET['delete_id'] ?? null;
			  if ($obj->delete_by_id('products',$delete_id)) {
			  		header('location:index.php?msg="Delete Record Succesfully!"');
			  }
			  ?>

			  <!-- <div class="row">
			  	<div class="col-md-6">
			  		
			  	</div>
			  </div> -->
		</div>





</body>
</html>