<?php

namespace Utils;

class WebParam
{
    /**
     * @param $key
     * @return mixed
     */
    public static function post($key)
    {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

    public static function get($key)
    {
        return  isset($_GET[$key]) ? $_GET[$key] : null;
    }
}