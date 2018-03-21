<?php
function active_class( $m , $a )  
{
    if( g('m') == $m && g('a') == $a ){
        return " active ";
    }
}

function is_login()
{
    if( !headers_sent() )
        @session_start();
    
    return  intval( $_SESSION['uid'] ) > 0 ;
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

function send_json( $data )
{
    return _send_data( 0 , $data );
}

function send_error( $error )
{
    return _send_data( 1 , $error );
}

function _send_data( $code , $info )
{
    if( $code == 0 ) $ret['data'] = $info;
    else $ret['error'] = $info;

    $ret['code'] = $code;
    $ret['time'] = date("Y-m-d H:i:s");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: origin, x-requested-with, content-type');
    header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

    echo json_encode( $ret , JSON_UNESCAPED_UNICODE );

    
}

/**
 * 支持多个参数
 */
function render()
{
    // $data , $template=null
    $numargs = func_num_args();
    if( $numargs < 1 ) return false;
    elseif( $numargs == 1 )
        $html = get_render_content( func_get_arg( 0 ) );
    elseif( $numargs == 2 )
        $html = get_render_content( func_get_arg( 0 ) , func_get_arg( 1 ) );
    elseif( $numargs == 3 )
        $html = get_layout_content( func_get_arg( 0 ) , func_get_arg( 1 ) , func_get_arg( 2 )  );    
    
    if( $html ) echo $html;
}

function render_layout( $data , $layout = 'web' )
{
    if( $html = get_layout_content( $data , $layout ) )
        echo $html;
}

function get_layout_content( $data , $layout = null , $block = null )
{
    if( $layout == null ) $layout = 'web'; 
    
    $layout_path = VIEW . DS . 'layout' . DS . $layout . '.layout.php';
    
    if( $block == null ) $block = g( 'm' ) . '_' . g( 'a' ) . '.tpl.php';
    
    if( file_exists( $layout_path ) )
    {
        $data['__load'] = $block;
        $data['__layout'] = $layout;
        return get_render_content( $data , $layout_path );
    }
    

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

function get_data( $sql , $data = null , $error_number = null , $notice = null )
{
    return _db_run( $sql , $data , $error_number , $notice );
}

function run_sql( $sql , $data = null , $error_number = null , $notice = null )
{
    return _db_run( $sql , $data , $error_number , $notice , false );
}

function last_id()
{
    $pdo = pdo();
    return $pdo->lastInsertId();
}

function _db_run( $sql , $data = null , $error_number = null , $notice = null , $return  = true )
{
    try
    {
        $pdo = pdo();
        $sth = $pdo->prepare( $sql );
        $ret = $sth->execute( $data );  
        if( $return ) return $sth->fetchAll(PDO::FETCH_ASSOC);
        else return true;
    }
    catch( PDOException $Exception )
    {
        if( $error_number )
        {
            $errorInfo = $sth->errorInfo();
            if( $errorInfo[1] == 1062 )
            {
                e( $notice );
            }
        }

        return false;
    }
}