<?php
class Database{
private static $servername="localhost";
private static $username="root";
private static $password="";
private static $dbname="burger_code";
private static $connection=null;
public static function connect()
{
    if(self::$connection==null)

{
try
{
self::$connection=new PDO("mysql:host=".self::$servername.";dbname=".self::$dbname,self::$username,self::$password);


}
catch(PDOExepction $e)
{
die($e->getMessage());
}}
return self::$connection;
}
public static function disconnect()
{
    self::$connection==null;

}
}
?>