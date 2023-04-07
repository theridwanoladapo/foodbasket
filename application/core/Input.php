<?php

class Input
{
	public function get($index)
	{
		return $value = isset($_GET[$index]) ? $_GET[$index] : '';
	}
	
	public function post($index)
	{
		return $value = isset($_POST[$index]) ? $_POST[$index] : '';
	}
}