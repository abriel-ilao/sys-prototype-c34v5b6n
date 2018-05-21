<?php
namespace app\lib\validation\validator {
	class RequiredStr {

		/*
		* RequiredStr Properties
		* @$_required String
		* @$_passed bool
		*/
		private $_required,
				$_passed = false;

		/**
		* RequiredStr Constructor
		* @param string
		* @param bool
		*/		
		public function __construct($field, $required) {
			$this->set($field, $required);
		}

		/**
		* RequiredStr Setter
		* @param string $field
		* @param bool $required set to ''(empty) field.
		*/
		private function set($field, $required) {
			if(trim($field) === '' && $required == true) {
				$this->_required = 'Required Field.';
			}
		}

		/**
		* RequiredStr Getter
		* @return string
		*/
		public function getRequired() {
			return $this->_required;
		}

		/**
		* RequiredStr isPassed
		* @return bool
		*/
		public function isPassed() {
			if(!$this->_required) {
				return $this->_passed = true;
			}
		}
	}
}