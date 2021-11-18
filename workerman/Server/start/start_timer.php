<?php 

namespace Server\start;

use \Workerman\Worker;
use \Workerman\Lib\Timer;

use Server\database\async_db;
use Server\database\class_pdo;

use Server\app\Pedidos\CPedidos;
// use Workerman\Connection\AsyncTcpConnection;
// $conect = new OracleClaim();
// $db_o = $conect->conectOracle();
$task = new Worker();
$task->name = (defined("NAME_TIMER") ? NAME_TIMER : 'time_worker');
$task->count = (defined("NRO_PROCESS_TIMER") ? NRO_PROCESS_TIMER : 1);
// $task->reloadable = false;
$task::$logFile = dirname(__DIR__).'/log/worker.log';

$task->onWorkerStart = function($task)
{
    if(defined("TIME_VERIFIER_PEDIDO")){
        $time_id_resend_msg_wsp = Timer::add(TIME_VERIFIER_PEDIDO, function() {
            $pedido = new CPedidos();
            $pedido->verificarPedidos();
        });
    }



};

 ?>
