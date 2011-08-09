<?php defined('SYSPATH') or die('No direct script access.');

	/*!
		This class does the actual work of connecting modules.
	*/
	class Kohana_Faker {

		//! K3-Faker Version Number
		const VERSION = '0.3.1';

		protected static $instances = array();

		public static function __callStatic ( $name, $arguments ) {

			if( ! isset( self::$instances[$name] ) ){
				$full_class_name = "Faker_$name";
				if( ! class_exists( $full_class_name ) ) {
					$full_class_name = "Kohana_Faker_$name";
					if( ! class_exists( $full_class_name ) ) {
						throw new Kohana_Exception( "No such Faker data class, $name" );
					}
				}
				self::$instances[$name] = new $full_class_name();
			}

			return self::$instances[$name];
		}

		public static factory( $name ) {
			return __callStatic( $name, null );
		}

	}

