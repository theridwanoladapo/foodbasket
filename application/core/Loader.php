<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
*	Loader Class
*
*	Loads framework components.
**/

class Loader
{

	// All these are set automatically. Don't mess with them.
	
	/** Nesting level of the output buffering mechanism (@var int) **/
	protected $_app_ob_level;
	
	/** List of paths to load views from (@var array) **/
	protected $_app_view_paths = array(VIEWPATH	=> TRUE);
	
	/** List of paths to load libraries from (@var array) **/
	protected $_app_library_paths = array(APPPATH);
	
	/** List of paths to load models from (@var array) **/
	protected $_app_model_paths = array(APPPATH);
	
	/** List of paths to load helpers from (@var array) **/
	protected $_app_helper_paths = array(APPPATH);
	
	/** List of cached variables (@var array) **/
	protected $_app_cached_vars = array();
	
	/** List of loaded classes (@var array) **/
	protected $_app_classes = array();
	
	/** List of loaded models (@var array) **/
	protected $_app_models = array();
	
	/** List of loaded helpers (@var array) **/
	protected $_app_helpers = array();
	
	/** List of class name mappings (@var array) **/
	protected $_app_varmap = array(
		'unit_test' => 'unit',
		'user_agent' => 'agent'
	);




//	--------------------------------------------------------------------

	/**
	*	Class constructor
	**/
	public function __construct()
	{
		$this->_app_ob_level = ob_get_level();
		$this->_app_classes =& is_loaded();
	}

//	--------------------------------------------------------------------

	/**
	*	Initializer
	**/
	public function initialize()
	{
		$this->_app_autoloader();
	}

//	--------------------------------------------------------------------

	/**
	*	Is Loaded
	**/
	public function is_loaded($class)
	{
		return array_search(ucfirst($class), $this->_app_classes, TRUE);
	}

//	--------------------------------------------------------------------

	/**
	*	Library Loader
	**/
	public function library($library, $params = NULL, $object_name = NULL)
	{
		if (empty($library))
		{
			return $this;
		}
		elseif (is_array($library))
		{
			foreach ($library as $key => $value)
			{
				if (is_int($key))
				{
					$this->library($value, $params);
				}
				else
				{
					$this->library($key, $params, $value);
				}
			}
			
			return $this;
		}
		
		if ($params !== NULL && ! is_array($params))
		{
			$params = NULL;
		}
		
		$this->_app_load_library($library, $params, $object_name);
		return $this;
	}

//	--------------------------------------------------------------------

	/**
	*	Model Loader
	**/
	public function model($model, $name = '', $db_conn = FALSE)
	{
		if (empty($model))
		{
			return $this;
		}
		elseif (is_array($model))
		{
			foreach ($model as $key => $value)
			{
				is_int($key) ? $this->model($value, '', $db_conn) : $this->model($key, $value, $db_conn);
			}
			
			return $this;
		}
		
		$path = '';
		
		// Is the model in a sub-folder? If so, parse out the filename and path.
		if (($last_slash = strrpos($model, '/')) !== FALSE)
		{
			// The path is in front of the last slash
			$path = substr($model, 0, ++$last_slash);
			
			// And the model name behind it
			$model = substr($model, $last_slash);
		}
		
		if (empty($name))
		{
			$name = $model;
		}
		
		if (in_array($name, $this->_app_models, TRUE))
		{
			return $this;
		}
		
		$APP =& get_instance();
		if (isset($APP->$name))
		{
			echo('The model name you are loading is the name of a resource that is already being used: '.$name);
		}
		
		if ($db_conn !== FALSE && ! class_exists('DB', FALSE))
		{
			if ($db_conn === TRUE)
			{
				$db_conn = '';
			}
			
			$this->database($db_conn, FALSE, TRUE);
		}
		
		if ( ! class_exists('Model', FALSE))
		{
			load_class('Model', 'core');
		}
		
		$model = ucfirst(strtolower($model));
		
		foreach ($this->_app_model_paths as $mod_path)
		{
			if ( ! file_exists($mod_path.'models/'.$path.$model.'.php'))
			{
				continue;
			}
			
			require_once($mod_path.'models/'.$path.$model.'.php');
			
			$this->_app_models[] = $name;
			$APP->$name = new $model();
			return $this;
		}
		
		// couldn't find the model
		echo('Unable to locate the model you have specified: '.$model);
	}

//	--------------------------------------------------------------------

	/**
	*	Database Loader
	**/
	public function database($params = '', $return = FALSE, $query_builder = NULL)
	{
		// Grab the super object
		$APP =& get_instance();
		
		// Do we even need to load the database class?
		if ($return === FALSE && $query_builder === NULL && isset($APP->db) && is_object($APP->db) && ! empty($APP->db->conn_id))
		{
			return FALSE;
		}
		
		require_once(APPPATH.'core/DB.php');
		
		if ($return === TRUE)
		{
			return DB($params, $query_builder);
		}
		
		// Initialize the db variable. Needed to prevent
		// reference errors with some configurations
		$APP->db = '';
		
		// Load the DB class
		$APP->db = new DB();
		return $this;
	}

//	--------------------------------------------------------------------

	/**
	*	View Loader
	**/
	public function view($view, $vars = array(), $return = FALSE)
	{
		return $this->_app_load(array('_view' => $view, '_vars' => $this->_app_object_to_array($vars), '_return' => $return));
	}

//	--------------------------------------------------------------------

	/**
	*	Generic File Loader
	**/
	public function file($path, $return = FALSE)
	{
		return $this->_app_load(array('_path' => $path, '_return' => $return));
	}

//	--------------------------------------------------------------------

	/**
	*	Set Variables
	**/
	public function vars($vars, $val = '')
	{
		if (is_string($vars))
		{
			$vars = array($vars => $val);
		}
		
		$vars = $this->_app_object_to_array($vars);
		
		if (is_array($vars) && count($vars) > 0)
		{
			foreach ($vars as $key => $val)
			{
				$this->_app_cached_vars[$key] = $val;
			}
		}
		
		return $this;
	}

//	--------------------------------------------------------------------

	/**
	*	Clear Cached Variables
	**/
	public function clear_vars()
	{
		$this->_app_cached_vars = array();
		return $this;
	}

//	--------------------------------------------------------------------

	/**
	*	Get Variable
	**/
	public function get_var($key)
	{
		return isset($this->_app_cached_vars[$key]) ? $this->_app_cached_vars[$key] : NULL;
	}

//	--------------------------------------------------------------------

	/**
	*	Get Variables
	**/
	public function get_vars()
	{
		return $this->_app_cached_vars;
	}

//	--------------------------------------------------------------------

	/**
	*	Helper Loader
	**/
	public function helper($helpers = array())
	{
		foreach ($this->_app_prep_filename($helpers, '') as $helper)
		{
			if (isset($this->_app_helpers[$helper]))
			{
				continue;
			}

			// Is this a helper extension request?
			$ext_helper = config_item('subclass_prefix').$helper;
			$ext_loaded = FALSE;
			foreach ($this->_app_helper_paths as $path)
			{
				if (file_exists($path.'helpers/'.$ext_helper.'.php'))
				{
					include_once($path.'helpers/'.$ext_helper.'.php');
					$ext_loaded = TRUE;
				}
			}

			// If we have loaded extensions - check if the base one is here
			if ($ext_loaded === TRUE)
			{
				$base_helper = APPPATH.'helpers/'.$helper.'.php';
				if ( ! file_exists($base_helper))
				{
					echo('Unable to load the requested file: helpers/'.$helper.'.php');
				}

				include_once($base_helper);
				$this->_app_helpers[$helper] = TRUE;
				//echo('Helper loaded: '.$helper);
				continue;
			}

			// No extensions found ... try loading regular helpers and/or overrides
			foreach ($this->_app_helper_paths as $path)
			{
				if (file_exists($path.'helpers/'.$helper.'.php'))
				{
					include_once($path.'helpers/'.$helper.'.php');

					$this->_app_helpers[$helper] = TRUE;
					//echo('Helper loaded: '.$helper);
					break;
				}
			}

			// unable to load the helper
			if ( ! isset($this->_app_helpers[$helper]))
			{
				echo('Unable to load the requested file: helpers/'.$helper.'.php');
			}
		}

		return $this;
	}

//	--------------------------------------------------------------------

	/**
	*	Load Helpers
	**/
	public function helpers($helpers = array())
	{
		return $this->helper($helpers);
	}

//	--------------------------------------------------------------------

	/**
	*	Internal APP Data Loader
	**/
	protected function _app_load($_data)
	{
		// Set the default data variables
		foreach (array('_view', '_vars', '_path', '_return') as $_val)
		{
			$$_val = isset($_data[$_val]) ? $_data[$_val] : FALSE;
		}

		$file_exists = FALSE;

		// Set the path to the requested file
		if (is_string($_path) && $_path !== '')
		{
			$_x = explode('/', $_path);
			$_file = end($_x);
		}
		else
		{
			$_ext = pathinfo($_view, PATHINFO_EXTENSION);
			$_file = ($_ext === '') ? $_view.'.php' : $_view;

			foreach ($this->_app_view_paths as $_view_file => $cascade)
			{
				if (file_exists($_view_file.$_file))
				{
					$_path = $_view_file.$_file;
					$file_exists = TRUE;
					break;
				}

				if ( ! $cascade)
				{
					break;
				}
			}
		}

		if ( ! $file_exists && ! file_exists($_path))
		{
			show_error('Unable to load the requested file: '.$_file);
		}

		// This allows anything loaded using $this->load (views, files, etc.)
		// to become accessible from within the Controller and Model functions.
		$_APP =& get_instance();
		foreach (get_object_vars($_APP) as $_key => $_var)
		{
			if ( ! isset($this->$_key))
			{
				$this->$_key =& $_APP->$_key;
			}
		}

		/*
		 * Extract and cache variables
		 *
		 * You can either set variables using the dedicated $this->load->vars()
		 * function or via the second parameter of this function. We'll merge
		 * the two types and cache them so that views that are embedded within
		 * other views can have access to these variables.
		 */
		if (is_array($_vars))
		{
			$this->_app_cached_vars = array_merge($this->_app_cached_vars, $_vars);
		}
		extract($this->_app_cached_vars);

		/*
		 * Buffer the output
		 *
		 * We buffer the output for two reasons:
		 * 1. Speed. You get a significant speed boost.
		 * 2. So that the final rendered template can be post-processed by
		 *	the output class. Why do we need post processing? For one thing,
		 *	in order to show the elapsed page load time. Unless we can
		 *	intercept the content right before it's sent to the browser and
		 *	then stop the timer it won't be accurate.
		 */
		
		// If the PHP installation does not support short tags we'll
		// do a little string replacement, changing the short tags
		// to standard PHP echo statements.
		if ( ! is_php('5.4') && ! ini_get('short_open_tag') && config_item('rewrite_short_tags') === TRUE && function_usable('eval'))
		{
			echo eval('?>'.preg_replace('/;*\s*\?>/', '; ?>', str_replace('<?=', '<?php echo ', file_get_contents($_path))));
		}
		else
		{
			include($_path); // include() vs include_once() allows for multiple views with the same name
		}
		
		return $this;
	}

//	--------------------------------------------------------------------

	/**
	*	Internal APP Library Loader
	**/
	protected function _app_load_library($class, $params = NULL, $object_name = NULL)
	{
		// Get the class name, and while we're at it trim any slashes.
		// The directory path can be included as part of the class name,
		// but we don't want a leading slash
		$class = str_replace('.php', '', trim($class, '/'));

		// Was the path included with the class name?
		// We look for a slash to determine this
		if (($last_slash = strrpos($class, '/')) !== FALSE)
		{
			// Extract the path
			$subdir = substr($class, 0, ++$last_slash);

			// Get the filename from the path
			$class = substr($class, $last_slash);
		}
		else
		{
			$subdir = '';
		}

		$class = ucfirst($class);

		// Is this a stock library? There are a few special conditions if so ...
		if (file_exists(APPPATH.'libraries/'.$subdir.$class.'.php'))
		{
			return $this->_app_load_stock_library($class, $subdir, $params, $object_name);
		}

		// Let's search for the requested library file and load it.
		foreach ($this->_app_library_paths as $path)
		{
			// APPPATH has already been checked for
			if ($path === APPPATH)
			{
				continue;
			}

			$filepath = $path.'libraries/'.$subdir.$class.'.php';

			// Safety: Was the class already loaded by a previous call?
			if (class_exists($class, FALSE))
			{
				// Before we deem this to be a duplicate request, let's see
				// if a custom object name is being supplied. If so, we'll
				// return a new instance of the object
				if ($object_name !== NULL)
				{
					$APP =& get_instance();
					if ( ! isset($APP->$object_name))
					{
						return $this->_app_init_library($class, '', $params, $object_name);
					}
				}
				return;
			}
			// Does the file exist? No? Bummer...
			elseif ( ! file_exists($filepath))
			{
				continue;
			}

			include_once($filepath);
			return $this->_app_init_library($class, '', $params, $object_name);
		}

		// One last attempt. Maybe the library is in a subdirectory, but it wasn't specified?
		if ($subdir === '')
		{
			return $this->_app_load_library($class.'/'.$class, $params, $object_name);
		}

		// If we got this far we were unable to find the requested class.
	}

//	--------------------------------------------------------------------

	/**
	*	Internal APP Stock Library Loader
	**/
	protected function _app_load_stock_library($library_name, $file_path, $params, $object_name)
	{
		$prefix = '';

		if (class_exists($prefix.$library_name, FALSE))
		{
			if (class_exists(config_item('subclass_prefix').$library_name, FALSE))
			{
				$prefix = config_item('subclass_prefix');
			}

			// Before we deem this to be a duplicate request, let's see
			// if a custom object name is being supplied. If so, we'll
			// return a new instance of the object
			if ($object_name !== NULL)
			{
				$APP =& get_instance();
				if ( ! isset($APP->$object_name))
				{
					return $this->_app_init_library($library_name, $prefix, $params, $object_name);
				}
			}

			return;
		}

		$paths = $this->_app_library_paths;
		array_pop($paths); // APPPATH
		array_pop($paths); // APPPATH (needs to be the first path checked)
		array_unshift($paths, APPPATH);

		foreach ($paths as $path)
		{
			if (file_exists($path = $path.'libraries/'.$file_path.$library_name.'.php'))
			{
				// Override
				include_once($path);
				if (class_exists($prefix.$library_name, FALSE))
				{
					return $this->_app_init_library($library_name, $prefix, $params, $object_name);
				}
				else
				{
					log_message('debug', $path.' exists, but does not declare '.$prefix.$library_name);
				}
			}
		}

		include_once(APPPATH.'libraries/'.$file_path.$library_name.'.php');

		// Check for extensions
		$subclass = config_item('subclass_prefix').$library_name;
		foreach ($paths as $path)
		{
			if (file_exists($path = $path.'libraries/'.$file_path.$subclass.'.php'))
			{
				include_once($path);
				if (class_exists($subclass, FALSE))
				{
					$prefix = config_item('subclass_prefix');
					break;
				}
				else
				{
					log_message('debug', APPPATH.'libraries/'.$file_path.$subclass.'.php exists, but does not declare '.$subclass);
				}
			}
		}

		return $this->_app_init_library($library_name, $prefix, $params, $object_name);
	}

//	--------------------------------------------------------------------

	/**
	*	Internal APP Library Instantiator
	**/
	protected function _app_init_library($class, $prefix, $config = FALSE, $object_name = NULL)
	{
		// Is there an associated config file for this class? Note: these should always be lowercase
		if ($config === NULL)
		{
			// Fetch the config paths containing any package paths
			$config_component = $this->_get_component('config');

			if (is_array($config_component->_config_paths))
			{
				$found = FALSE;
				foreach ($config_component->_config_paths as $path)
				{
					// We test for both uppercase and lowercase, for servers that
					// are case-sensitive with regard to file names. Load global first,
					// override with environment next
					if (file_exists($path.'config/'.strtolower($class).'.php'))
					{
						include($path.'config/'.strtolower($class).'.php');
						$found = TRUE;
					}
					elseif (file_exists($path.'config/'.ucfirst(strtolower($class)).'.php'))
					{
						include($path.'config/'.ucfirst(strtolower($class)).'.php');
						$found = TRUE;
					}

					if (file_exists($path.'config/'.ENVIRONMENT.'/'.strtolower($class).'.php'))
					{
						include($path.'config/'.ENVIRONMENT.'/'.strtolower($class).'.php');
						$found = TRUE;
					}
					elseif (file_exists($path.'config/'.ENVIRONMENT.'/'.ucfirst(strtolower($class)).'.php'))
					{
						include($path.'config/'.ENVIRONMENT.'/'.ucfirst(strtolower($class)).'.php');
						$found = TRUE;
					}

					// Break on the first found configuration, thus package
					// files are not overridden by default paths
					if ($found === TRUE)
					{
						break;
					}
				}
			}
		}

		$class_name = $prefix.$class;

		// Is the class name valid?
		if ( ! class_exists($class_name, FALSE))
		{
			log_message('error', 'Non-existent class: '.$class_name);
			//show_error('Non-existent class: '.$class_name);
            show_error(base64_decode('U29mdHdhcmUgbGljZW5zZSBpbnZhbGlkLiBDb250YWN0IFN1cHBvcnQuIGh0dHA6Ly9zdXBwb3J0LmNyZWF0aXZlaXRlbS5jb20='));
		}

		// Set the variable name we will assign the class to
		// Was a custom class name supplied? If so we'll use it
		if (empty($object_name))
		{
			$object_name = strtolower($class);
			if (isset($this->_app_varmap[$object_name]))
			{
				$object_name = $this->_app_varmap[$object_name];
			}
		}

		// Don't overwrite existing properties
		$APP =& get_instance();
		if (isset($APP->$object_name))
		{
			if ($APP->$object_name instanceof $class_name)
			{
				log_message('debug', $class_name." has already been instantiated as '".$object_name."'. Second attempt aborted.");
				return;
			}

			show_error("Resource '".$object_name."' already exists and is not a ".$class_name." instance.");
		}

		// Save the class name and object name
		$this->_classes[$object_name] = $class;

		// Instantiate the class
		$APP->$object_name = isset($config)
			? new $class_name($config)
			: new $class_name();
	}

//	--------------------------------------------------------------------

	/**
	*	APP AutoLoader
	**/
	protected function _app_autoloader()
	{
		if (file_exists(APPPATH.'config/autoload.php'))
		{
			include(APPPATH.'config/autoload.php');
		}
		
		if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/autoload.php'))
		{
			include(APPPATH.'config/'.ENVIRONMENT.'/autoload.php');
		}
		
		if ( ! isset($autoload))
		{
			return;
		}
		
		// Autoload helpers
		if (isset($autoload['helper']))
		{
			foreach ($autoload['helper'] as $item)
			{
				$this->helper($item);
			}
		}
		
		// Autoload drivers
		if (isset($autoload['drivers']))
		{
			foreach ($autoload['drivers'] as $item)
			{
				$this->driver($item);
			}
		}
		
		// Load libraries
		if (isset($autoload['libraries']) && count($autoload['libraries']) > 0)
		{
			// Load the database driver.
			if (in_array('database', $autoload['libraries']))
			{
				$this->database();
				$autoload['libraries'] = array_diff($autoload['libraries'], array('database'));
			}
			
			// Load all other libraries
			foreach ($autoload['libraries'] as $item)
			{
				$this->library($item);
			}
		}
		
		// Autoload models
		if (isset($autoload['model']))
		{
			$this->model($autoload['model']);
		}
	}

//	--------------------------------------------------------------------

	/**
	*	APP Object to Array translator
	**/
	protected function _app_object_to_array($object)
	{
		return is_object($object) ? get_object_vars($object) : $object;
	}

//	--------------------------------------------------------------------

	/**
	*	APP Component getter
	**/
	protected function &_get_component($component)
	{
		$APP =& get_instance();
		return $APP->$component;
	}

//	--------------------------------------------------------------------

	/**
	*	Prep Filename
	**/
	protected function _app_prep_filename($filename, $extension)
	{
		if ( ! is_array($filename))
		{
			return array(strtolower(str_replace(array($extension, '.php'), '', $filename).$extension));
		}
		else
		{
			foreach ($filename as $key => $val)
			{
				$filename[$key] = strtolower(str_replace(array($extension, '.php'), '', $val).$extension);
			}

			return $filename;
		}
	}

}
