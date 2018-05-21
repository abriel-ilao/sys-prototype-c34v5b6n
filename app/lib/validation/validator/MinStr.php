<?php
namespace app\lib\validation\validator {
	class MinStr {
	    
	    /*
		* MinStr Properties
		* @$_required String
		* @$_passed bool
		*/
		private $_min,
				$_passed = false;
	    
	    /**
		* MinStr Constructor
		* @param string
		* @param bool
		*/
		public function __construct($field, $min) {
			$this->set($field, $min);
		}
	    
	    /**
		* MinStr Setter
		* @param string $field
		* @param bool $min set to ''(empty) field.
		*/
		private function set($field, $min) {
			if(strlen($field) < $min) {
				$this->_min = 'Field minimum at least '.$min.' characters.<br>';
			}
		}

		/**
		* MinStr Getter
		* @return string
		*/
		public function getMin() {
			return $this->_min;
		}
	 	
	 	/**
		* MinStr isPassed
		* @return bool
		*/   
		public function isPassed() {
			if(!$this->_min) {
				return $this->_passed = true;
			}
		}
	}
}