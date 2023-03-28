<style>
.product_image {
	width: 40px;
	height: 40px;
	border-radius: 50%;
	object-fit: cover;
}
</style>


<div class="container">

	<h1 class="mt-4 text-capitalize">here is your phones</h1>
	<a href="/products/create" class="btn btn-outline-success">Create</a>
	<form action="" class="mt-3">

		<div class="input-group mb-3">
			<input type="text" class="form-control" placeholder="Search for product" aria-label="Recipient's username"
				value="<?php echo $search; ?>" name="search">
			<button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
		</div>
	</form>
	<table class="table mt-4">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Image</th>
				<th scope="col">Title</th>
				<th scope="col">Price</th>
				<th scope="col">Created Date</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($products as $i => $product): ?>

			<tr>
				<th scope="row"><?php echo $i + 1 ?></th>
				<td>
					<?php if($product['image']): ?>
					<img class="product_image" src="/<?php echo $product['image'] ?>" alt="">
					<?php endif; ?>
				</td>
				<td><?php echo $product['title'] ?></td>
				<td><?php echo $product['price'] ?></td>
				<td><?php echo $product['create_date'] ?></td>
				<td>
					<a href="/products/update?id=<?php echo $product['id'] ?>" class="btn btn-sm btn-outline-primary">
						Edit
					</a>
					<form action="/products/delete" style="display: inline-block;" method="post">
						<input type="hidden" name="id" value="<?php echo $product['id'] ?>">
						<button type="submit" class="btn btn-sm btn-outline-danger">
							Delete
						</button>

					</form>
				</td>
			</tr>


			<?php	endforeach; ?>
		</tbody>
	</table>

</div>