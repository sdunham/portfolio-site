<?php
/*
Template Name: Portfolio
*/
?>

<?php get_header(); ?>
	<section id="project-details">
		<div class="project">
			<?php
			$args = array( 'post_type' => 'project', 'posts_per_page' => 1 );
			$loop = new WP_Query($args); ?>
			<?php if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); ?>
			<?php
			$proj_tech_1 = get_post_meta($post->ID, '_projtech1', true);
			$proj_tech_2 = get_post_meta($post->ID, '_projtech2', true);
			$proj_tech_3 = get_post_meta($post->ID, '_projtech3', true);
			$proj_feat_1 = get_post_meta($post->ID, '_projfeat1', true);
			$proj_feat_2 = get_post_meta($post->ID, '_projfeat2', true);
			$proj_feat_3 = get_post_meta($post->ID, '_projfeat3', true);
			$proj_url = get_post_meta($post->ID, '_projurl', true);
			$proj_title = get_the_title();
			?>
			<div class="project">
                <h1><?php echo $proj_title; ?></h1>
				<?php if(has_post_thumbnail()): ?>
                <?php the_post_thumbnail('medium'); ?>
				<?php endif; ?>
				<?php the_content(); ?>
				<?php if($proj_tech_1 || $proj_tech_2 || $proj_tech_3): ?>
                <div class="list">
                    <h2>Technologies Used:</h2>
                    <ul>
                        <?php echo ($proj_tech_1 ? "<li>" . $proj_tech_1 . "</li>" : "" ); ?>
                        <?php echo ($proj_tech_2 ? "<li>" . $proj_tech_2 . "</li>" : "" ); ?>
                        <?php echo ($proj_tech_3 ? "<li>" . $proj_tech_3 . "</li>" : "" ); ?>
                    </ul>
                </div>
				<?php endif; ?>
				<?php if($proj_feat_1 || $proj_feat_2 || $proj_feat_3): ?>
                <div class="list">
                    <h2>Features of Note:</h2>
                    <ul>
                        <?php echo ($proj_feat_1 ? "<li>" . $proj_feat_1 . "</li>" : "" ); ?>
                        <?php echo ($proj_feat_2 ? "<li>" . $proj_feat_2 . "</li>" : "" ); ?>
                        <?php echo ($proj_feat_3 ? "<li>" . $proj_feat_3 . "</li>" : "" ); ?>
                    </ul>
                </div>
				<?php endif; ?>
                <br>
				<?php if($proj_url): ?>
                <a href="<?php echo $proj_url; ?>" class="more-info" target="_blank">Check It Out >></a>
				<?php endif; ?>
            </div>
			<?php endwhile; ?>
			<?php else : ?>
			<p style="text-align:center; font-style:italic;">No projects were found. Please check back soon!</p>
			<?php endif; ?>
		</div>
	</section>
	<section id="project-list">
		<div id="jquery" class="arr">
			<h1>jQuery Projects</h1>
			<?php
			$metaQuery = array(array('key' => '_projcat', 'value' => 'jquery', 'compare' => '='));
			$args = array( 'post_type' => 'project', 'meta_query'=> $metaQuery, 'meta_key'=>'_projcat', 'orderby' => 'title', 'order' => 'ASC' );
			$loop = new WP_Query($args);
			?>
			<?php if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); ?>
			<p class="<?php the_ID(); ?>"><?php the_title(); ?></p>
			<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<div id="design" class="gee">
			<h1>Web Design Projects</h1>
			<?php
			$metaQuery = array(array('key' => '_projcat', 'value' => 'web', 'compare' => '='));
			$args = array( 'post_type' => 'project', 'meta_query'=> $metaQuery, 'meta_key'=>'_projcat', 'orderby' => 'title', 'order' => 'ASC' );
			$loop = new WP_Query($args);
			?>
			<?php if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); ?>
			<p class="<?php the_ID(); ?>"><?php the_title(); ?></p>
			<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<div id="programming" class="bee">
			<h1>Programming Projects</h1>
			<?php
			$metaQuery = array(array('key' => '_projcat', 'value' => 'prog', 'compare' => '='));
			$args = array( 'post_type' => 'project', 'meta_query'=> $metaQuery, 'meta_key'=>'_projcat', 'orderby' => 'title', 'order' => 'ASC' );
			$loop = new WP_Query($args);
			?>
			<?php if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); ?>
			<p class="<?php the_ID(); ?>"><?php the_title(); ?></p>
			<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</section>
<?php get_footer(); ?>