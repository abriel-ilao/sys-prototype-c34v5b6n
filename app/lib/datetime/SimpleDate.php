<?php 

namespace app\lib\datetime 
{

	use \DateTime;

	class SimpleDate 
	{

		private $_timezone = 'Asia/Manila';
		private $_dateDefaultTimezone;

		public static function Create() {
			return new SimpleDate;
		}

		private function __construct() {
			return $this->setDateDefaultTimezone(date_default_timezone_set($this->_timezone))->getDateDefaultTimezone();
		}

		public function getFormat($format) {
			$date = new DateTime;
			return $date->format($format);
		}

		private function getDateDefaultTimezone() { return $this->_dateDefaultTimezone; }
		private function setDateDefaultTimezone($default) { $this->_dateDefaultTimezone = $default; return $this; }
	}
}
//echo SimpleDate::Create()->getFormat('M d D Y - h : i : s');
