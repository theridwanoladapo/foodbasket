<?php

/**
*	Model Class
**/

class Model {

	/**
	*	Class constructor
	**/
	public function __construct()
	{
		
	}

//	--------------------------------------------------------------------

	/**
	*	__get magic
	*
	*	Allows models to access CI's loaded classes using the same
	*	syntax as controllers.
	**/
	public function __get($key)
	{
		// Debugging note:
		//	If you're here because you're getting an error message
		//	saying 'Undefined Property: system/core/Model.php', it's
		//	most likely a typo in your model code.
		return get_instance()->$key;
	}

}
