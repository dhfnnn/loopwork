<?php
namespace Utility;

trait Mysql
{   
    public static function con()
    { 
        self::env();
        return mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
    }
    
    public static function mqr($query)
    {
        return self::con()->query($query);
    }

    public static function mres($string)
    {
        return mysqli_real_escape_string(self::con(), $string);
    }

    public static function mfo($query)
    {
        return self::mqr($query)->fetch_object();
    }

    public static function mfa($query)
    {
        return self::mqr($query)->fetch_array();
    }

    public static function mfoc($query)
    {
        return self::mqr($query)->fetch_assoc();
    }

    public static function mnr($query)
    {   
        return self::mqr($query)->num_rows;
    }

    public static function mds($query, $num = 0)
    {
        return mysqli_data_seek(self::mqr($query), $num);
    }

    public static function mkdb($name)
    {
        return self::con()->query("CREATE DATABASE $name");
    }

    public static function merr()
    {
        return mysqli_error(self::con());
    }

    public static function mern()
    {
        return mysqli_errno(self::con());
    }
}