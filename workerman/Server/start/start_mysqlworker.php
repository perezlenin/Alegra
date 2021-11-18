<?php  

namespace Server\start;

use \Workerman\Worker;
use \Workerman\Autoloader;

// use Server\start\worker_mysql;
// use \GatewayWorker\BusinessWorker;

/**
 * 
 */
class MysqlWorker
{
	
	private $protocol = "Text";
	private $domain = "0.0.0.0";
	private $port = "54321";
	
	private $nro_process = 2;
	private $name_process = "mysql_worker";

	private $onWorkerStart = array("Server\start\worker_mysql", 'onWorkerStart');
	private $onConnect = array("Server\start\worker_mysql", 'onConnect');
	private $onMessage = array("Server\start\worker_mysql", 'onMessage');
	private $onClose = array("Server\start\worker_mysql", 'onClose');
	private $onWorkerStop = array("Server\start\worker_mysql", 'onWorkerStop');

	private $task_worker;

	function __construct()
	{
		$this->port = (defined("PORT_MYSQL_WORKER") ? PORT_MYSQL_WORKER : $this->port);
		$this->domain = (defined("DOMAIN_MYSQL_WORKER") ? DOMAIN_MYSQL_WORKER : $this->domain);

		$this->protocol = (defined("PROTOCOL_MYSQL_WORKER") ? PROTOCOL_MYSQL_WORKER : $this->protocol);

		$this->nro_process = (defined("NRO_PROCESS_DBWORKER") ? NRO_PROCESS_DBWORKER : $this->nro_process);
		$this->name_process = (defined("NAME_DBWORKER") ? NAME_DBWORKER : $this->name_process );

		$this->StartWorker();
	}

	public function StartWorker()
	{
		$task_worker = new Worker($this->protocol."://".$this->domain.":".$this->port);
		$task_worker->count = $this->nro_process;
		$task_worker->name = $this->name_process;

		$task_worker->onWorkerStart= $this->onWorkerStart;
		$task_worker->onConnect    = $this->onConnect;
		$task_worker->onMessage    = $this->onMessage;
		$task_worker->onClose      = $this->onClose;
		$task_worker->onWorkerStop = $this->onWorkerStop;
	}
}

$mysql_worker = new MysqlWorker();

 ?>