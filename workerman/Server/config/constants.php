<?php 

define("PATH", dirname(__DIR__));
define("PATH_LOG",PATH."/log/");// log de workerman
// define("PATH_BAKCUP_DB",PATH."/backup/"); // path del backup
define("NAME_TIMER", "Timer");
define("NRO_PROCESS_TIMER", 1);

/* CONFIGURACION MYSQL WORKER */
define("NAME_DBWORKER", "MySQL_worker");
define("NRO_PROCESS_DBWORKER", 2);
define("PORT_MYSQL_WORKER",54322);
define("DOMAIN_MYSQL_WORKER","0.0.0.0");
define("PROTOCOL_MYSQL_WORKER","Text");
/* CONFIGURACION MYSQL WORKER */

/* Actualizacion del estado de los PEDIDOS */
define("TIME_VERIFIER_PEDIDO",5); // in seconds - update estado pedido

/* IPS INTERNOs*/
define("IP_RECETA","172.17.0.2");
define("IP_HISTORIAL","172.17.0.5");
define("IP_INGREDIENTE","172.17.0.4");

define("PRODUCCION", "1");
 ?>
