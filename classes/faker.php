<?php defined('SYSPATH') or die('No direct script access.');

	class Faker {

		protected static $LIPSUM = null;
		protected static $FIRST_NAME = null;
		protected static $LAST_NAME = null;

		public static function lipsum_p () {
			$sentences = mt_rand( 4, 10 );
			$output = array();
			for( $i = 0; $i < $sentences; ++$i ) {
				$output[] = self::lipsum_s();
			}
			return implode( ' ', $output );
		}

		public static function lipsum_s () {
			$words = mt_rand( 5, 15 );
			$commad = false;
			$output = array();

			for( $i = 0; $i < $words; ++$i ) {
				$word = self::lipsum_w();
				if( $i == 0 ) { $word = ucwords( $word ); }

				$output[] = $word;

				if( ! $commad and ( $i + 1 ) != $words and 1 == mt_rand( 1, 5 ) ) {
					$output[] = ',';
					$commad = true;
				}
			}
			return implode( ' ', $output ) . '.';
		}

		public static function lipsum_w () {
			if( null == self::$LIPSUM ) {
				self::$LIPSUM = require_once( dirname( __FILE__ ) . '/faker_data/lipsum.php' );
			}
			return self::$LIPSUM[array_rand( self::$LIPSUM )];
		}

		public static function name () {
			return self::first_name() . ' ' . self::last_name();
		}

		public static function first_name () {
			if( null == self::$FIRST_NAME ) {
				self::$FIRST_NAME = require_once( dirname( __FILE__ ) . '/faker_data/first_name.php' );
			}
			return self::$FIRST_NAME[array_rand( self::$FIRST_NAME )];
		}

		public static function last_name () {
			if( null == self::$LAST_NAME ) {
				self::$LAST_NAME = require_once( dirname( __FILE__ ) . '/faker_data/last_name.php' );
			}
			return self::$LAST_NAME[array_rand( self::$LAST_NAME )];
		}

	}
