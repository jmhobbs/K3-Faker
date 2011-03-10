<?php defined('SYSPATH') or die('No direct script access.');

	/*!
		Fake Company data.

		Don't access directly, instead use the Faker class.

		\code
Faker::Company()->name
		\endcode
	*/
	class Kohana_Faker_Company extends Kohana_Faker_Module {

		protected static $COMPANY_SUFFIX = null;
		protected static $CATCH_PHRASE   = null;

		/*!
			Get a company name.

			\returns String - A company name.
		*/
		public function name () {
			switch( mt_rand( 0, 2 ) ) {
				default:
				case 0:
					return sprintf(
						'%s %s',
						Faker::Name()->last(),
						self::data_rand('company_suffix')
					);
				case 1:
					return sprintf(
						'%s %s',
						Faker::Name()->last(),
						Faker::Name()->last()
					);
				case 2:
					return sprintf(
						'%s, %s and %s',
						Faker::Name()->last(),
						Faker::Name()->last(),
						Faker::Name()->last()
					);
			}
		}

		/*!
			Get a buzzword filled company catch phrase.

			\returns String - Your new company motivation
		*/
		public function catch_phrase () {
			self::load_data('catch_phrase');

			return implode(
				' ',
				array(
					self::$CATCH_PHRASE[0][array_rand( self::$CATCH_PHRASE[0] )],
					self::$CATCH_PHRASE[1][array_rand( self::$CATCH_PHRASE[1] )],
					self::$CATCH_PHRASE[2][array_rand( self::$CATCH_PHRASE[2] )]
				)
			);
		}

	}