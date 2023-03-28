<?php if(!empty($errors)): ?>
<div class="alert alert-danger">
	<?php foreach ($errors as $error): ?>

	<div><?php echo $error ?></div>

	<?php endforeach ?>
</div>
<?php endif; ?>


<h1 class="mt-4 text-capitalize">
	<?php if($product['image'] || $product['title'] || $product['description'] || $product['price']): ?>

	Update -

	<strong><?php echo $product['title'] ?></strong>
	<?php endif; ?>
	<?php if(!$product['image']): ?>
	Create your product
	<?php endif; ?>
</h1>

<form class="" action="" method="POST" enctype="multipart/form-data">

	<?php if($product['image']): ?>
	<img class="img" src="/<?php echo $product['image'] ?>" alt="">
	<?php endif; ?>

	<div class="mb-3">
		<label for="exampleInputEmail1" class="form-label">Product Image</label>
		<input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="product_img">
	</div>
	<div class="mb-3">
		<label for="exampleInputPassword1" class="form-label">Product Title</label>
		<input type="text" class="form-control" id="exampleInputPassword1" name="product_title"
			value="<?php echo $product['title']; ?>">
	</div>
	<div class="form-floating">
		<textarea class="form-control" id="floatingTextarea2" style="height: 100px"
			name="product_description"><?php echo $product['description']; ?></textarea>
		<label for="floatingTextarea2">Product Description</label>
	</div>
	<div class="mb-3">
		<label for="exampleInputPassword1" class="form-label">Product Price</label>
		<input type="number" step=".01" class="form-control" id="exampleInputPassword1" name="product_price"
			value="<?php echo $product['price']; ?>">
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
	<a href="/" class="btn btn-secondary">Go Back</a>
</form>