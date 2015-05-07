<html>
<head>
	<title>Admin - Add New Product</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="/assets/js/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="/assets/js/bootstrap.js"></script>
		<link rel="stylesheet" href="/assets/css/bootstrap.css">
		<link rel="stylesheet" href="/assets/css/bootstrap-theme.css">
		<link rel="stylesheet" href="/assets/css/admin/add_product.css">
		<link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
<?php require('application/views/partials/adminnav.php'); ?>

	<div class="container">
		<h2>Add Product</h2>
		<h3><?= $this->session->flashdata('msg') ?></h3>
		<h3><?= $this->session->flashdata('errors') ?></h3>
		<form action="/admin/dashboard/products/add_product" method="post">
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" class="form-control" id="name" name="name">
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea class="form-control" rows="10" cols="10" id="description" name="description"></textarea>
			</div>
			<div class="form-group">
				<label for="description">Type</label>
				<select class="form-control">
				<?php 
				foreach ($types as $key => $value) {
				?>
					<option value="<?= $value['id']?>" selected><?= $value['name'] ?></option>
				<?php
				}
				?>
				</select>
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-warning add_type_btn">Add Second Type</button>
			</div>
			<div class="form-group">
				<label for="add_image">Add Image</label>
				<input type="file" id="add_image">
				<p class="help-block">Select an image for upload.</p>
			</div>
			<a href="/admin/dashboard/products" class="btn btn-default" name="back">Go back</a>
			<button class="btn btn-success" name="preview">Preview</button>
			<input type="submit" class="btn btn-primary">
		</form>
	</div>
</body>
</html>