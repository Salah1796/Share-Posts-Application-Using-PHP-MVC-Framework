<?php
class Validate
{

    public static function is_Empty($str)
    {
        return empty($str) ? true :false;
    }
    public static function is_Equal($str1,$str2)
    {
        return  $str1==$str2 ? true :false;
    }
    public static function check_len($str,$len)
    {
        return  strlen($str)>= $len ? true :false;
    }
    
}