<?php

//require_once(APPPATH.'core/Router.php');
//$RTR = new Router;


/*
* ------------------------------------------------------
*  Load the global functions
* ------------------------------------------------------
*/
	require_once(BASEPATH.'core/Common.php');

/*
* ------------------------------------------------------
*  Start the timer... tick tock tick tock...
* ------------------------------------------------------
*/
	$BM =& load_class('Benchmark', 'core');
	$BM->mark('total_execution_time_start');
	$BM->mark('loading_time:_base_classes_start');

/*
* ------------------------------------------------------
*  Instantiate the config class
* ------------------------------------------------------
*
* Note: It is important that Config is loaded first as
* most other classes depend on it either directly or by
* depending on another class that uses it.
*
*/
	$CFG =& load_class('Config', 'core');
	
	// Do we have any manually set config items in the index.php file?
	if (isset($assign_to_config) && is_array($assign_to_config))
	{
		foreach ($assign_to_config as $key => $value)
		{
			$CFG->set_item($key, $value);
		}
	}

/*
* ------------------------------------------------------
*  Instantiate the routing class and set the routing
* ------------------------------------------------------
*/
	$RTR =& load_class('Router', 'core', isset($routing) ? $routing : NULL);

/*
* ------------------------------------------------------
*  Instantiate the output class
* ------------------------------------------------------
*/
	//$OUT =& load_class('Output', 'core');

/*
* ------------------------------------------------------
*  Load the Input class and sanitize globals
* ------------------------------------------------------
*/
	$IN	=& load_class('Input', 'core');


/*
*	------------------------------------------------------
*	Load the app controller
*	------------------------------------------------------
*/
	// Load the Controller class
	require_once(APPPATH.'core/Controller.php');
	
	/*
	*	Reference to the Controller method.
	*	Returns Controller instance object
	*/
	
	function &get_instance()
	{
		return Controller::get_instance();
	}

/*
*	------------------------------------------------------
*	Sanity checks
*	------------------------------------------------------
*/	
	$class = ucfirst($RTR->class);
	$method = $RTR->method;
	
	if (file_exists(APPPATH.'controllers/'.$class.'.php'))
	{
		require_once(APPPATH.'controllers/'.$class.'.php');
	}
	if ($method !== '')
	{
		$params = array_slice($RTR->rsegments, 2);
	}

/*
*	------------------------------------------------------
*	Instantiate the requested controller
*	------------------------------------------------------
*/
	$Controller = new $class;

/*
*	------------------------------------------------------
*	Call the requested method
*	------------------------------------------------------
*/
	call_user_func_array(array(&$Controller, $method), $params);
