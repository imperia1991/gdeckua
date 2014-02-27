<?php
class EStr extends EScalarObject
{
	function __construct($arg)
	{
		if(!is_String($arg))
			throw new Exception('Argument must be a String');
		parent::__construct($arg);
	}	
}
