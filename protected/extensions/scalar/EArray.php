<?php
class EArray extends EScalarObject implements \ArrayAccess {
	protected $container = array();

	public function __construct($s_array) {
		if(!is_array($s_array))
			throw new Exception('Argument must be an Array');	

		$this->container = $s_array;
		parent::__construct($s_array);
	}
	public function offsetSet($offset, $value) {
			if (is_null($offset)) {
					$this->container[] = $value;
			} else {
					$this->container[$offset] = $value;
			}
	}
	public function offsetExists($offset) {
			return isset($this->container[$offset]);
	}
	public function offsetUnset($offset) {
			unset($this->container[$offset]);
	}
	public function offsetGet($offset) {
			return isset($this->container[$offset]) ? $this->container[$offset] : null;
	}

	public function getVal()
	{
		return $this->container;
	}

	public function setVal($val)
	{
		$this->container = $val;
		return true;
	}

	public function __toString()
	{
		return json_encode($this->container);
	}	
}
