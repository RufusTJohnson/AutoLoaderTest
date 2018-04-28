<?php

// *****************************************************************************
// See this stackoverflow article https://stackoverflow.com/questions/39470775/using-composers-autoloader-without-including-files
//
// See this about setting up a virtual server: http://www.nikolaynikolov.net/blog/2017/02/05/create-virtual-host-on-wamp-3/
//
// Run this: http://tests/AutoLoaderTest/
// *****************************************************************************

// *****************************************************************************
// Helpers
// *****************************************************************************

function wp_normalize_path( $path ) {
    $path = str_replace( '\\', '/', $path );
    $path = preg_replace( '|(?<=.)/+|', '/', $path );
    if ( ':' === substr( $path, 1, 1 ) ) {
        $path = ucfirst( $path );
    }
    return $path;
}

// *****************************************************************************
// Main Code
// *****************************************************************************


$userDir = wp_normalize_path(dirname(dirname(__FILE__)));
$userDir = dirname(dirname(__FILE__));

$psr4_namespaces = array(
    'Users\\Fred\\Truck\\' 			=> array($userDir . '/AutoLoaderTest/users/fredstruck'),  	// Takes you to a directory
    'Users\\Fred\\Car\\' 			=> array($userDir . '\AutoLoaderTest/users/fredscar'),		// Takes you to a directory
    'Users\\Sandra\\Truck\\' 		=> array($userDir . '/AutoLoaderTest/users/sandrastruck'),   // Takes you to a directory
    'Users\\Sandra\\Truck\\' 		=> array($userDir . '\AutoLoaderTest/users/sandrascar'),   // Takes you to a directory
    '' 								=> array($userDir . '\AutoLoaderTest/nesbot/carbon/src'),
);



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