<?php
/*
Template Name: Stuff I Like
*/
?>

<?php get_header(); ?>
	<section id="like">
		<h1>Stuff I Like, and Therefore You Should Too</h1>
		<div id="designers" class="arr like-list">
			<h1>Web Design/Development</h1>
			<?php $args = array(
				'category_name'    => 'Designers',
				'before'           => '',
				'after'            => '',
				'echo'             => 1,
				'categorize'       => 0,
				'title_li'         => 0 ); ?>
			<?php wp_list_bookmarks( $args ); ?>
		</div>
		<div id="software" class="gee like-list">
			<h1>Software, Services & Tools</h1>
			<?php $args = array(
				'category_name'    => 'Software',
				'before'           => '',
				'after'            => '',
				'echo'             => 1,
				'categorize'       => 0,
				'title_li'         => 0 ); ?>
			<?php wp_list_bookmarks( $args ); ?>
		</div>
		<div id="fun" class="bee like-list">
			<h1>Fun Stuff</h1>
			<?php $args = array(
				'category_name'    => 'Fun',
				'before'           => '',
				'after'            => '',
				'echo'             => 1,
				'categorize'       => 0,
				'title_li'         => 0 ); ?>
			<?php wp_list_bookmarks( $args ); ?>
		</div>
	</section>
<?php get_footer(); ?>