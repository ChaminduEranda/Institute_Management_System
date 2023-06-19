<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="css/fontawesome.min.css">
	<link rel="stylesheet" href="css/solid.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css?v=<?php echo time(); ?>">


	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap4.min.js"></script>
	<script src="js/fontawesome.min.js"></script>
	<script src="js/script.js"></script>

	<title>enroll</title>
</head>

<body>

	<div id=main>
		<div>
			<?php include('header.php'); ?>
		</div>
	</div>

	<div>
		<h1 class="text-primary"><i class="fas fa-user-plus"></i>Enter Your Informations to Register!</h1>
		<nav aria-label="breadcrumb">
		</nav>
		<div class="row">
			<div class="col-sm-6">
				<form enctype="multipart/form-data" method="POST" action="">
					<div class="form-group">
						<label for="name">Name</label>
						<input name="name" type="text" class="form-control" id="name" value="" required="">
					</div>
					<div class="form-group">
						<label for="roll">Roll</label>
						<input name="roll" type="text" class="form-control" pattern="[0-9]{6}" id="roll" value="" required="">
					</div>
					<div class="form-group">
						<label for="address">Address</label>
						<input name="address" type="text" class="form-control" id="address" value="" required="">
					</div>
					<div class="form-group">
						<label for="pcontact">Contact NO</label>
						<input name="pcontact" type="text" class="form-control" id="pcontact" value="" pattern="[0-9]{10}" placeholder="0........." required="">
					</div>

					<div class="form-group text-center">
						<input name="register" value="Register" type="submit" class="btn btn-danger">
					</div>
				</form>
			</div>
		</div>


		<div class="clearfix"></div>


	</div>

	<script type="text/javascript">
		jQuery('.toast').toast('show');
	</script>

	<?php include('footer.php'); ?>
</body>

</html>