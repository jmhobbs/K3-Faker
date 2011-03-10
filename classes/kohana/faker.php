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

		const DEFAULT_LOCALE = 'en';
		const VERSION = '0.3.0';

		protected static $LIPSUM               = null;
		protected static $FIRST_NAME           = null;
		protected static $LAST_NAME            = null;
		protected static $PHONE_NUMBER         = null;

		protected static $CITY_PREFIX          = null;
		protected static $CITY_SUFFIX          = null;
		protected static $STREET_SUFFIX        = null;
		protected static $STREET_NUMBER        = null;
		protected static $SECONDARY_ADDRESS    = null;
		protected static $POSTAL_CODE          = null;

		protected static $STATE_NAME           = null;
		protected static $STATE_ABBREVIATION   = null;

		protected static $COUNTRY_NAME         = null;

		/*!
			Load faker information with locale, if needed.

			\param name The name of the data to load.
			\param locale The locale to load. Defaults to current LC_ALL locale.
		*/
		protected static function loadData ($name, $locale = null) {
			$var_name = strtoupper($name);
			if( null == self::$$var_name ) {

				if( $locale == null ) {
					$locale = setlocale(LC_ALL, NULL);
				}

				try {
					self::$$var_name = Kohana::config('faker/' . $locale . '/' . $name )->as_array();
					if( 0 == count( self::$$var_name ) ) { throw new Kohana_Exception( "Empty locale data file." ); }
				}
				catch(Kohana_Exception $e ) {
					if( $locale == self::DEFAULT_LOCALE ) {
						throw new Exception("Could not find locale data file.");
					}
					else {
						self::loadData($name, self::DEFAULT_LOCALE);
					}
				}

			}
		}

		/*!
			Generic random data fetcher.

			\param name The name of the data set.

			\returns A random element of that data set.
		*/
		protected static function data_rand ( $name ) {
			$var_name = strtoupper($name);
			self::loadData($name);
			// Variable variables require some reference juggling.
			$block =& self::$$var_name;
			return $block[array_rand($block)];
		}

		/*!
			Replace all occurrences of %d in a format string with a number.

			\param format The format string
			\param min The lowest digit to allow. Default 0.
			\param max The highest digit to allow. Default 9.
		*/
		protected static function numberize ( $format, $min = 0, $max = 9 ) {
			$format_arguments = array();
			for( $i = substr_count($format, "%d"); $i > 0; --$i ) {
				$format_arguments[] = mt_rand($min,$max);
			}
			return vsprintf($format, $format_arguments);
		}

		/*!
			Get a single paragraph of Lorem Ipsum.

			\return String - A paragraph of Lorem Ipsum
		*/
		public static function lipsum_p () {
			$sentences = mt_rand( 4, 10 );
			$output = array();
			for( $i = 0; $i < $sentences; ++$i ) {
				$output[] = self::lipsum_s();
			}
			return implode( ' ', $output );
		}

		/*!
			Get a single sentence of Lorem Ipsum.

			\return String - A sentence of Lorem Ipsum
		*/
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

		/*!
			Get a single word of Lorem Ipsum.

			\return String - A word of Lorem Ipsum, lower case.
		*/
		public static function lipsum_w () {
			return self::data_rand('lipsum');
		}

		/*!
			Get a persons full name.

			\return String - A name
		*/
		public static function name () {
			return self::first_name() . ' ' . self::last_name();
		}

		/*!
			Get a persons first name.

			\return String - A first name.
		*/
		public static function first_name () {
			return self::data_rand('first_name');
		}


		/*!
			Get a persons last name.

			\return String - A last name
		*/
		public static function last_name () {
			return self::data_rand('last_name');
		}

		/*!
			Get a phone number.

			\param format You can provide a sprintf compatible format string here if you need specific output.
			\return String - A phone number
		*/
		public static function phone_number ($format = null) {
			if( $format == null ) {
				$format = self::data_rand('phone_number');
			}
			return self::numberize($format);
		}

		/*!
			Get a city name.

			\return String - A city name
		*/
		public static function city () {
			switch( mt_rand(0,4) ) {
				default:
				case 0:
					return sprintf(
						'%s %s%s',
						self::data_rand('city_prefix'),
						self::first_name(),
						self::data_rand('city_suffix')
					);
				case 1:
					return sprintf(
						'%s %s',
						self::data_rand('city_prefix'),
						self::first_name()
					);
				case 2:
					return sprintf(
						'%s%s',
						self::first_name(),
						self::data_rand('city_suffix')
					);
				case 3:
					return sprintf(
						'%s%s',
						self::last_name(),
						self::data_rand('city_suffix')
					);
			}
		}

		/*!
			Get a full street address.

			\param include_secondary Append the secondary address to the address. From Faker::secondary_address()

			\return String - A street address
		*/
		public static function street_address ( $include_secondary = false ) {
			$address = self::numberize( self::data_rand( 'street_number' ) ) . ' ' . self::street_name();
			if( $include_secondary ) { $address .= ' ' . self::secondary_address(); }
			return $address;
		}

		/*!
			Get a street name.

			\return String - A street name
		*/
		public static function street_name () {
			switch( mt_rand( 0, 1 ) ) {
				default:
				case 0:
					return sprintf(
						'%s %s',
						self::last_name(),
						self::data_rand( 'street_suffix' )
					);
				case 1:
					return sprintf(
						'%s %s',
						self::first_name(),
						self::data_rand( 'street_suffix' )
					);
			}
		}

		/*!
			Get a secondary address (Suite, Apartment)

			\return String - A secondary address
		*/
		public static function secondary_address () {
			return self::numberize( self::data_rand( 'secondary_address' ) );
		}

		/*!
			Get a postal code.

			\return String - A postal code
		*/
		public static function postal_code () {
			return self::numberize( self::data_rand( 'postal_code' ) );
		}

		/*!
			Get a zip code.

			Convenience method, alias of Faker::postal_code()

			\return String - A zip code
		*/
		public static function zip_code () {
			return self::postal_code();
		}

		/*!
			Get a zip code.

			Convenience method, alias of Faker::postal_code()

			\return String - A zip code
		*/
		public static function zip () {
			return self::postal_code();
		}

		/*!
			Get a state name.

			\return String - A state name
		*/
		public static function state () {
			return self::data_rand('state_name');
		}

		/*!
			Get a two letter state abbreviation.

			\return String - A state abbreviation
		*/
		public static function state_abbreviation () {
			return self::data_rand('state_abbreviation');
		}

		/*!
			Get a country name.

			\return String - A country name
		*/
		public static function country () {
			return self::data_rand('country_name');
		}

	}
