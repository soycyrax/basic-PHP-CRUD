<?php
$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

if (isset($_POST['save'])) {
	$name = $_POST['name'];
	$location = $_POST['location'];
	$sql = "INSERT INTO data (name, location) VALUES('$name', '$location')";

	if ($mysqli->query($sql)) {
		header("Location:index.php");
		exit;
	}

	echo "Error Occured.";
}

if (isset($_GET['delete']) && $_GET['delete'] !== "") {
	$id = $_GET['id'];
	$sql = "DELETE FROM data WHERE id='$id'";

	if ($mysqli->query($sql)) {
		header("Location:index.php");
		exit;
	}

	echo "Error Occured.";
}

if (isset($_GET['save']) && $_GET['save'] !== "") {
	$id = $_GET['id'];
	$name = $_GET['name'];
	$location = $_GET['location'];
	$sql = "UPDATE data SET name='$name', location='$location' WHERE id='$id'";

	if ($mysqli->query($sql)) {
		header("Location:index.php");
		exit;
	}

	echo "Error Occured.";
}

if (isset($_GET['edit']) && $_GET['edit'] !== "") {
	$id = $_GET['id'];
	$result = $mysqli->query("SELECT * FROM data WHERE id='$id'") or die($mysqli->error);
	$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Record</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		:root {
			--page-bg: #f5f7fb;
			--ink: #182033;
			--muted: #687386;
			--line: #dde4ef;
			--panel: #ffffff;
			--brand: #2563eb;
			--brand-dark: #1d4ed8;
		}

		* {
			box-sizing: border-box;
		}

		body {
			min-height: 100vh;
			margin: 0;
			font-family: 'Inter', Arial, sans-serif;
			background: var(--page-bg);
			color: var(--ink);
		}

		.edit-shell {
			max-width: 620px;
			margin: 0 auto;
			padding: 48px 18px;
		}

		.back-link {
			display: inline-flex;
			align-items: center;
			margin-bottom: 18px;
			color: var(--brand-dark);
			font-weight: 700;
			text-decoration: none;
		}

		.back-link:hover {
			color: var(--brand);
			text-decoration: none;
		}

		.panel {
			background: var(--panel);
			border: 1px solid var(--line);
			border-radius: 8px;
			box-shadow: 0 18px 45px rgba(24, 32, 51, 0.08);
			overflow: hidden;
		}

		.panel-header {
			padding: 22px 24px;
			border-bottom: 1px solid var(--line);
		}

		h1 {
			margin: 0;
			font-size: 26px;
			font-weight: 800;
			letter-spacing: 0;
		}

		.subtitle {
			margin: 6px 0 0;
			color: var(--muted);
			font-size: 14px;
		}

		.form-panel {
			padding: 24px;
		}

		.form-panel label {
			font-size: 13px;
			font-weight: 700;
			color: var(--ink);
		}

		.form-control {
			height: 46px;
			border: 1px solid var(--line);
			border-radius: 7px;
			font-size: 14px;
		}

		.form-control:focus {
			border-color: var(--brand);
			box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
		}

		.actions {
			display: flex;
			gap: 10px;
			margin-top: 22px;
		}

		.btn-primary-clean,
		.btn-secondary-clean {
			border: 0;
			border-radius: 7px;
			font-weight: 700;
			font-size: 14px;
			padding: 12px 16px;
			transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
		}

		.btn-primary-clean {
			background: var(--brand);
			color: #fff;
			flex: 1;
		}

		.btn-secondary-clean {
			background: #eef2f7;
			color: var(--ink);
			text-align: center;
		}

		.btn-primary-clean:hover,
		.btn-secondary-clean:hover {
			transform: translateY(-1px);
			box-shadow: 0 10px 22px rgba(24, 32, 51, 0.12);
			text-decoration: none;
		}

		.btn-primary-clean:hover {
			background: var(--brand-dark);
			color: #fff;
		}
	</style>
</head>
<body>
	<main class="edit-shell">
		<a class="back-link" href="index.php">Back to records</a>
		<section class="panel">
			<div class="panel-header">
				<h1>Edit Record</h1>
				<p class="subtitle">Update the saved name and location details.</p>
			</div>
			<form class="form-panel" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
				<input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($row['name']); ?>" required>
				</div>
				<div class="form-group">
					<label for="location">Location</label>
					<input type="text" id="location" name="location" class="form-control" value="<?php echo htmlspecialchars($row['location']); ?>" required>
				</div>
				<div class="actions">
					<a class="btn-secondary-clean" href="index.php">Cancel</a>
					<button type="submit" name="save" value="save" class="btn-primary-clean">Save Changes</button>
				</div>
			</form>
		</section>
	</main>
</body>
</html>
<?php
}
?>
