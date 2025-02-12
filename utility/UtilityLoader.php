<?php
namespace Utility;
use Exception;
require_once "Mysql.php";
class Utility {
    use Mysql;
    public static function env(){
        if (!file_exists(".env")) {
            throw new Exception("File .env tidak ditemukan");
        }
        $lines = file(".env", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);
            if (!array_key_exists($name, $_ENV)) {
                $_ENV[$name] = $value;
                putenv("$name=$value");
            }
        }
    }
}