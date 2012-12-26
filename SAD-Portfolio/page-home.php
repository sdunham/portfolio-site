<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>
	<section>
		<aside id="braces">{ }</aside>
		<article id="welcome">
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</article>
	</section>
<?php get_footer(); ?>