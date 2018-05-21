<?php
namespace app\lib\validation\factory {

	use app\lib\validation\validator\MinStr;

	class Min {
		public static function SetMin($field, $min) {
			return new MinStr($field, $min);
		}
	}
}