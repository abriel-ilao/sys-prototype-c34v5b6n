<?php 
namespace app\lib\validation\factory {
	
	class Input {

		/**
		* Check if the field has a value - POST
		* @static 
		* @param string $field default value is false
		* @return bool
		*/
		public static function IsIssetPost($field) {
			return isset($_POST[$field]);
		}

		/**
		* Check if the field has a value - GET
		* @static 
		* @param string $field default value is false
		* @return bool
		*/
		public static function IsIssetGet($field) {
			return isset($_GET[$field]);
		}

		/**
		* Create POST field value.
		* @static 
		* @param string $field
		* @return string
		*/
		public static function Post($field) {
			return $_POST[$field];
		}

		/**
		* Create GET field value.
		* @static 
		* @param string $field
		* @return string
		*/
		public static function Get($field) {
			return $_GET[$field];
		}

		/**
		* Check if the input has a value.
		* @static 
		* @param string $field
		* @return string
		*/
		public static function IsEmpty($field) {
			return empty($field);
		}
	}
}
