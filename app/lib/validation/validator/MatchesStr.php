<?php
namespace app\lib\validation\validator {
	class MatchesStr {

		/*
		* MatchesStr Properties
		* @$_matches String
		* @$_passed bool
		*/
		private $_matches,
				$_passed = false;

		/**
		* MatchesStr Constructor
		* @param string
		* @param bool
		*/			
		public function __construct($field, $matches) {
			$this->set($field, $matches);
		}

		/**
		* MatchesStr Setter
		* @param string $field
		* @param bool $matches set to ''(empty) field.
		*/
		private function set($field, $matches) {
			if($field != $matches) {
				$this->_matches = 'Did not match.<br>';
			}
		}

		/**
		* MatchesStr Getter
		* @return string
		*/
		public function getMatches() {
			return $this->_matches;
		}

		/**
		* MatchesStr isPassed
		* @return bool
		*/
		public function isPassed() {
			if(!$this->_matches) {
				return $this->_passed = true;
			}
		}
	}
}