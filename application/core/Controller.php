<?php

class Controller
{
	/**
	*	Reference to the APP singleton
	**/
	private static $instance;
	
	/**
	*	Class constructor
	**/
	public function __construct()
	{
		self::$instance =& $this;
		
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
	}

//	--------------------------------------------------------------------

	/**
	*	Get the APP singleton
	**/
	public static function &get_instance()
	{
		return self::$instance;
	}

//	--------------------------------------------------------------------
/*
	public function model($model)
	{
		if (file_exists(APPPATH.'models/'.$model.'.php'))
		{
			require_once APPPATH.'models/'.$model.'.php';
		}
		return new $model;
	}
	
	public function view($view, $data = array())
	{
		if (file_exists(APPPATH.'views/'.$view.'.php'))
		{
			require_once APPPATH.'views/'.$view.'.php';
		}
		elseif (file_exists(APPPATH.'views/'.$view))
		{
			require_once APPPATH.'views/'.$view;
		}
	}
*/
}