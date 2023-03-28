<?php

namespace app\controllers;

use app\models\Product;
use app\Router;

class ProductController{
	static function index(Router $router){
		$search = $_GET['search'] ?? '';
		$products = $router->db->getProducts($search);
		return $router->renderView('products/index',[
			'products' => $products,
			'search' => $search
		]);
	}

	static function create(Router $router){
		$errors = [];
		$productData = [
			'title' => '',
			'description' => '',
			'image' => '',
			'price' => '',
		];

		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$productData['title'] = $_POST['product_title'];
			$productData['description'] = $_POST['product_description'];
			$productData['price'] = (float)$_POST['product_price'];
			$productData['imageFile'] = $_FILES['product_img'] ?? null;

			$product = new Product();
			$product->load($productData);
			$errors = $product->save();
			if(empty($errors)){
				header("Location: /products");
				exit;
			}


		}

		$router->renderView('products/create',[
			'product' => $productData,
			'errors' => $errors
		]);
	}

	static function update(Router $router){
		$id = $_GET['id']??null;
		if(!$id){
			header("Location: /products");
			exit;
		}
		$errors = [];

		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$productData['title'] = $_POST['product_title'];
			$productData['description'] = $_POST['product_description'];
			$productData['price'] = (float)$_POST['product_price'];
			$productData['imageFile'] = $_FILES['product_img'];

			$product = new Product();
			$product->load($productData);
			$errors = $product->save();
			if(empty($errors)){
				exit;
				header("Location: /products");
			}

		}

		$productData = $router->db->getProductById($id);

		$router->renderView('products/update',[
			'product' => $productData,
			'errors' => $errors
		]);
	}

	static function delete(Router $router){
		$id = $_POST['id']??null;
		if(!$id){
			header("Location: /products");
			exit;
		}
		$router->db->deleteProduct($id);
		header("Location: /products");
	}

}

?>