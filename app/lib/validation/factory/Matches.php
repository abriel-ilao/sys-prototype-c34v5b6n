<?php
namespace app\lib\validation\factory {

	use app\lib\validation\validator\MatchesStr;

	class Matches {
		public static function SetMatches($field, $matches) {
			return new MatchesStr($field, $matches);
		}
	}
}