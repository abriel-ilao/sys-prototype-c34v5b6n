<?php 

namespace app\lib\session 
{
	class Session 
	{
		/**
		* @static
		* @return bool
		*/
		public static function ObStart() {
			ob_start();
		}

		/**
		* Creates a session.
		* @static
		* @return bool
		*/
		public static function SessionStart() {
			session_start();
		}

		/**
		* Create session storage and session value.
		* @static
		* @param string $session session storage.
		* @param string $session_value session value.
		* @return bool
		* This does not work without using session_start(), you must call @see sessionStart().
		*/
		public static function CreateSession($session, $session_value) {
			return $_SESSION[$session] = $session_value;
		}

		/**
		* Check if the current session has a value.
		* @static
		* @param string $session session storage.
		* @return bool
		* This does not work without using session_start(), you must call @see sessionStart().
		*/
		public static function IsSetSession($session) {
			return isset($_SESSION[$session]);
		}

		/**
		* Check if the current session is empty.
		* @static
		* @param string $session session storage.
		* @return bool
		* This does not work without using session_start(), you must call @see sessionStart().
		*/
		public static function IsEmptySession($session) {
			return empty($_SESSION[$session]);
		}

		/**
		* Remove the current session value.
		* @static
		* @param string $session session storage.
		* This does not work without using session_start(), you must call @see sessionStart().
		*/
		public static function UnsetSession($session) {
			unset($_SESSION[$session]);
		}

		/**
		* Get the current session value.
		* @static
		* @param string $session session storage.
		* This does not work without using session_start(), you must call @see sessionStart().
		*/
		public static function GetSession($session) {
			return $_SESSION[$session];
		}
	}
}
