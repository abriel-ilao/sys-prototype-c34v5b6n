<?php

namespace app\lib\carbon
{

	use Carbon\Carbon;

	class SimpleCarbon
	{

		public static function Create() {
			return new SimpleCarbon;
		}

		private function __construct() {
      require_once 'vendor/autoload.php';
		}

    public function lastLogin($dateTime) {
      //last
      $explodedDateTime = explode('|', $dateTime);

      $month  = $explodedDateTime[0];
      $day    = $explodedDateTime[1];
      $year   = $explodedDateTime[2];
      $hour   = $explodedDateTime[3];
      $minute = $explodedDateTime[4];
      $am_pm  = $explodedDateTime[5];

      $carbonDiff = Carbon::create($year, $month, $day)->diffForHumans();

      if($carbonDiff === '1 second ago') {
        return $hour.':'.$minute.' '.$am_pm;
      } else {
       	return $carbonDiff;
      }
    }
	}
}
