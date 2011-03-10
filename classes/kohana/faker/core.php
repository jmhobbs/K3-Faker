<?php defined('SYSPATH') or die('No direct script access.');

	class Kohana_Faker_Core {
		const DEFAULT_LOCALE = 'en';

		/*!
			Load faker information with locale, if needed.

			\param name The name of the data to load.
			\param locale The locale to load. Defaults to current LC_ALL locale.
		*/
		protected function loadData ($name, $locale = null) {
			$var_name = strtoupper($name);
			if( null == $this::$$var_name ) {

				if( $locale == null ) {
					$locale = setlocale(LC_ALL, NULL);
				}

				try {
					$this::$$var_name = Kohana::config('faker/' . $locale . '/' . $name )->as_array();
					if( 0 == count( $this::$$var_name ) ) { throw new Kohana_Exception( "Empty locale data file." ); }
				}
				catch(Kohana_Exception $e ) {
					if( $locale == self::DEFAULT_LOCALE ) {
						throw new Exception("Could not find locale data file.");
					}
					else {
						$this::loadData($name, self::DEFAULT_LOCALE);
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
			$this::loadData($name);
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

	}
