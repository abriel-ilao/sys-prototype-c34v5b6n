<?php
namespace app\lib\validation\factory {

	use app\lib\validation\validator\RequiredStr;

	class Required {
		public static function SetRequired($field, $required) {
			return new RequiredStr($field, $required);
		}
	}
}