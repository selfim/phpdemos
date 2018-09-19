<?php
class  RpcServer{
    protected $server = null;

    public function __construct($host, $port, $path)
    {
        //创建tcp服务
        $this->server = stream_socket_server("tcp://{$host}:{$port}", $errno, $errstr);
        if (!$this->server) {
            exit("{$errno} : {$errstr} \n");
        }
        //RPC服务目录是否存在
        $realPath = realpath(__DIR__ . $path);
        if ($realPath === false || !file_exists($realPath)) {
            exit("{$path} error \n");
        }
        //解析数据,执行业务逻辑
        while (true && $this->server) {
            $client = stream_socket_accept($this->server);

            if ($client) {
                //读取并解析数据
                $buf = fread($client, 2048);
                $buf = json_decode($buf, true);
                $class = $buf['class'];
                $method = $buf['method'];
                $params = $buf['params'];

                //调用服务文件
                if ($class && $method) {
                    $file = $realPath . '/' . $class . '.php';
                    if (file_exists($file)) {
                        require_once $file;
                        $obj = new $class();
                        //如果有参数，则传入指定参数
                        if (!$params) {
                            $data = $obj->$method();
                        } else {
                            $data = $obj->$method($params);
                        }
                        //返回结果
                        fwrite($client, $data);
                    }else{
                        fwrite($client,date('Y-m-d H:i:s')."\t"."[$file] Service files do not exist.");
                    }
                } else {
                    fwrite($client, 'class or method error');
                }
                //关闭客户端
                fclose($client);
            }
        }
    }



    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        fclose($this->server);
    }


}
new RpcServer('127.0.0.1', 80, './service');