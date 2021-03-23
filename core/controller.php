<?php

class Controller {

	protected $_view;
	protected $_model;

	function __construct() {
		$this->_view = new View();		

		$name = get_class($this);
		$modelpath = 'models/' . strtolower($name) . '_model.php';	// added strtolower because on synology and tracemyrace models were not found/loaded

		if (file_exists($modelpath)) {
			require $modelpath;

			$modelName = $name . '_Model';
			$this->_model = new $modelName();
		}
	}

}
