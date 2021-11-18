<?php 

/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| 
 */

$config["default"] = array(
		'host'      => '172.17.0.3',
	    'driver'    => 'mysql',
	    'database'  => 'alegra',
	    'port'  	=> '3306',
	    'username'  => 'root',
	    'password'  => 'Swlagiu5159753.',
	    'charset'   => 'utf8',
	    'collation' => 'utf8_general_ci',
	    'prefix'    => '',
	    'path'     	=> "log/Database.log",
	    'log_query'	=>false,
	    'reporting_db'=>
	    		array(
	    			"email_to"=>array("email@hotmail.com","test"),
	    			"password"=>"null",
	    			"email_config"=>"email@gmail.com",
	    			"port_smtp"=>"456"
	    		)
	    );
 ?>