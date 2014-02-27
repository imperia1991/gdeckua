<?php
class EScalarBehavior extends CActiveRecordBehavior
{
	public function scalar($attributes, $default='')
	{
		$selector = $this->Owner;
		foreach(explode('.', $attributes) as $attribute) {
			if( !isset($selector->$attribute) ) {
				$selector = $default;
				break;
			}
			$selector = $selector->$attribute;
		}
		if(is_array($selector)) {
			$scalarObj = new EArray($selector);
		} else {
			$scalarObj = new EStr($selector);
		}
		return $scalarObj();
	}
}
