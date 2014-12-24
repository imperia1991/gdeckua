<?php
class EScalarObject extends EMethodMapper
{
	private $_val;

	function __construct($arg)
	{
		$this->_val = $arg;
	}

	public function __call($name, $arguments)
	{	
		$val = $this->_val;
		$haystack_found = false;
		
		array_walk($arguments,  function(&$arg) use($val, &$haystack_found) {
			if($arg === 0) {
				$arg = '0'; //Fixes issue that keeps zero value args from being passed
			} else if($arg == '___') { 	
				$arg = $val;
				$haystack_found = true;
			}
		});	

		if(!$haystack_found) {
			if( !isset($this::$method_map[$name]) ) {
				array_unshift($arguments, $val);
				$arguments[0] = &$val; //Fixes call time pass by reference deprecated warning
			}
			else {
				array_splice( $arguments, ($this::$method_map[$name]['haystack'] -1), 0, array($val) );
				$arguments[($this::$method_map[$name]['haystack'] -1)] = &$val; //Fixes call time pass by reference deprecated warning
			}
		}

		$result = call_user_func_array($name, $arguments);
		if($val == $this->_val) //If the Value is unchanged then we return the result
			return $result;
		else //If the Value has changed we know that the PHP function takes the value as a ref aand return the val
			return $val;
	}

	public function __invoke()
	{
		return new EPipe($this);
	}

	public function __toString()
	{
		return (String) $this->_val;
	}

	public function getVal()
	{
		return (String) $this->_val;
	}

	public function setVal($val)
	{
		$this->_val = $val;
		return true;
	}
}
