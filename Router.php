<?php

namespace app;

class Router{

	public array $getRoutes = [];
	public array $postRoutes = [];
	public Database $db;

	public function __construct(){
		$this->db = new Database();
	}

	public function get($url,$fn){
		$this->getRoutes[$url] = $fn;
	}
	public function post($url,$fn){
		$this->postRoutes[$url] = $fn;
	}
	public function resolve(){
		$currentURL = $_SERVER['REQUEST_URI'] ?? '/';
		if(strpos($currentURL, "?")!== false){
			$currentURL = substr($currentURL, 0, strpos($currentURL, "?"));
		}
		$method = $_SERVER['REQUEST_METHOD'];
		if($method === "GET"){
			$fn = $this->getRoutes[$currentURL] ?? null;
		}else{
			$fn = $this->postRoutes[$currentURL] ?? null;
		}

		if($fn){
			call_user_func($fn, $this);
		}else{
			echo "The Page which you are looking for is NOT FOUND";
		}
	}
	public function renderView($view, $params = []){
		foreach ($params as $key => $value){
			$$key = $value;
		}

		ob_start();
		include_once __DIR__."/views/$view.php";
		$content = ob_get_clean();
		include_once __DIR__.'/views/_layout.php';
	}

}

?>