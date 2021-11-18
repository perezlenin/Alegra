<?php 

function save_log($log_msg = '')
{
    $titulo = "ID\tESTADO_ACTUAL\t==>\tNUEVO_ESTADO";
    save_log_file($log_msg,"claims/log_status_claim",$titulo);
}

function exception_handler($excepción) {
  $msg = "EXCEPTION: ".$excepción->getMessage();
  save_log_file($msg,"exception_error","");
}

function error_handler($errno, $errstr, $errfile = '', $errline = '')
{
    $msg = "";
    switch ($errno) {
        case E_ERROR :
            $msg .= "E_ERROR: [$errno] $errstr ";
            break;
        case E_WARNING :
            $msg .= "E_WARNING: [$errno] $errstr ";
            break;
        case E_PARSE :
            $msg .= "E_PARSE : [$errno] $errstr ";
            break;
        case E_CORE_ERROR:
            $msg .= "E_CORE_ERROR: [$errno] $errstr ";
            break;
        case E_CORE_WARNING:
            $msg .= "E_CORE_WARNING: [$errno] $errstr ";
            break;
        case E_COMPILE_ERROR:
            $msg .= "E_COMPILE_ERROR: [$errno] $errstr ";
            break;
        case E_COMPILE_WARNING:
            $msg .= "E_COMPILE_WARNING: [$errno] $errstr ";
            break;
        case E_USER_ERROR:
            $msg .= "E_USER_ERROR: [$errno] $errstr ";
            break;
        case E_USER_WARNING:
            $msg .= "E_USER_WARNING: [$errno] $errstr ";
            break;
        case E_USER_NOTICE:
            $msg .= "E_USER_NOTICE: [$errno] $errstr ";
            break;
        case E_STRICT:
            $msg .= "E_STRICT : [$errno] $errstr ";
            break;
        case E_RECOVERABLE_ERROR:
            $msg .= "E_RECOVERABLE_ERROR: [$errno] $errstr ";
            break;
        case E_DEPRECATED:
            $msg .= "E_DEPRECATED: [$errno] $errstr ";
            break;
        case E_USER_DEPRECATED:
            $msg .= "E_USER_DEPRECATED: [$errno] $errstr ";
            break;
        case E_ALL:
            $msg .= "E_ALL : [$errno] $errstr ";
            break;
        case E_NOTICE :
            $msg .= "E_NOTICE: [$errno] $errstr ";
            break;
        default:
            $msg .= "ERROR UNKNOW: [$errno] $errstr ";
            break;
    }
    $msg .="En la línea $errline en el archivo $errfile\n";
    save_log_file($msg,"errors/exception_error","");
    /* No ejecutar el gestor de errores interno de PHP */
    return true;
}

function save_log_file($msg,$namefile,$titulo = '')
{
    $tmp_dir = PATH_LOG;
    if(!defined("PATH_LOG")){
        $tmp_dir = dirname(__DIR__)."/log/";
    }
    $ext = explode("/", $namefile);
    if(count($ext) >=2){
        // eliminar el ultimo
        unset($ext[count($ext)-1]);
        $tmp_ext = implode("/", $ext);
    }
    if (!file_exists($tmp_dir.$tmp_ext)) 
    {
        // create directory/folder uploads.
        mkdir($tmp_dir.$tmp_ext, 0777, true);
    }
    $log_file_data = $tmp_dir.$namefile."_".date('d-M-Y').'.log';
    $now = "[".date("Y-m-d G:i:s")."]\t";
    if(!file_exists($log_file_data)){
        file_put_contents($log_file_data, "DATETIME\t\t\t".$titulo . "\n", FILE_APPEND);
        file_put_contents($log_file_data, $now.$msg. "\n", FILE_APPEND);
    }else{
        file_put_contents($log_file_data, $now.$msg. "\n", FILE_APPEND);
    }

}

// set_error_handler('error_handler');
// ob_start('error_handler');
// set_exception_handler('exception_handler');


 ?>
