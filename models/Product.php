<?php

namespace app\models;

use app\Database;
use app\helpers\StringHelper;

class Product{
	public ?int $id = null;
	public ?string $title = null;
	public ?string $description = null;
	public ?float $price = null;
	public ?string $imagePath = null;
	public ?array $imageFile = null;

	public function load($data){
		$this->id = $data['id'] ?? null;
		$this->title = $data['title'];
		$this->description = $data['description'];
		$this->price = $data['price'];
		$this->imagePath = $data['imagePath'] ?? null;
		$this->imageFile = $data['imageFile'] ?? null;
	}
	public function save(){
		$errors = [];
		if(!is_dir(__DIR__.'/../public/images')){
			mkdir(__DIR__.'/../public/images');
		}
		if(!$this->title){
			$errors[] = 'Product title is required';
		}
		if(!$this->price){
			$errors[] = 'Product price is required';
		}
		if(!$this->description){
			$errors[] = 'Product description is required';
		}
		if(empty($errors)){
			if ($this->imageFile && $this->imageFile['tmp_name']) {
				if($this->imagePath){
					unlink(__DIR__.'/../public/'.$this->imagePath);
					rmdir(__DIR__.'/../public/'.explode('/',$this->imagePath)[0].'/'.explode('/',$this->imagePath)[1]);
				}
				$this->imagePath = 'images/'.StringHelper::randomString(8).'/'.$this->imageFile['name'];
				mkdir(dirname(__DIR__.'/../public/'.$this->imagePath));
				move_uploaded_file($this->imageFile['tmp_name'],__DIR__.'/../public/'.$this->imagePath);
			}

			$db = Database::$db;
			if($this->id){
				$db->updateProduct($this);
			}else{
				$db->createProduct($this);
			}

		}
		return $errors;
	}

}

?>