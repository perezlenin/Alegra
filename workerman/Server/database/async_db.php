<?php 

namespace Server\database;
/**
 * 
 */

use \Workerman\Connection\AsyncTcpConnection;

class async_db
{
    
    // private $data;

    private $protocol = "Text";
    private $domain = "127.0.0.1";
    private $port = "54321";

    private $task_connection = null;

    function __construct()
    {
        $this->protocol = (defined("PROTOCOL_MYSQL_WORKER") ? PROTOCOL_MYSQL_WORKER : $this->protocol);
        $this->domain = (defined("DOMAIN_MYSQL_WORKER") ? DOMAIN_MYSQL_WORKER : $this->domain);
        $this->port = (defined("PORT_MYSQL_WORKER") ? PORT_MYSQL_WORKER : $this->port);

        $this->task_connection = new AsyncTcpConnection($this->protocol."://".$this->domain.":".$this->port);
    }

    public function query($query,$param = array(),$callback)
    {
        // $task_connection = new AsyncTcpConnection('Text://127.0.0.1:54321');
        // $task_connection = new AsyncTcpConnection($this->protocol."://".$this->domain.":".$this->port);

        $this->task_connection->onConnect = function($async_task_connection) use ($query,$param){

            $async_task_connection->send(json_encode(array("query"=>$query,"param"=>$param)));
        };

        $this->task_connection->onMessage = $callback;
        // Connect asynchronously.
        $this->task_connection->connect();
        // return $data;
    }
}

 ?>