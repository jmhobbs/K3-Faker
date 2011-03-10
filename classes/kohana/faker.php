<?php defined('SYSPATH') or die('No direct script access.');

	/*!
		@mainpage K3-Faker

		@section section_what_is_k3_faker What is K3-Faker?

		It is a lazy-loading, locale aware Fake data module for Kohana 3.1.x.

		It is inspired by (and borrows data from) Ruby's Faker gem, http://faker.rubyforge.org/,
		and Perl's Data::Faker, http://search.cpan.org/~jasonk/Data-Faker-0.07/lib/Data/Faker.pm

		@section section_installing Installing K3-Faker

		@li Drop the source in your <tt>MODPATH</tt> folder.
		@li Add the module to <tt>Kohana::modules</tt> in your <tt>bootstrap.php</tt>

		@section section_usage Using K3-Faker

		Use the static methods in Faker:
		\code
echo 'Name: ' . Faker::name();
		\endcode

		Output:
		\code
Name: Abbigail Vandervort
		\endcode
	*/

	/*!
		This class lets you get fake information that looks real.

		Example:
		\code
echo 'Name: ' . Faker::name() . "\n";
echo 'Phone: ' . Faker::phone_number() . "\n";
		\endcode

		Output:
		\code
Name: Abbigail Vandervort
Phone: 1-202-479-9161
		\endcode
	*/
	class Kohana_Faker {

		const VERSION = '0.3.0';

		protected static $instances = array();

		public static function __callStatic ( $name, $arguments ) {

			if( ! isset( self::$instances[$name] ) ){
				$full_class_name = "Kohana_Faker_$name";
				if( ! class_exists( $full_class_name ) ) {
					throw new Kohana_Exception( "No such Faker data class, $name" );
				}
				self::$instances[$name] = new $full_class_name();
			}

			return self::$instances[$name];
		}

	}

