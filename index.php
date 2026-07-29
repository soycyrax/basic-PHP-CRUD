<?php
$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
$result = $mysqli->query("SELECT * FROM data ORDER BY id DESC") or die($mysqli->error);
$totalRecords = $result->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>basic-PHP-CRUD</title>
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
			--accent: #0f766e;
			--danger: #dc2626;
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

		.app-shell {
			max-width: 1120px;
			margin: 0 auto;
			padding: 32px 18px 48px;
		}

		.topbar {
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 18px;
			padding: 24px 0 28px;
		}

		.brand-mark {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 44px;
			height: 44px;
			border-radius: 8px;
			background: var(--ink);
			color: #fff;
			font-weight: 800;
		}

		.title-wrap {
			display: flex;
			align-items: center;
			gap: 14px;
		}

		h1 {
			margin: 0;
			font-size: 30px;
			font-weight: 800;
			letter-spacing: 0;
		}

		.subtitle {
			margin: 4px 0 0;
			color: var(--muted);
			font-size: 14px;
		}

		.stat-pill {
			padding: 10px 14px;
			border: 1px solid var(--line);
			border-radius: 8px;
			background: var(--panel);
			color: var(--muted);
			font-size: 14px;
			font-weight: 600;
		}

		.layout-grid {
			display: grid;
			grid-template-columns: minmax(0, 1fr) 340px;
			gap: 22px;
			align-items: start;
		}

		.panel {
			background: var(--panel);
			border: 1px solid var(--line);
			border-radius: 8px;
			box-shadow: 0 18px 45px rgba(24, 32, 51, 0.08);
			overflow: hidden;
		}

		.panel-header {
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 12px;
			padding: 18px 20px;
			border-bottom: 1px solid var(--line);
		}

		.panel-title {
			margin: 0;
			font-size: 16px;
			font-weight: 700;
		}

		.table {
			margin: 0;
		}

		.table thead th {
			border-top: 0;
			border-bottom: 1px solid var(--line);
			background: #f8fafc;
			color: var(--muted);
			font-size: 12px;
			font-weight: 700;
			text-transform: uppercase;
			letter-spacing: 0;
			padding: 14px 20px;
		}

		.table tbody td {
			vertical-align: middle;
			padding: 16px 20px;
			border-top: 1px solid #eef2f7;
			font-size: 15px;
		}

		.name-cell {
			font-weight: 700;
			color: var(--ink);
		}

		.location-cell {
			color: var(--muted);
		}

		.actions-form {
			display: flex;
			gap: 8px;
			justify-content: flex-end;
			margin: 0;
		}

		.btn-soft,
		.btn-primary-clean,
		.btn-danger-clean {
			border: 0;
			border-radius: 7px;
			font-weight: 700;
			font-size: 13px;
			padding: 9px 13px;
			transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
		}

		.btn-soft {
			background: #e8f0ff;
			color: var(--brand-dark);
		}

		.btn-primary-clean {
			width: 100%;
			background: var(--brand);
			color: #fff;
			padding: 12px 16px;
		}

		.btn-danger-clean {
			background: #fee2e2;
			color: var(--danger);
		}

		.btn-soft:hover,
		.btn-primary-clean:hover,
		.btn-danger-clean:hover {
			transform: translateY(-1px);
			box-shadow: 0 10px 22px rgba(24, 32, 51, 0.12);
		}

		.btn-primary-clean:hover {
			background: var(--brand-dark);
			color: #fff;
		}

		.form-panel {
			padding: 20px;
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

		.empty-state {
			padding: 34px 20px;
			text-align: center;
			color: var(--muted);
		}

		@media (max-width: 840px) {
			.topbar {
				align-items: flex-start;
				flex-direction: column;
			}

			.layout-grid {
				grid-template-columns: 1fr;
			}

			.actions-form {
				justify-content: flex-start;
			}
		}
	</style>
</head>
<body>
	<main class="app-shell">
		<header class="topbar">
			<div class="title-wrap">
				<div class="brand-mark">CRUD</div>
				<div>
					<h1>Records Dashboard</h1>
					<p class="subtitle">Manage names and locations from your local MySQL database.</p>
				</div>
			</div>
			<div class="stat-pill"><?php echo $totalRecords; ?> total records</div>
		</header>

		<section class="layout-grid">
			<div class="panel">
				<div class="panel-header">
					<h2 class="panel-title">Saved Records</h2>
				</div>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Name</th>
								<th>Location</th>
								<th class="text-right">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($totalRecords > 0): ?>
								<?php while ($row = $result->fetch_assoc()): ?>
									<tr>
										<td class="name-cell"><?php echo htmlspecialchars($row['name']); ?></td>
										<td class="location-cell"><?php echo htmlspecialchars($row['location']); ?></td>
										<td>
											<form class="actions-form" action="process.php" method="GET">
												<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
												<button type="submit" name="edit" value="edit" class="btn-soft">Edit</button>
												<button type="submit" name="delete" value="delete" class="btn-danger-clean">Delete</button>
											</form>
										</td>
									</tr>
								<?php endwhile; ?>
							<?php else: ?>
								<tr>
									<td colspan="3" class="empty-state">No records yet. Add the first one from the form.</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>

			<aside class="panel">
				<div class="panel-header">
					<h2 class="panel-title">Add Record</h2>
				</div>
				<form class="form-panel" action="process.php" method="POST">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" id="name" name="name" class="form-control" placeholder="Enter a name" required>
					</div>
					<div class="form-group">
						<label for="location">Location</label>
						<input type="text" id="location" name="location" class="form-control" placeholder="Enter a location" required>
					</div>
					<button type="submit" name="save" class="btn-primary-clean">Save Record</button>
				</form>
			</aside>
		</section>
	</main>
</body>
</html>
