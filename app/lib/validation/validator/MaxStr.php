<?php
namespace app\lib\validation\validator {
	class MaxStr {

		/*
		* MaxStr Properties
		* @$_max String
		* @$_passed bool
		*/
		private $_max,
				$_passed = false;

		/**
		* MaxStr Constructor
		* @param string
		* @param bool
		*/			
		public function __construct($field, $max) {
			$this->set($field, $max);
		}
	    
	    /**
		* MaxStr Setter
		* @param string $field
		* @param bool $max set to ''(empty) field.
		*/
		private function set($field, $max) {
			if(strlen($field) > $max) {
				$this->_max = 'Field maximum at least '.$max.' characters.<br>';
			}
		}
	 
	    /**
		* MaxStr Getter
		* @return string
		*/
		public function getMax() {
			return $this->_max;
		}
	    
	    /**
		* MaxStr isPassed
		* @return bool
		*/
		public function isPassed() {
			if(!$this->_max) {
				return $this->_passed = true;
			}
		}
	}
}