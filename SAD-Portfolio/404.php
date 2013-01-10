<?php get_header(); ?>
	<?php
		$arrayOfCuteStuff = array(
		"http://placekitten.com/500/500",
		"http://placedog.com/500/500",
		"http://flickholdr.com/500/500/bunny",
		"http://placeape.com/500/500",
		"http://flickholdr.com/500/500/ferret"
		);
		$cuteImageURL = $arrayOfCuteStuff[rand(0,4)];
	?>
	<section id="fourOhFour">
		<h1>This Isn't the Page You're Looking For...</h1>
		<p>But don't worry... Here's a consolation prize:</p>
		<img src="<?php echo $cuteImageURL ?>" />
	</section>
<?php get_footer(); ?>
