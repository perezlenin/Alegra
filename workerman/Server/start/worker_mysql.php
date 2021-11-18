<?php 

namespace Server\start;

class worker_mysql{

    private static $cnx = null;

    static $path_log = "worker_mysql/log_mysql_conect";

    static $title_log = "LOG CONECT MYSQL";

    public function __construct(){
        // 假设数据库连接类是MyDbClass
        
    }

    public static function onWorkerStart($worker)
    {
        global $config;
        // var_dump($config);
        $host = $config['default']['host'];
        $db   = $config['default']['database'];
        $user = $config['default']['username'];
        $pass = $config['default']['password'];
        $port = $config['default']['port'];
        $charset = $config['default']['charset'];

        try{
            self::$cnx = new \Workerman\MySQL\Connection($host, $port, $user, $pass, $db,$charset);
        } catch (\PDOException $e) {
            // throw new \PDOException($e->getMessage(), (int)$e->getCode());
            save_log_file(htmlentities($e->getMessage(), ENT_QUOTES),self::$path_log,self::$title_log);
        }

    }

    public static function onConnect($connection){
        // echo "... conected ".time()."\n";
    }
    public static function onMessage($connection, $task_data) {
        $task_data = json_decode($task_data);
        $tmp_query = explode("?", $task_data->query);
        $new_sql = '';
        if(!empty($tmp_query) && !empty($task_data->param)){
            $last_sql = $tmp_query[count($tmp_query)-1];
            array_pop($tmp_query);
            foreach ($tmp_query as $key => $value) {
                $new_sql .= $value.":a_".$key;
                
                $task_data->param["a_".$key] = $task_data->param[$key];
                unset($task_data->param[$key]);
            }
            $new_sql .= $last_sql;
        }else{
            $new_sql = $task_data->query;
        }
        // var_dump($new_sql);
        $data = self::$cnx->query(trim($new_sql),(!empty($task_data->param) ? $task_data->param : null));
        $connection->send((is_array($data) ? json_encode($data) : $data));
        $connection->close();
    }
    public static function onClose($connection){}
    public static function onWorkerStop($connection){}
}


 ?>