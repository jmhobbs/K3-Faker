<?php defined('SYSPATH') or die('No direct script access.');

	class Kohana_Faker_Phone extends Kohana_Faker_Core {
		protected static $PHONE_NUMBER         = null;

		/*!
			Get a phone number.

			\param format You can provide a sprintf compatible format string here if you need specific output.
			\return String - A phone number
		*/
		public function phone_number ($format = null) {
			if( $format == null ) {
				$format = self::data_rand('phone_number');
			}
			return self::numberize($format);
		}

		/*!
			Get a phone number.

			Alias of phone_number()

			\param format You can provide a sprintf compatible format string here if you need specific output.
			\return String - A phone number
		*/
		public function number ($format = null) {
			return $this->phone_number( $format );
		}

	}
