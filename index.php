<?php

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
*/
	define('ENVIRONMENT', 'development');

/*
*---------------------------------------------------------------
* ERROR REPORTING
*---------------------------------------------------------------
*/
if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
		{
			case 'development':
				error_reporting(E_ALL);
				ini_set('display_errors', 1);
			break;
			
			case 'testing':
			case 'production':
				error_reporting(0);
				ini_set('display_errors', 0);
				if (version_compare(PHP_VERSION, '5.3.0', '>='))
				{
					error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
				}
				else
				{
					error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
				}
			break;
			
			default:
				header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
				echo 'The application environment is not set correctly.';
				exit(1); // EXIT_ERROR
		}
}

/*
 *---------------------------------------------------------------
 * SYSTEM FOLDER NAME
 *---------------------------------------------------------------
 */
	$system_path = 'system';

/*
 *---------------------------------------------------------------
 * APPLICATION FOLDER NAME
 *---------------------------------------------------------------
 */
	$application_folder = 'application';

/*
 *---------------------------------------------------------------
 * VIEW FOLDER NAME
 *---------------------------------------------------------------
 */
	$view_folder = '';

	
/*
 *---------------------------------------------------------------
 * FILE PATH
 *---------------------------------------------------------------
 */
 
	/** The name of THIS file **/
	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
	
	/** Path to the system folder **/
	define('BASEPATH', str_replace('\\', '/', realpath($system_path)).'/');
	
	/** Path to the front controller (this file) **/
	define('FCPATH', dirname(__FILE__).'/');
	
	/** The path to the "application" folder **/
	if (is_dir($application_folder))
	{
		if (($_temp = realpath($application_folder)) !== FALSE)
		{
			$application_folder = $_temp;
		}
		
		define('APPPATH', $application_folder.DIRECTORY_SEPARATOR);
	}
	else
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
		exit(3); // EXIT_CONFIG
	}
	
	/** The path to the "application" folder **/
	if ( ! is_dir($view_folder))
	{
		if ( ! empty($view_folder) && is_dir(APPPATH.$view_folder))
		{
			if (($_temp = realpath(APPPATH.$view_folder)) !== FALSE)
			{
				$view_folder = $_temp.DIRECTORY_SEPARATOR;
			}
		}
		elseif (is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR))
		{
			$view_folder = APPPATH.'views'.DIRECTORY_SEPARATOR;
		}
		else
		{
			header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
			echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
			exit(3); // EXIT_CONFIG
		}
	}
	
	define('VIEWPATH', $view_folder);


/*
 *---------------------------------------------------------------
 * COMMON FUNCTIONS
 *---------------------------------------------------------------
 */
 
	/** Is HTTPS **/
	function is_https()
	{
		if ( ! empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off'):
			return TRUE;
		endif;
		
		return FALSE;
	}
	
	/** Base URL **/
	function base_url()
	{
		if (isset($_SERVER['HTTP_HOST'])):
			$base_url = (is_https() ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST']
						.substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], basename($_SERVER['SCRIPT_FILENAME'])));
		endif;
		
		return $base_url;
	}
	
	/** Redirect **/
	function redirect($uri = '', $method = 'auto', $code = NULL)
	{
		if ($method === 'auto'):
			$method = 'refresh';
		endif;
		
		switch ($method)
		{
			case 'refresh':
				header('Refresh:0;url='.$uri);
				break;
			default:
				header('Location: '.$uri, TRUE, $code);
				break;
		}
		exit;
	}
	

/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 */
	require_once APPPATH.'/App.php';
	
