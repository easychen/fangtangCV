<?php
function active_class( $link )  
{
    if( $link == ltrim( $_SERVER['SCRIPT_NAME'] , '/' ) ){
        return " active ";
    }
}

function c( $key )
{
    return isset( $GLOBALS['FFCONFIG'][$key] ) ? $GLOBALS['FFCONFIG'][$key] : false;
}

function g( $key )
{
    return isset( $GLOBALS[$key] ) ? $GLOBALS[$key] : false;
}

function v( $key )
{
    return isset( $_REQUEST[$key] ) ? $_REQUEST[$key] : false;
}

function e( $message )
{
    throw new Exception( $message );
}

function render( $data , $template=null )
{
    if( $html = get_render_content( $data , $template ) ) echo $html;
}

function get_render_content( $data , $template=null )
{
    if( $template == null ) 
        $template = VIEW . DS . g('m') . '_' . g('a') . '.tpl.php'; 

    if( !file_exists( $template ) )
    {
        throw new Exception("模板不存在:".$template);
        return false;
    }    

    ob_start();
    extract( $data );
    require $template;
    $out = ob_get_contents();
    ob_end_clean();

    return $out;
}

function pdo()
{
    if( !isset( $GLOBALS['FF_PDO'] ) )
    {
        $GLOBALS['FF_PDO'] = new PDO(c('DSN'), c('MYSQL_USER'), c('MYSQL_PASSWORD'));
        if( $GLOBALS['FF_PDO'] ) $GLOBALS['FF_PDO']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    return $GLOBALS['FF_PDO'];
}

function get_data( $sql , $data = null )
{
    $pdo = pdo();
    $sth = $pdo->prepare( $sql );
    $ret = $sth->execute( $data );
    return  $sth->fetchAll(PDO::FETCH_ASSOC);
}