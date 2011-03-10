<?php defined('SYSPATH') or die('No direct script access.');

	/*!
		Lorem Ipsum, Dolor Sit Amet.

		Don't access directly, instead use the Faker class.

		\code
Faker::Lipsum()->p
		\endcode
	*/
	class Kohana_Faker_Lipsum extends Kohana_Faker_Module {
		protected static $LIPSUM         = null;

		/*!
			Get a single paragraph of Lorem Ipsum.

			\return String - A paragraph of Lorem Ipsum
		*/
		public function paragraph () {
			$sentences = mt_rand( 4, 10 );
			$output = array();
			for( $i = 0; $i < $sentences; ++$i ) {
				$output[] = $this->sentence();
			}
			return implode( ' ', $output );
		}

		/*!
			Alias of paragraph()

			\return String - A paragraph of Lorem Ipsum
		*/
		public function p () {
			return $this->paragraph();
		}

		/*!
			Get a single sentence of Lorem Ipsum.

			\return String - A sentence of Lorem Ipsum
		*/
		public function sentence () {
			$words = mt_rand( 5, 15 );
			$commad = false;
			$output = array();

			for( $i = 0; $i < $words; ++$i ) {
				$word = $this->word();
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
		public function word () {
			return self::data_rand('lipsum');
		}


	}
