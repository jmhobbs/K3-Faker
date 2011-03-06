<?php defined('SYSPATH') or die('No direct script access.');

	class Faker {
		protected static $LIPSUM = array(
			'a', 'ac', 'accumsan', 'ad', 'adipiscing', 'aenean', 'aliquam', 'aliquet',
			'amet', 'ante', 'aptent', 'arcu', 'at', 'auctor', 'augue', 'bibendum',
			'blandit', 'class', 'commodo', 'condimentum', 'congue', 'consectetur',
			'consequat', 'conubia', 'convallis', 'cras', 'curabitur', 'cursus', 'diam',
			'dictum', 'dictumst', 'dignissim', 'dolor', 'donec', 'dui', 'duis', 'eget',
			'eleifend', 'elementum', 'elit', 'enim', 'erat', 'eros', 'est', 'et', 'etiam',
			'eu', 'euismod', 'facilisi', 'facilisis', 'faucibus', 'felis', 'fermentum',
			'feugiat', 'fringilla', 'fusce', 'gravida', 'habitasse', 'hac', 'hendrerit',
			'himenaeos', 'iaculis', 'id', 'imperdiet', 'in', 'inceptos', 'integer', 'interdum',
			'ipsum', 'justo', 'lacinia', 'lacus', 'laoreet', 'lectus', 'leo', 'libero',
			'litora', 'lobortis', 'lorem', 'luctus', 'maecenas', 'magna', 'malesuada',
			'massa', 'mattis', 'mauris', 'metus', 'mi', 'molestie', 'mollis', 'morbi',
			'nam', 'nec', 'neque', 'nibh', 'nisi', 'nisl', 'non', 'nostra', 'nulla',
			'nullam', 'nunc', 'odio', 'orci', 'ornare', 'pellentesque', 'per', 'pharetra',
			'phasellus', 'placerat', 'platea', 'porta', 'porttitor', 'posuere', 'praesent',
			'pretium', 'proin', 'purus', 'quam', 'quis', 'quisque', 'rhoncus', 'risus',
			'rutrum', 'sagittis', 'sapien', 'scelerisque', 'sed', 'sem', 'semper', 'sit',
			'sociosqu', 'sodales', 'sollicitudin', 'suscipit', 'suspendisse', 'taciti',
			'tellus', 'tempor', 'tempus', 'tincidunt', 'torquent', 'tortor', 'turpis',
			'ullamcorper', 'ultrices', 'ultricies', 'urna', 'ut', 'varius', 'vel', 'velit',
			'venenatis', 'vestibulum', 'vitae', 'vivamus', 'viverra', 'volutpat', 'vulputate'
		);

	public static function lipsum_p () {
		$sentences = mt_rand( 4, 10 );
		$output = array();
		for( $i = 0; $i < $sentences; ++$i ) {
			$output[] = self::lipsum_s();
		}
		return implode( ' ', $output );
	}

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

	public static function lipsum_w () {
		return self::$LIPSUM[array_rand( self::$LIPSUM )];
	}

}
