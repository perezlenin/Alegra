<?php 

use \Workerman\Worker;

require_once("constants.php");
require_once("config.php");
require_once(dirname(__DIR__)."/util/util.php");
// 加载所有Applications/*/start.php，以便启动所有服务

foreach(glob(dirname(__DIR__).'/start/start*.php') as $start_file)
{
    require_once $start_file;
}

// 运行所有服务
Worker::runAll();
 ?>