<?php
if( !defined('DS') ) define( 'DS' , DIRECTORY_SEPARATOR );
define( "ROOT" , __DIR__ ); 
define( "FROOT" , ROOT. DS . "framework" );
define( "VIEW" , FROOT. DS . "view" );

error_reporting( E_ALL & ~E_NOTICE );

include 'vendor/autoload.php';

$GLOBALS['m'] = $m = v('m') ? v('m') : 'resume';
$class = ucfirst( strtolower( $m ) );
$GLOBALS['a'] =$a = v('a') ? v('a') : 'index';

try
{
    $controller = "FangFrame\\Controller\\".$class;
    $o = new $controller();
    if( method_exists( $o , $a ) )
        call_user_func( [ $o , $a ] );
    else
        e("Method $a NOT EXISTS");    

    // throw new Exception( "error" );
}
catch(\Exception $e )
{
    die( $e->getMessage() );
}



