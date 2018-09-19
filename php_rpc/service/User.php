<?php
class User{
    /**
     * 获取用户ID
     * @return int
     */
    public function getUserId(){
        return 111;
    }

    /**
     * 获取用户信息
     * @param $param
     * @return mixed|string
     */
    public function getUserInfo($params)
    {
        return json_encode($params);
    }
}