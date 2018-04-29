<?php

/**
 * This file provides test support for experimenting with the Composer
 * psr4 autoloader.
 *
 * @author Sam MEla <sam@somedomain.com>
 * @see    http://www.php-fig.org/psr/psr-0/
 * @see    http://www.php-fig.org/psr/psr-4/
 *
 * http://tests/AutoLoaderTest/autoloader_test_support.php
 */
 
require __DIR__ . '/ClassLoader.php';


class autoloader_test_support
{
	
	// Loader stuff
	public			$loader;
	private 			$fallbackDirsPsr0 = array();
	
	public			$relative_psr4_namespaces = array(
		'Users\\Fred\\Truck\\' 			=> array('/AutoLoaderTest/users/fredstruck'),  	// Takes you to a directory
		'Users\\Fred\\Car\\' 			=> array('/AutoLoaderTest/users/fredscar'),		// Takes you to a directory
		'Users\\Sandra\\Truck\\' 		=> array('/AutoLoaderTest/users/sandrastruck'), // Takes you to a directory
		'Users\\Sandra\\Truck\\' 		=> array('/AutoLoaderTest/users/sandrascar'),   // Takes you to a directory
		'Users\\' 								=> array('/AutoLoaderTest/users'),   				// Takes you to a directory
		'' 									=> array('/AutoLoaderTest/nesbot/carbon/src'),
	);	
	
	public			$absolute_psr4_namespaces = array();	

	
	
	// **************************************************************************
	// Constructor
	// **************************************************************************
	function __construct() 
	{
		$this->loader 		= new \Composer\Autoload\ClassLoader();
		$this->userDir 	= dirname(dirname(__FILE__));
		$this->build_absolute_namespace_array();
	}
	
	// **************************************************************************
	// Build absolute namespace array
	// **************************************************************************
    public function build_absolute_namespace_array()
    {
		$this->absolute_psr4_namespaces = array();
		foreach ($this->relative_psr4_namespaces as $namespace => $path ) 
		{
			$this->absolute_psr4_namespaces[$namespace] = array($this->userDir . $path[0]);    
		}
	}

	// **************************************************************************
	// Program the Auto Loader
	// **************************************************************************
    public function program_the_autoloader()
    {
		foreach ($this->absolute_psr4_namespaces as $namespace => $path ) 
		{
			$this->loader->setPsr4( $namespace, $path );
		}
		$this->loader->register( true );
	}
	
	

}
	




$autoloader_tester = new autoloader_test_support();
$autoloader_tester->program_the_autoloader();

$fredstruck_engine = new 	\Users\Fred\Truck\engine();
$fredstruck_engine->IntroduceYourself();

$fredscar_engine = new 	\Users\Fred\Car\engine();
$fredscar_engine->IntroduceYourself();

$fredscar_insurance = new \Users\Fred\Car\insurance\guyco();

echo("<pre>"); print_r($autoloader_tester); echo("</pre>");
exit("done"); 

// *****************************************************************************
// Main Code
// *****************************************************************************


$userDir = wp_normalize_path(dirname(dirname(__FILE__)));
$userDir = dirname(dirname(__FILE__));





echo("Autoloader<br>");



require __DIR__ . '/ClassLoader.php';
$loader = new \Composer\Autoload\ClassLoader();


foreach ($psr4_namespaces as $namespace => $path ) {
	$loader->setPsr4( $namespace, $path );
}

$loader->register( true ); echo("<br>loaded<br>");

echo("<pre>"); print_r($loader); echo("</pre>");
$fredstruck_engine = new 	\Users\Fred\Truck\engine();


$fredscar_engine = new 	\Users\Fred\Car\engine();
$fredscar_insurance = new \Users\Fred\Car\insurance\guyco();

//echo("<br>"."__FILE__".__FILE__."<br>");
//echo("<br>"."dirname(__FILE__)".dirname(__FILE__)."<br>");
//cho("<br>"."dirname(dirname(__FILE__))".dirname(dirname(__FILE__))."<br>");



//$userDir = dirname(dirname(__FILE__));
//$baseDir = dirname($userDir);






exit("done");

call_user_func( function() {
    $loader = new \Composer\Autoload\ClassLoader();

    foreach ( require __DIR__ . '/../vendor/composer/autoload_namespaces.php' as $namespace => $path ) {
        $loader->set( $namespace, $path );
    }

    foreach ( require __DIR__ . '/../vendor/composer/autoload_psr4.php' as $namespace => $path ) {
        $loader->setPsr4( $namespace, $path );
    }

    $classMap = require __DIR__ . '/../vendor/composer/autoload_classmap.php';

    if ( $classMap ) {
        $loader->addClassMap( $classMap );
    }

    $loader->register( true );
} );