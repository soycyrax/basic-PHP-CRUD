<?php 
$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));	
if(isset($_POST['save'])){
	print_r($_POST);
	$name = $_POST['name'];
	$location = $_POST['location'];
	$sql="INSERT INTO data (name, location) VALUES('$name', '$location')";
	if($mysqli->query($sql))
	{
		// echo "Record Submitted Successfully.";
		header("Location:index.php");
	}
	else{
		echo "Error Occured.";
		//create error page
	}
}
if(isset($_GET['edit']) && $_GET['edit'] !== ""){
	$id = $_GET['id'];
	?>
	<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<style>
	.info {
 	 background-color: #e0e0d1;
 	 border-radius: 15px;
 	 color: white;
 	 margin: 20px;
	 padding: 20px;
	}
	</style>
</head>
<body>
	<div class="container">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
		<div class="info">
		<?php
		$result = $mysqli->query("SELECT * FROM data where id='$id'") or die($mysqli->error);
			while ($row = $result->fetch_assoc()): ?>	
				<label>Name</label>
					<input type="hidden" name="id" class="form-control" value="<?php echo $row['id']; ?>"><br></td>
					<input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>"><br></td>
				<label>Location</label>
					<input type="text" name="location" class="form-control" value="<?php echo $row['location']; ?>">
			<?php endwhile; ?>
		<div class="form-group">
		<center>
			<button type="submit" name="save" value="save" class="btn btn-dark">Save</button>
		</center>
		</div>
	</div>
	</form>
	</div>
</body>
</html>

<?php
}
if(isset($_GET['delete']) && $_GET['delete'] !== "")
{
	$id = $_GET['id'];
	$sql="DELETE FROM data WHERE id='$id'";
	if($mysqli->query($sql))
	{
	// echo "Record Deleted Successfully.";
	header("Location:index.php");
	}
	else{
	echo "Error Occured.";
	// 	//create error page
	}
}

if(isset($_GET['save']) && $_GET['save'] !== "")
	{
	$id = $_GET['id'];
	$name = $_GET['name'];
	$location = $_GET['location'];
	$sql="UPDATE data SET name='$name', location='$location' WHERE id='$id'";
		
	if($mysqli->query($sql))
	{
	echo "Record Updated Successfully.";
	header("Location:index.php");
	}
	else{
	echo "Error Occured.";
	// 	//create error page
	}
	}