<?php
/*
Template Name: AJAX Project Load
*/
?>

<?php
$proj_ID = $_REQUEST["proj_ID"];
$post = get_post($proj_ID);
//$args = array( 'post_type' => 'project', 'p' => $proj_ID, 'posts_per_page' => 1 );
//$loop = new WP_Query($args);

?>
<?php if ($post) : ?>
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
<?php endif; ?>