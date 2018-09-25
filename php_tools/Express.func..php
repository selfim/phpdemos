<?php
class Express{
    private static $_url = "http://www.kuaidi100.com/autonumber/autoComNum?text=";
    private function getUrlContent($url){
        if(!$url||!is_string($url)) return;
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)){
            return false;
        }
        if(function_exists(file_get_contents())){
            $file_contents = file_get_contents($url);
        }else{
            $ci = curl_init();
            $timeout = 5;   // 设置5秒超时
            curl_setopt($ci, CURLOPT_URL, $url);
            curl_setopt ($ci, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ci, CURLOPT_CONNECTTIMEOUT, $timeout);
            $file_contents = curl_exec($ci);
            curl_close($ci);

        }

        return $file_contents;
    }

    public function getDataByOrder($order_sn=''){
        $url = self::$_url.$order_sn;
        $rst = $this->getUrlContent($url);
        if($rst){
            return json_decode($rst,true);
        }
    }

    public function getLogisticsInfo($order_no=''){

        $result = $this->getDataByOrder($order_no);
        if($result){
            $auto_arr = $result['auto'];
        }


        if(count($auto_arr)>0){
            foreach ($auto_arr as $key => $value){
                $temp = $this->randFloat();
                $comCode = $value['comCode'];
                $url = "http://www.kuaidi100.com/query?type=$comCode&postid=$order_no&id=1&valicode=&temp=$temp";// $temp 随机数,防止缓存
                $json = $this->getUrlContent($url);
                $data = json_decode($json,true);
                if($data['message']=='ok'){
                    return $data;
                }
            }
        }

        return false;

    }
    function randFloat($min=0, $max=1){
        return $min + mt_rand()/mt_getrandmax() * ($max-$min);
    }

}