<?php defined('SYSPATH') or die('No direct script access.');

	/*!
		Base class for fake data modules.
	*/
	class Kohana_Faker_Module {
		const DEFAULT_LOCALE = 'en';

		/*!
			Load fake information through Kohana::config, with locale, and only if needed.

			\param name The name of the data to load.
			\param locale The locale to load. Defaults to current LC_ALL locale.
		*/
		protected function load_data ($name, $locale = null) {
			$var_name = strtoupper($name);
			if( null == $this::$$var_name ) {

				if( $locale == null ) {
					$locale = setlocale(LC_ALL, NULL);
				}

				try {
					$cfg = Kohana::config( 'faker/' . $locale . '/' . $name );
					if( is_null( $cfg ) ) { throw new Kohana_Exception( "Pop Goes Default Locale" ); }
					$this::$$var_name = $cfg->as_array();
					if( 0 == count( $this::$$var_name ) ) { throw new Kohana_Exception( "Empty locale data file." ); }
				}
				catch(Kohana_Exception $e ) {
					if( $locale == self::DEFAULT_LOCALE ) {
						throw new Exception("Could not find locale data file.");
					}
					else {
						$this::load_data($name, self::DEFAULT_LOCALE);
					}
				}

			}
		}

		/*!
			Generic random data fetcher.

			\param name The name of the data set.

			\returns A random element of that data set.
		*/
		protected function data_rand ( $name ) {
			$var_name = strtoupper($name);
			$this::load_data($name);
			// Variable variables require some reference juggling.
			$block =& $this::$$var_name;
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
			Allows property-like access to methods.

			This overload allows you to call things like this:

			\code
Faker::Name()->first
			\endcode

			Instead of this:

			\code
Faker::Name()->first()
			\endcode
		*/
		public function __get ( $name ) {
			if( method_exists( $this, $name ) ) {
				return $this->$name();
			}
			else {
				throw new Kohana_Exception( "Undefined Property: $name" );
			}
		}

	}
