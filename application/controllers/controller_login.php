<?php
class Controller_Login extends Controller
{
	function __construct(){
		$this->model = new Model_Login();
	}
	
	function action_index(){
		$this->model->login($_POST["login"], $_POST["password"]);
		header("Location:/");
	}
	
	
	
	
}