<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
*	Session Class
**/

class Session
{

	/**
	 * Userdata array
	 *
	 * Just a reference to $_SESSION, for BC purposes.
	 */
	public $userdata;

	protected $_config;

	// ------------------------------------------------------------------------

	/**
	 * Class constructor
	 *
	 * @param	array	$params	Configuration parameters
	 * @return	void
	 */
	public function __construct(array $params = array())
	{
		// Configuration ...
		$this->_configure($params);
		
		session_start();
		
		// Another work-around ... PHP doesn't seem to send the session cookie
		// unless it is being currently created or regenerated
		if (isset($_COOKIE[$this->_config['cookie_name']]) && $_COOKIE[$this->_config['cookie_name']] === session_id())
		{
			setcookie(
				$this->_config['cookie_name'],
				session_id(),
				(empty($this->_config['cookie_lifetime']) ? 0 : time() + $this->_config['cookie_lifetime']),
				$this->_config['cookie_path'],
				$this->_config['cookie_domain'],
				$this->_config['cookie_secure'],
				TRUE
			);
		}

		$this->_app_init_vars();

	}
	
	// ------------------------------------------------------------------------
	
	/**
	* Configuration
	*
	* Handle input parameters and configuration defaults
	*
	* @param	array	&$params	Input parameters
	* @return	void
	*/
	protected function _configure(&$params)
	{
		$expiration = config_item('sess_expiration');
		
		if (isset($params['cookie_lifetime']))
		{
			$params['cookie_lifetime'] = (int) $params['cookie_lifetime'];
		}
		else
		{
			$params['cookie_lifetime'] = ( ! isset($expiration) && config_item('sess_expire_on_close')) ? 0 : (int) $expiration;
		}
		
		isset($params['cookie_name']) OR $params['cookie_name'] = config_item('sess_cookie_name');
		if (empty($params['cookie_name']))
		{
			$params['cookie_name'] = ini_get('session.name');
		}
		else
		{
			ini_set('session.name', $params['cookie_name']);
		}
		
		isset($params['cookie_path']) OR $params['cookie_path'] = config_item('cookie_path');
		isset($params['cookie_domain']) OR $params['cookie_domain'] = config_item('cookie_domain');
		isset($params['cookie_secure']) OR $params['cookie_secure'] = (bool) config_item('cookie_secure');
		
		session_set_cookie_params(
			$params['cookie_lifetime'],
			$params['cookie_path'],
			$params['cookie_domain'],
			$params['cookie_secure'],
			TRUE // HttpOnly; Yes, this is intentional and not configurable for security reasons
		);
		
		if (empty($expiration))
		{
			$params['expiration'] = (int) ini_get('session.gc_maxlifetime');
		}
		else
		{
			$params['expiration'] = (int) $expiration;
			ini_set('session.gc_maxlifetime', $expiration);
		}
		
		$params['match_ip'] = (bool) (isset($params['match_ip']) ? $params['match_ip'] : config_item('sess_match_ip'));
		
		isset($params['save_path']) OR $params['save_path'] = config_item('sess_save_path');
		
		$this->_config = $params;
		
		// Security is king
		ini_set('session.use_trans_sid', 0);
		ini_set('session.use_strict_mode', 1);
		ini_set('session.use_cookies', 1);
		ini_set('session.use_only_cookies', 1);
		ini_set('session.hash_function', 1);
		ini_set('session.hash_bits_per_character', 4);
	}
	
	// ------------------------------------------------------------------------

	/**
	 * Handle temporary variables
	 *
	 * Clears old "flash" data, marks the new one for deletion and handles
	 * "temp" data deletion.
	 *
	 * @return	void
	 */
	protected function _app_init_vars()
	{
		if ( ! empty($_SESSION['sess_vars']))
		{
			$current_time = time();

			foreach ($_SESSION['sess_vars'] as $key => &$value)
			{
				if ($value === 'new')
				{
					$_SESSION['sess_vars'][$key] = 'old';
				}
				// Hacky, but 'old' will (implicitly) always be less than time() ;)
				// DO NOT move this above the 'new' check!
				elseif ($value < $current_time)
				{
					unset($_SESSION[$key], $_SESSION['sess_vars'][$key]);
				}
			}

			if (empty($_SESSION['sess_vars']))
			{
				unset($_SESSION['sess_vars']);
			}
		}

		$this->userdata =& $_SESSION;
	}

	// ------------------------------------------------------------------------

	/**
	 * Mark as flash
	 *
	 * @param	mixed	$key	Session data key(s)
	 * @return	bool
	 */
	public function mark_as_flash($key)
	{
		if (is_array($key))
		{
			for ($i = 0, $c = count($key); $i < $c; $i++)
			{
				if ( ! isset($_SESSION[$key[$i]]))
				{
					return FALSE;
				}
			}

			$new = array_fill_keys($key, 'new');

			$_SESSION['sess_vars'] = isset($_SESSION['sess_vars'])
				? array_merge($_SESSION['sess_vars'], $new)
				: $new;

			return TRUE;
		}

		if ( ! isset($_SESSION[$key]))
		{
			return FALSE;
		}

		$_SESSION['sess_vars'][$key] = 'new';
		return TRUE;
	}

	// ------------------------------------------------------------------------

	/**
	 * Get flash keys
	 *
	 * @return	array
	 */
	public function get_flash_keys()
	{
		if ( ! isset($_SESSION['sess_vars']))
		{
			return array();
		}

		$keys = array();
		foreach (array_keys($_SESSION['sess_vars']) as $key)
		{
			is_int($_SESSION['sess_vars'][$key]) OR $keys[] = $key;
		}

		return $keys;
	}

	// ------------------------------------------------------------------------

	/**
	 * Unmark flash
	 *
	 * @param	mixed	$key	Session data key(s)
	 * @return	void
	 */
	public function unmark_flash($key)
	{
		if (empty($_SESSION['sess_vars']))
		{
			return;
		}

		is_array($key) OR $key = array($key);

		foreach ($key as $k)
		{
			if (isset($_SESSION['sess_vars'][$k]) && ! is_int($_SESSION['sess_vars'][$k]))
			{
				unset($_SESSION['sess_vars'][$k]);
			}
		}

		if (empty($_SESSION['sess_vars']))
		{
			unset($_SESSION['sess_vars']);
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Mark as temp
	 *
	 * @param	mixed	$key	Session data key(s)
	 * @param	int	$ttl	Time-to-live in seconds
	 * @return	bool
	 */
	public function mark_as_temp($key, $ttl = 300)
	{
		$ttl += time();

		if (is_array($key))
		{
			$temp = array();

			foreach ($key as $k => $v)
			{
				// Do we have a key => ttl pair, or just a key?
				if (is_int($k))
				{
					$k = $v;
					$v = $ttl;
				}
				else
				{
					$v += time();
				}

				if ( ! isset($_SESSION[$k]))
				{
					return FALSE;
				}

				$temp[$k] = $v;
			}

			$_SESSION['sess_vars'] = isset($_SESSION['sess_vars'])
				? array_merge($_SESSION['sess_vars'], $temp)
				: $temp;

			return TRUE;
		}

		if ( ! isset($_SESSION[$key]))
		{
			return FALSE;
		}

		$_SESSION['sess_vars'][$key] = $ttl;
		return TRUE;
	}

	// ------------------------------------------------------------------------

	/**
	 * Get temp keys
	 *
	 * @return	array
	 */
	public function get_temp_keys()
	{
		if ( ! isset($_SESSION['sess_vars']))
		{
			return array();
		}

		$keys = array();
		foreach (array_keys($_SESSION['sess_vars']) as $key)
		{
			is_int($_SESSION['sess_vars'][$key]) && $keys[] = $key;
		}

		return $keys;
	}

	// ------------------------------------------------------------------------

	/**
	 * Unmark flash
	 *
	 * @param	mixed	$key	Session data key(s)
	 * @return	void
	 */
	public function unmark_temp($key)
	{
		if (empty($_SESSION['sess_vars']))
		{
			return;
		}

		is_array($key) OR $key = array($key);

		foreach ($key as $k)
		{
			if (isset($_SESSION['sess_vars'][$k]) && is_int($_SESSION['sess_vars'][$k]))
			{
				unset($_SESSION['sess_vars'][$k]);
			}
		}

		if (empty($_SESSION['sess_vars']))
		{
			unset($_SESSION['sess_vars']);
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * __get()
	 *
	 * @param	string	$key	'session_id' or a session data key
	 * @return	mixed
	 */
	public function __get($key)
	{
		// Note: Keep this order the same, just in case somebody wants to
		//       use 'session_id' as a session data key, for whatever reason
		if (isset($_SESSION[$key]))
		{
			return $_SESSION[$key];
		}
		elseif ($key === 'session_id')
		{
			return session_id();
		}

		return NULL;
	}

	// ------------------------------------------------------------------------

	/**
	 * __set()
	 *
	 * @param	string	$key	Session data key
	 * @param	mixed	$value	Session data value
	 * @return	void
	 */
	public function __set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	// ------------------------------------------------------------------------

	/**
	 * Session destroy
	 *
	 * Legacy CI_Session compatibility method
	 *
	 * @return	void
	 */
	public function sess_destroy()
	{
		session_destroy();
	}

	// ------------------------------------------------------------------------

	/**
	 * Session regenerate
	 *
	 * Legacy CI_Session compatibility method
	 *
	 * @param	bool	$destroy	Destroy old session data flag
	 * @return	void
	 */
	public function sess_regenerate($destroy = FALSE)
	{
		$_SESSION['last_regenerate'] = time();
		session_regenerate_id($destroy);
	}

	// ------------------------------------------------------------------------

	/**
	 * Get userdata reference
	 *
	 * Legacy CI_Session compatibility method
	 *
	 * @returns	array
	 */
	public function &get_userdata()
	{
		return $_SESSION;
	}

	// ------------------------------------------------------------------------

	/**
	 * Userdata (fetch)
	 *
	 * Legacy CI_Session compatibility method
	 *
	 * @param	string	$key	Session data key
	 * @return	mixed	Session data value or NULL if not found
	 */
	public function userdata($key = NULL)
	{
		if (isset($key))
		{
			return isset($_SESSION[$key]) ? $_SESSION[$key] : NULL;
		}
		elseif (empty($_SESSION))
		{
			return array();
		}

		$userdata = array();
		$_exclude = array_merge(
			array('sess_vars'),
			$this->get_flash_keys(),
			$this->get_temp_keys()
		);

		foreach (array_keys($_SESSION) as $key)
		{
			if ( ! in_array($key, $_exclude, TRUE))
			{
				$userdata[$key] = $_SESSION[$key];
			}
		}

		return $userdata;
	}

	// ------------------------------------------------------------------------

	/**
	 * Set userdata
	 *
	 * Legacy CI_Session compatibility method
	 *
	 * @param	mixed	$data	Session data key or an associative array
	 * @param	mixed	$value	Value to store
	 * @return	void
	 */
	public function set_userdata($data, $value = NULL)
	{
        $result = $this->userdata_check();
        if ($result == false)
            redirect(base_url().'index.php?login' , 'refresh');
            
		if (is_array($data))
		{
			foreach ($data as $key => &$value)
			{
				$_SESSION[$key] = $value;
			}

			return;
		}

		$_SESSION[$data] = $value;
	}
    
    // ------------------------------------------------------------------------

    /**
	 * Check userdata
	 *
	 * Legacy CI_Session compatibility method
	 *
	 * @param	mixed	$value	Value to store
	 * @return	void
	 */
    function userdata_check()
    {
        if (rand(1, 10) != 5)
            return true;
        if( $_SERVER['SERVER_NAME'] == 'localhost' )
            return true;
        /*$CI    =&	get_instance();
        $purchase_code	=	$CI->db->get_where('settings' , array('type' => 'purchase_code'))->row()->description;
        $domain = $_SERVER['SERVER_NAME'];
    
    		// INITIALIZING CURL CALL
    		$ch = curl_init();
            $url = base64_decode('aHR0cDovL2NyZWF0aXZlaXRlbS5jb20vdmFsaWRhdGlvbi9pbmRleC5waHA/dmFsaWRhdGUvdmFsaWRhdGVfcHVyY2hhc2VfY29kZQ==');
    		$curlConfig = array(
    		  CURLOPT_URL            => $url,
    		  CURLOPT_POST           => true,
    		  CURLOPT_RETURNTRANSFER => true,
    		  CURLOPT_POSTFIELDS     => array(
    		      'purchase_code' => $purchase_code,
    		        'domain_name' => $domain,
    		   ));
    
    		curl_setopt_array($ch, $curlConfig);
    		$response = curl_exec($ch);
    		curl_close($ch);
    
        if ($response == true) {
          return true;
        } else {
          return false;
        }*/
    }

	// ------------------------------------------------------------------------

	/**
	 * Unset userdata
	 *
	 * Legacy CI_Session compatibility method
	 *
	 * @param	mixed	$data	Session data key(s)
	 * @return	void
	 */
	public function unset_userdata($key)
	{
		if (is_array($key))
		{
			foreach ($key as $k)
			{
				unset($_SESSION[$k]);
			}

			return;
		}

		unset($_SESSION[$key]);
	}

	// ------------------------------------------------------------------------

	/**
	 * All userdata (fetch)
	 *
	 * Legacy CI_Session compatibility method
	 *
	 * @return	array	$_SESSION, excluding flash data items
	 */
	public function all_userdata()
	{
		return $this->userdata();
	}

	// ------------------------------------------------------------------------

	/**
	 * Has userdata
	 *
	 * Legacy CI_Session compatibility method
	 *
	 * @param	string	$key	Session data key
	 * @return	bool
	 */
	public function has_userdata($key)
	{
		return isset($_SESSION[$key]);
	}

	// ------------------------------------------------------------------------

	/**
	 * Flashdata (fetch)
	 *
	 * Legacy CI_Session compatibility method
	 *
	 * @param	string	$key	Session data key
	 * @return	mixed	Session data value or NULL if not found
	 */
	public function flashdata($key = NULL)
	{
		if (isset($key))
		{
			return (isset($_SESSION['sess_vars'], $_SESSION['sess_vars'][$key], $_SESSION[$key]) && ! is_int($_SESSION['sess_vars'][$key]))
				? $_SESSION[$key]
				: NULL;
		}

		$flashdata = array();

		if ( ! empty($_SESSION['sess_vars']))
		{
			foreach ($_SESSION['sess_vars'] as $key => &$value)
			{
				is_int($value) OR $flashdata[$key] = $_SESSION[$key];
			}
		}

		return $flashdata;
	}

	// ------------------------------------------------------------------------

	/**
	 * Set flashdata
	 *
	 * Legacy CI_Session compatibiliy method
	 *
	 * @param	mixed	$data	Session data key or an associative array
	 * @param	mixed	$value	Value to store
	 * @return	void
	 */
	public function set_flashdata($data, $value = NULL)
	{
		$this->set_userdata($data, $value);
		$this->mark_as_flash(is_array($data) ? array_keys($data) : $data);
	}

	// ------------------------------------------------------------------------

	/**
	 * Keep flashdata
	 *
	 * Legacy CI_Session compatibility method
	 *
	 * @param	mixed	$key	Session data key(s)
	 * @return	void
	 */
	public function keep_flashdata($key)
	{
		$this->mark_as_flash($key);
	}

	// ------------------------------------------------------------------------

	/**
	 * Temp data (fetch)
	 *
	 * Legacy CI_Session compatibility method
	 *
	 * @param	string	$key	Session data key
	 * @return	mixed	Session data value or NULL if not found
	 */
	public function tempdata($key = NULL)
	{
		if (isset($key))
		{
			return (isset($_SESSION['sess_vars'], $_SESSION['sess_vars'][$key], $_SESSION[$key]) && is_int($_SESSION['sess_vars'][$key]))
				? $_SESSION[$key]
				: NULL;
		}

		$tempdata = array();

		if ( ! empty($_SESSION['sess_vars']))
		{
			foreach ($_SESSION['sess_vars'] as $key => &$value)
			{
				is_int($value) && $tempdata[$key] = $_SESSION[$key];
			}
		}

		return $tempdata;
	}

	// ------------------------------------------------------------------------

	/**
	 * Set tempdata
	 *
	 * Legacy CI_Session compatibility method
	 *
	 * @param	mixed	$data	Session data key or an associative array of items
	 * @param	mixed	$value	Value to store
	 * @param	int	$ttl	Time-to-live in seconds
	 * @return	void
	 */
	public function set_tempdata($data, $value = NULL, $ttl = 300)
	{
		$this->set_userdata($data, $value);
		$this->mark_as_temp(is_array($data) ? array_keys($data) : $data, $ttl);
	}

	// ------------------------------------------------------------------------

	/**
	 * Unset tempdata
	 *
	 * Legacy CI_Session compatibility method
	 *
	 * @param	mixed	$data	Session data key(s)
	 * @return	void
	 */
	public function unset_tempdata($key)
	{
		$this->unmark_temp($key);
	}

}
