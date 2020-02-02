<?php
    class db{
        //This class allow us to create an object that contains the functions
        //to a mysql server

        //This is the db data required to the mysql server
        //Note this is not ideal because this configuration should be
        //in a configuration file
        private $dbhost = 'localhost';
        private $dbuser = 'read_user';
        private $dbpass = 'P2UDFJWmI4VbjnOB';
        private $dbname = 'test';


        public function connect(){
            //This function connect to database using private varaible for configuration
            $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname;";
            $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnection;
        }
    }
