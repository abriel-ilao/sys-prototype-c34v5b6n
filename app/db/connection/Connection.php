<?php 
/**
* Create a new database connection instance
*/
namespace app\db\connection {

    use \PDO;

    class Connection {

        /*define ( 'DB_HOST', 'localhost' );
        define ( 'DB_USER', 'root' );
        define ( 'DB_PASSWORD', '' );
        define ( 'DB_NAME', 'db_sys_hardware' );*/

        /* 
        ******************* MySQL Settings Configuration *******************
        **** @$_IP - MySQL database hostname 
        **** @$_ROOT - MySQL database username
        **** @$_PASSWORD - MySQL database password
        **** @$_DB - Mysql database name
        ********************************************************************
        */
        private static $_IP = 'localhost',
                       $_ROOT = 'root',
                       $_PASSWORD = '',
                       $_DB = 'db_sys_hardware';  
                       
        /*******************************************************************/
                       
        /**
        * Establish a database connection.
        * @static
        * @return PDO Connection
        */              
        private static function createConnection() {
            try {
                return new PDO(self::getConnectionString(), self::getUser(), self::getPassword());
            } catch(PDOException $exception) {
                die ("Connection error: " . $exception->getMessage());
            }
        }

        /**
        * Connect
        * @static 
        * @return Database connection
        */
        public static function Connect() {
            return self::createConnection();
        }    

        /** 
        * Connection string concatenation
        * @static
        * @return string IP and DB
        */
        private static function getConnectionString() { 
            return 'mysql:host='.self::getIP().'; dbname='.self::getDB(); 
        }

        /**
        * IP 
        * @static
        * @return string
        */
        private static function getIP() { 
            return self::$_IP; 
        }

        /**
        * DB
        * @static
        * @return string
        */
        private static function getDB() { 
            return self::$_DB; 
        }

        /**
        * ROOT
        * @static
        * @return string
        */
        private static function getUser() { 
            return self::$_ROOT;
        }

        /**
        * PASSWORD
        * @static
        * @return string
        */
        private static function getPassword() { 
            return self::$_PASSWORD; 
        }

        /**
        * Prevent calling a constructor method
        */
        private function __construct() {}
    }
}


