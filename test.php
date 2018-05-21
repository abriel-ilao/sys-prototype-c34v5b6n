<?php

namespace app\
{
    Class getUserIP {

        private $_client,
                $_forward,
                $_remote;

        public static function Create() : getUserIP {
            return new getUserIP();
        }

        private function __construct() {}
        private function __clone() {}

        public function getUserIP() {

            $this->_client  = $_SERVER['HTTP_CLIENT_IP'];
            $this->_forward = $_SERVER['HTTP_X_FORWARDED_FOR'];
            $this->_remote  = $_SERVER['REMOTE_ADDR'];

            if(filter_var($this->_client, FILTER_VALIDATE_IP))
            {
                $ip = $this->_client;
            }
            elseif(filter_var($this->_forward, FILTER_VALIDATE_IP))
            {
                $ip = $this->_forward;
            }
            else
            {
                $ip = $this->_remote;
            }

            return $ip;
        }
    }
}


$user_ip = getUserIP::Create();
$ip = $user_ip->getUserIP();

echo $ip; // Output IP address [Ex: 127.82.193.143]
