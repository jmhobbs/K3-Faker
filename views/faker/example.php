<html>
	<body>
		<?php
			// You can call most methods as methods...
			$first_name = Faker::Name()->first();
			// You can also pretend they are properties
			$last_name = Faker::Name()->last;
		?>

		<h1>K3-Faker Profile Example</h1>
		<h2><?php echo html::chars( $first_name . ' ' . $last_name ); ?></h2>

		<p><?php echo html::chars( Faker::Lipsum()->p ); ?></p>

		<h3>Contact Information</h3>
		<p>
			<!--// Some of these take optional arguments //-->
			<?php echo html::chars( Faker::Internet()->email($first_name) ); ?>
		</p>

		<h3>Address</h3>
		<p>
			<?php echo html::chars( Faker::Address()->street_address ); ?><br/>
			<?php echo html::chars( Faker::Address()->secondary_address ); ?><br/>
			<?php echo html::chars( Faker::Address()->city . ', ' . Faker::Address()->state_abbreviation . ' ' . Faker::Address()->zip ); ?>
		</p>

		<h3>Emergency Contact</h3>
		<p>
			<?php echo html::chars( Faker::Name()->name ); ?><br/>
			<?php echo html::chars( Faker::Phone()->number ); ?><br/>
			<?php echo html::chars( Faker::Internet()->free_email ); ?>
		</p>

		<h3>Company</h3>
		<p>
			<b><?php echo html::chars( Faker::Company()->name ); ?></b><br/>
			<em><?php echo html::chars( Faker::Company()->catch_phrase ); ?></em><br/>
			http://www.<?php echo html::chars( Faker::Internet()->domain_name ); ?>
		</p>

		<h3>Computer</h3>
		<p>
			IPv4: <?php echo html::chars( Faker::Internet()->ip_v4_address ); ?><br/>
			IPv6: <?php echo html::chars( Faker::Internet()->ip_v6 ); ?>
		</p>
	</body>
</html>
