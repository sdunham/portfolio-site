<?php get_header(); ?>	
	<section>
		<aside id="braces">{ }</aside>
		<article id="welcome">
			<?php $pages = get_pages(array(
				'meta_key' => '_wp_page_template',
				'meta_value' => 'page-home.php'
			));
			foreach($pages as $page): ?>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			<?php endforeach; ?>
		</article>
	</section>
<?php get_footer(); ?>
