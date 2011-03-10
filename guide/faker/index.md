K3-Faker Module
==============

A Ko3 Module by [**John Hobbs**](http://twitter.com/jmhobbs) of
**[Little Filament, Inc.](http://littlefilament.com)**

Introduction
------------

This module provides a lazy-loading, modular, locale aware fake data generator for Kohana 3.1.x.

It is inspired by (and borrows data from) Ruby's [Faker gem](http://faker.rubyforge.org/), and Perl's [Data::Faker](http://search.cpan.org/~jasonk/Data-Faker-0.07/lib/Data/Faker.pm)

Installation
------------

K3-Faker is a simple, standard module.

1. Drop the source in your MODPATH folder.
2. Add the module to Kohana::modules in your bootstrap.php

Usage
-----

Use the module methods from Faker:

    echo 'Name: ' . Faker::Name()->name();

Output:

    Name: Abbigail Vandervort

Additionally, if you have no arguments, you can now act as if the module method is a property.

    echo 'Name: ' . Faker::Name()->name;

Full documentation is available [online](http://jmhobbs.github.com/K3-Faker/doc/html/index.html)

Inspiration / Credit
--------------------

- <http://faker.rubyforge.org/>
- <http://www.lipsum.com/>
