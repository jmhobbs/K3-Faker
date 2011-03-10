<?php defined('SYSPATH') or die('No direct script access.');

	/*!
		Fake Internet data.

		Don't access directly, instead use the Faker class.

		\code
Faker::Internet()->email
		\endcode
	*/
	class Kohana_Faker_Internet extends Kohana_Faker_Module {

		protected static $FREE_EMAIL_DOMAIN = null;
		protected static $DOMAIN_SUFFIX     = null;

		/*!
			Get an email address.

			\param name A persons name, if you want it based on that.

			\return String - An email address
		*/
		public function email ( $name = null ) {
			return sprintf(
				'%s@%s',
				$this->user_name( $name ),
				$this->domain_name()
			);
		}

		/*!
			Get an email address at a free vendor.

			\param name A persons name, if you want it based on that.

			\return String - An email address, from a free vendor
		*/
		public function free_email ( $name = null ) {
			return sprintf(
				'%s@%s',
				$this->user_name( $name ),
				self::data_rand( 'free_email_domain' )
			);
		}

		/*!
			Get a user name.

			\param name A persons name, if you want it based on that.

			\return String - A user name
		*/
		public function user_name ( $name = null ) {

			if( $name == null ) {
				if( 0 == mt_rand( 0, 1 ) ) {
					$name = Faker::Name()->first();
				}
				else {
					$name = sprintf(
						'%s_%s',
						Faker::Name()->first(),
						Faker::Name()->last()
					);
				}
			}

			return preg_replace( '/\W/', '', str_replace( ' ', '.', strtolower( $name ) ) );
		}

		/*!
			Alias of user_name()

			\param name A persons name, if you want it based on that.

			\return String - A user name
		*/
		public function username ( $name = null ) {
			return $this->user_name( $name );
		}

		/*!
			Get a domain name.

			\return String - A domain name
		*/
		public function domain_name () {
			return sprintf(
				'%s.%s',
				$this->domain_word(),
				self::data_rand( 'domain_suffix' )
			);
		}

		/*!
			Get a valid word for in a domain name.

			\return String - A word, valid for use in a domain
		*/
		public function domain_word () {
			$company_name = explode( ' ', Faker::Company()->name() );
			return strtolower(
				preg_replace(
					'/\W/',
					'',
					$company_name[0]
				)
			);
		}

		/*!
			Get an IPv4 address.

			\return String - An IPv4 address in dotted notation
		*/
		public function ip_v4_address () {
			return sprintf(
				'%d.%d.%d.%d',
				mt_rand(2,255),
				mt_rand(2,255),
				mt_rand(2,255),
				mt_rand(2,255)
			);
		}

		/*!
			Alias of ip_v4_address

			\return String - An IPv4 address in dotted notation
		*/
		public function ip_v4 () {
			return $this->ip_v4_address();
		}

		/*!
			Get an IPv6 address.

			\return String - An IPv6 address in hex-colon notation
		*/
		public function ip_v6_address () {
			return sprintf(
				'%x:%x:%x:%x:%x:%x:%x:%x',
				mt_rand(0,65535),
				mt_rand(0,65535),
				mt_rand(0,65535),
				mt_rand(0,65535),
				mt_rand(0,65535),
				mt_rand(0,65535),
				mt_rand(0,65535),
				mt_rand(0,65535)
			);
		}

		/*!
			Alias of ip_v6_address()

			\return String - An IPv6 address in hex-colon notation
		*/
		public function ip_v6 () {
			return $this->ip_v6_address();
		}

	}
