<?php

/**
*	Router Class
*
*	Parses URIs and determines routing
**/
class App
{

	/** List of routes **/
	public $routes = array();
	
	/** Current class name **/
	public $class = '';
	
	/** Current method name **/
	public $method = 'index';
	
	/** Default controller (and method if specific) **/
	public $default_controller = '';
	
	/** Translate URI dashes **/
	public $translate_uri_dashes = FALSE;
	
	/** Current class name **/
	public $uri_string = '';
	
	/** Argument parameters **/
	public $segments = array();

	/** Argument parameters **/
	public $rsegments = array();

	/** Argument parameters **/
	public $params = array();



	/**
	*	Class constructor
	**/
	public function __construct()
	{
		$this->set_uri_string();
		
		$this->set_routing();
	}

//	--------------------------------------------------------------------

	/**
	*	Set Routing
	**/
	protected function set_routing()
	{
		if (file_exists(APPPATH.'config/routes.php'))
		{
			include(APPPATH.'config/routes.php');
		}
		
		// Validate & get reserved routes
		if (isset($route) && is_array($route))
		{
			isset($route['default_controller']) && $this->default_controller = $route['default_controller'];
			isset($route['translate_uri_dashes']) && $this->translate_uri_dashes = $route['translate_uri_dashes'];
			unset($route['default_controller'], $route['translate_uri_dashes']);
			$this->routes = $route;
		}
		
		// Is there anything to parse?
		if ($this->uri_string !== '')
		{
			$this->parse_routes();
		}
		else
		{
			$this->set_default_controller();
		}
		
	}

//	--------------------------------------------------------------------

	/**
	*	Set Request
	**/
	protected function set_request()
	{
	}

//	--------------------------------------------------------------------

	/**
	*	Set Default Controller
	**/
	protected function set_default_controller()
	{
		if ( ! empty($this->default_controller))
		{
			if (sscanf($this->default_controller, '%[^/]/%s', $class, $method) !== 2)
			{
				$method = 'index';
			}
		}
		
		if (file_exists(APPPATH.'controllers/'.ucfirst($class).'.php'))
		{
			$this->set_class($class);
		}
		
		$this->set_class($class);
		$this->set_method($method);
		
		//	Assign routed segments, index starting from 1
		$this->rsegments = array(
			1 => $class,
			2 => $method
		);
	}

//	--------------------------------------------------------------------

	/**
	*	Parse Routes
	**/
	protected function parse_routes()
	{
		$segments = explode('/', trim($this->uri_string, '/'));
		
		$this->set_class($segments[0]);
		if (isset($segments[1]))
		{
			$this->set_method($segments[1]);
		}
		else
		{
			$segments[1] = 'index';
		}
		array_unshift($segments, NULL);
		unset($segments[0]);
		
		//	Assign routed segments, index starting from 1
		$this->rsegments = $segments;
	}

//	--------------------------------------------------------------------

	/**
	*	Set URI String
	**/
	protected function set_uri_string()
	{
		isset($_SERVER['REQUEST_URI']) && $uri = $_SERVER['REQUEST_URI'];
		
		if (trim($uri, '/') === '')
		{
			return '';
		}
		elseif (strncmp($uri, '/', 1) === 0)
		{
			$uri = explode('?', $uri, 2);
			$query = isset($uri[1]) ? $uri[1] : '';
			$uri = $uri[0];
		}
		
		$this->uri_string = $query;
	}

//	--------------------------------------------------------------------

	/**
	*	Parse Query String
	**/
	protected function parse_query_string()
	{
	}

//	--------------------------------------------------------------------

	/**
	*	Set class name
	**/
	public function set_class($class)
	{
		$this->class = str_replace(array('/', '.'), '', $class);
	}

//	--------------------------------------------------------------------

	/**
	*	Fetch the current class
	**/
	public function fetch_class()
	{
		return $this->class;
	}

//	--------------------------------------------------------------------

	/**
	*	Set method name
	*/
	public function set_method($method)
	{
		$this->method = $method;
	}

//	--------------------------------------------------------------------

	/**
	*	Fetch the current method
	*/
	public function fetch_method()
	{
		return $this->method;
	}

}