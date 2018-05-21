<?php
namespace app\lib\validation\validator {
	class UniqueStr {

		/*
		* UniqueStr Properties
		* @$_required String
		* @$_passed bool
		*/
		private $_unique,
				$_passed = false;

		/**
		* UniqueStr Constructor
		* @param string
		* @param bool
		*/			
		public function __construct($field, $unique) {
			$this->set($field, $unique);
		}
		
		/**
		* UniqueStr Setter
		* @param string $field
		* @param bool $unique set to ''(empty) field.
		*/
		private function set($field, $unique) {
			if($field == $unique) {
				$this->_unique = $field.' is already exist.';
			}
		}

		/**
		* UniqueStr Getter
		* @return string
		*/
		public function getUnique() {
			return $this->_unique;
		}

		/**
		* UniqueStr isPassed
		* @return bool
		*/
		public function isPassed() {
			if(!$this->_unique) {
				return $this->_passed = true;
			}
		}
	}
}