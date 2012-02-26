<?php
class Controller 
{
	protected $_model;
	protected $_controller;
	protected $_action;
	protected $_view;
	
	
	function __construct($model,$controller,$action)
	{	
		global $session;
		$this->_controller = $controller;
		$this->_action = $action;
		$this->_model = $model;
		
		$this->$model = new $model;
		$this->_view = new View($controller,$action);
		$session = new Session($this->$model);
	}
	
	function set($name,$value) {
		$this->_view->set($name,$value);
	}
	
	function __destruct()
	{
		$this->_view->render();
	}
}
