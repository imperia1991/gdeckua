# EScalar

Provides Scalar Objects for your Yii model attributes. The best part is that you can use any of PHP's built in string / array functions!
  
*Currently Scalar supports strings and arrays but future versions will support integers and floats.  
*This library requires PHP 5.3 or greater.  

## Install

1. Place Scalar in your extensions directory
2. Update your application config

```php
'import'=>array(
	'ext.Scalar.*',
);
```

3. Attach the EScalarBehavior to your model or base model

```php
public function behaviors()
{
	return array(
		'EScalarBehavior'=>'ext.Scalar.EScalarBehavior',
	);
}
```

## Examples

###Simple string manipulation
Where name is an attribute of MyModel

```php
$model = MyModel::model()->findByPk(1);

echo $model->scalar('name')->strtoupper();
echo $model->scalar('name')->substr(0, -1);
```

###Output chaining

```php
echo $model->scalar('name')->substr(0, -1)->strtoupper();
echo $model->scalar('name')->substr(0, -1)->strtoupper()->trim();
```

###Output chaining with model relations
Where contact is a relation of $model and full_name is an attribute of contact
```php
echo $model->scalar('contact.full_name')->strtolower()->explode(' ')[0];
echo $model->scalar('contact.full_name')->strtolower()->explode(' ')->implode('|');
```

###Optional default values
You may pass an optional default value when attributes are null or empty

```php
//If model.contact.full_name is empty or null the value 'first last' will be used.
echo $model->scalar('contact.full_name', 'first last')->strtolower()->explode(' ')[0];
```


###Haystack management

By default Scalar maps you're string/array to the first param of the PHP function you are executing. This as you know is not sufficient, luckily Scalar provides two methods for resolving this. The first is by using a token and the second is using a class called MethodMapper. Lets take a look at the token replacement 

####Haystack token replacement
You can change the default behavior by using the token '___'.


```php
	echo $model->scalar('name')->str_replace('Evan', 'Darren', '___');
	echo $model->scalar('name')->explode(' ', '___')[0];
```

####Using EMethodMapper
Once you map the Haystack in the EMethodMapper class you will no longer need to use the token (tokens will still work).

```php
class EMethodMapper
{
	public static $method_map = array(
		"str_replace" => array('haystack'=>3),
		"explode" => array('haystack'=>2),
		"implode" => array('haystack'=>2),
	);	
}
```

```php
	echo $model->scalar('name')->str_replace('Evan', 'Darren');
	echo $model->scalar('name')->explode(' ')[0];
	echo $model->scalar('name')->explode(' ')->implode('|');
```
