<?php defined('SYSPATH') or die('No direct script access.');

	/*!
		Fake Address data.

		Don't access directly, instead use the Faker class.

		\code
Faker::Address()->city
		\endcode
	*/
	class Kohana_Faker_Address extends Kohana_Faker_Module {

		protected static $CITY_PREFIX        = null;
		protected static $CITY_SUFFIX        = null;
		protected static $STREET_SUFFIX      = null;
		protected static $STREET_NUMBER      = null;
		protected static $SECONDARY_ADDRESS  = null;
		protected static $POSTAL_CODE        = null;

		protected static $STATE_NAME         = null;
		protected static $STATE_ABBREVIATION = null;

		protected static $COUNTRY_NAME       = null;

		/*!
			Get a city name.

			\return String - A city name
		*/
		public function city () {
			switch( mt_rand(0,4) ) {
				default:
				case 0:
					return sprintf(
						'%s %s%s',
						self::data_rand('city_prefix'),
						Faker::Name()->first(),
						self::data_rand('city_suffix')
					);
				case 1:
					return sprintf(
						'%s %s',
						self::data_rand('city_prefix'),
						Faker::Name()->first()
					);
				case 2:
					return sprintf(
						'%s%s',
						Faker::Name()->first(),
						self::data_rand('city_suffix')
					);
				case 3:
					return sprintf(
						'%s%s',
						Faker::Name()->last(),
						self::data_rand('city_suffix')
					);
			}
		}

		/*!
			Get a full street address.

			\param include_secondary Append the secondary address to the address. From Faker::secondary_address()

			\return String - A street address
		*/
		public function street_address ( $include_secondary = false ) {
			$address = self::numberize( self::data_rand( 'street_number' ) ) . ' ' . self::street_name();
			if( $include_secondary ) { $address .= ' ' . self::secondary_address(); }
			return $address;
		}

		/*!
			Get a street name.

			\return String - A street name
		*/
		public function street_name () {
			switch( mt_rand( 0, 1 ) ) {
				default:
				case 0:
					return sprintf(
						'%s %s',
						Faker::Name()->last(),
						self::data_rand( 'street_suffix' )
					);
				case 1:
					return sprintf(
						'%s %s',
						Faker::Name()->first(),
						self::data_rand( 'street_suffix' )
					);
			}
		}

		/*!
			Get a secondary address (Suite, Apartment)

			\return String - A secondary address
		*/
		public function secondary_address () {
			return self::numberize( self::data_rand( 'secondary_address' ) );
		}

		/*!
			Get a postal code.

			\return String - A postal code
		*/
		public function postal_code () {
			return self::numberize( self::data_rand( 'postal_code' ) );
		}

		/*!
			Get a zip code.

			Convenience method, alias of Faker::postal_code()

			\return String - A zip code
		*/
		public function zip_code () {
			return self::postal_code();
		}

		/*!
			Get a zip code.

			Convenience method, alias of Faker::postal_code()

			\return String - A zip code
		*/
		public function zip () {
			return self::postal_code();
		}

		/*!
			Get a state name.

			\return String - A state name
		*/
		public function state () {
			return self::data_rand('state_name');
		}

		/*!
			Get a two letter state abbreviation.

			\return String - A state abbreviation
		*/
		public function state_abbreviation () {
			return self::data_rand('state_abbreviation');
		}

		/*!
			Get a country name.

			\return String - A country name
		*/
		public function country () {
			return self::data_rand('country_name');
		}

	}
