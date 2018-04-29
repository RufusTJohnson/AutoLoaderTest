<?php

/**
 * Parent class for car parts
 *
 * @author Sam MEla <sam@somedomain.com>
 */

namespace Users;


class CarPart
{
	
	public			$class_name;						// name of class that ultimately inherits this base class
	public			$class_info;						// class information about the class that ultimately inherits this base class
	

	
	
	// **************************************************************************
	// Constructor
	// **************************************************************************
	function __construct() 
	{
		$this->class_name 	= get_class($this);
		// https://stackoverflow.com/questions/3896384/php-how-to-get-dir-of-child-class
		$this->class_info 			= new \ReflectionClass($this);
	}
	
	// **************************************************************************
	// something
	// **************************************************************************
	public function IntroduceYourself()
	{
		echo("<br>I am ".$this->class_info->getName().".<br>");
		echo("I am located in ".$this->class_info->getFileName().".<br>");
		echo("My namespace is ".$this->class_info->getNamespaceName().".<br><br>");
		//echo("<pre>"); print_r($this)echo("</pre>"); public function getPrefixesPsr4()
	}
}
	
