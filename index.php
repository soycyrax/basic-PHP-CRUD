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

	<?php 
		$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
		$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
		//pre_r($result);
	?>

		<div class="row justify-content-center" style="background-color:powderblue">
			<table class="table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Location</th>
						<th colspan="2">Action</th>
					</tr>
				</thead>
		<?php
			while ($row = $result->fetch_assoc()): ?>	
				<tr>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['location']; ?></td>
					<td><form action="process.php" method="GET"><input type="hidden" name="id" value="<?php echo $row['id']; ?>"><input type="submit" name="delete" value="delete"><input type="submit" name="edit" value="edit"></form></td>
				</tr>
			
			<?php endwhile; ?>
			</table>
		</div>
		<?php 
		function pre_r( $array ){
			echo '<pre>';
			print_r($array);
			echo '</pre>';
		}
		?>
	<div class="row justify-content-center">
	<form action="process.php" method="POST">
		<div class="info">
		<label>Name</label>
		<input type="text" name="name" class="form-control" placeholder="Enter you Name"><br>
		<label>Location</label>
		<input type="text" name="location" class="form-control" placeholder="Enter your Location">
		</div>
		<div class="form-group">
		<center>
		<button type="submit" name="save" class="btn btn-dark">Save</button>
		</div>
	</center>
	</form>
	</div>
	</div>
	</div>
</body>
</html>
