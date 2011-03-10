<?php defined('SYSPATH') or die('No direct access allowed.');

	/*!
		@mainpage K3-Faker

		@section section_what_is_k3_faker What is K3-Faker?

		It is a lazy-loading, modular, locale aware fake data module for Kohana 3.1.x.

		It is inspired by (and borrows data from) Ruby's Faker gem, http://faker.rubyforge.org/,
		and Perl's Data::Faker, http://search.cpan.org/~jasonk/Data-Faker-0.07/lib/Data/Faker.pm

		@section section_installing Installing K3-Faker

		@li Drop the source in your <tt>MODPATH</tt> folder.
		@li Add the module to <tt>Kohana::modules</tt> in your <tt>bootstrap.php</tt>

		@section section_usage Using K3-Faker

		Use the module methods from Faker:
		\code
echo 'Name: ' . Faker::Name()->name();
		\endcode

		Output:
		\code
Name: Abbigail Vandervort
		\endcode

		Additionally, if you have no arguments, you can now act as if the module method is a property.

		\code
echo 'Name: ' . Faker::Name()->name;
		\endcode

		@section section_installing Default Modules

		K3-Faker comes with several default modules, each with several methods.

		@li \link Kohana_Faker_Address Address \endlink
		@li \link Kohana_Faker_Company Company \endlink
		@li \link Kohana_Faker_Internet Internet \endlink
		@li \link Kohana_Faker_Lipsum Lipsum \endlink
		@li \link Kohana_Faker_Name Name \endlink
		@li \link Kohana_Faker_Phone Phone \endlink
	*/

	/*!
		Get fake information from a variety of modules.

		Example:
		\code
echo 'Name: ' . Faker::Name()->name() . "\n";
// Unless you have an argument to pass, you can just pretend it's a property
echo 'Phone: ' . Faker::Phone()->number . "\n";
		\endcode

		Output:
		\code
Name: Abbigail Vandervort
Phone: 1-202-479-9161
		\endcode
	*/
	class Faker extends Kohana_Faker {}
