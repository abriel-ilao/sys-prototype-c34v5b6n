<?php
namespace app\lib\validation\factory {

	use app\lib\validation\validator\MaxStr;

	class Max {
		public static function SetMax($field, $max) {
			return new MaxStr($field, $max);
		}
	}
}