<?php defined('SYSPATH') or die('No direct script access.');

	class Kohana_Faker_Name extends Kohana_Faker_Core {
		protected static $FIRST_NAME           = null;
		protected static $LAST_NAME            = null;

		/*!
			Get a persons full name.

			\return String - A name
		*/
		public function name () {
			return self::first_name() . ' ' . self::last_name();
		}

		/*!
			Get a persons first name.

			\return String - A first name.
		*/
		public function first_name () {
			return self::data_rand('first_name');
		}

		/*!
			Get a persons first name.

			Alias of first_name()

			\return String - A first name.
		*/
		public function first () {
			return $this->first_name();
		}


		/*!
			Get a persons last name.

			\return String - A last name
		*/
		public function last_name () {
			return self::data_rand('last_name');
		}

		/*!
			Get a persons last name.

			Alias of last_name()

			\return String - A last name.
		*/
		public function last () {
			return $this->last_name();
		}

	}
