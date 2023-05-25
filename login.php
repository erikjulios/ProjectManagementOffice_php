<!DOCTYPE html>
<html>
<head>
	<title>Form Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style type="text/css">
		.container {
			margin-top: 4%;
		}
	</style>
</head>
<body>
	<div class="container">
		<center>
		<div class="card bg-secondary" style="width: 18rem;">
			<!-- <div class="card-header"> -->
			<div class="card-body text-left">
				<div class="text-center">
					<img class="img-thumbnail" src="assets/img/logo.png" style="height:100px" alt="Card image cap">
				</div>
			<!-- </div> -->
			<!-- <div class="card-body text-left"> -->
				<form method="post" action="prosesLogin.php" class="mt-4">
					<div class="form-group">
						<label for="username">Username:</label>
						<input type="text" class="form-control form-control-sm" id="username" name="username" required>
					</div>
					<div class="form-group">
						<label for="password">Password:</label>
						<input type="password" class="form-control form-control-sm" id="password" name="password" required>
					</div>
					<div class="text-right">
					<button type="submit" class="btn btn-sm btn-primary ">Login</button>
					</div>
					
				</form>
			</div>
		</div>
		</center>
	</div>
</body>
