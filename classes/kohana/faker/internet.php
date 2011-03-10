<?php defined('SYSPATH') or die('No direct script access.');

	class Kohana_Faker_Internet extends Kohana_Faker_Core {

		protected static $FREE_EMAIL_DOMAIN = null;
		protected static $DOMAIN_SUFFIX     = null;

		public function email ( $name = null ) {
			return sprintf(
				'%s@%s',
				$this->user_name( $name ),
				$this->domain_name()
			);
		}

		public function free_email ( $name = null ) {
			return sprintf(
				'%s@%s',
				$this->user_name( $name ),
				self::data_rand( 'free_email_domain' )
			);
		}

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

		public function domain_name () {
			return sprintf(
				'%s.%s',
				$this->domain_word(),
				self::data_rand( 'domain_suffix' )
			);
		}

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

		public function ip_v4_address () {
			return sprintf(
				'%d.%d.%d.%d',
				mt_rand(2,255),
				mt_rand(2,255),
				mt_rand(2,255),
				mt_rand(2,255)
			);
		}

		public function ip_v4 () {
			return $this->ip_v4_address();
		}

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

		public function ip_v6 () {
			return $this->ip_v6_address();
		}

	}
