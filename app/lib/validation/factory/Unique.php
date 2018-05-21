<?php
namespace app\lib\validation\factory {	

	use app\lib\validation\validator\UniqueStr;

	class Unique {
		public static function SetUnique($field, $unique) {
			return new UniqueStr($field, $unique);
		}
	}
}
