<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
    - head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
    - custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once('library/bones.php'); // if you remove this, bones will break
/*
2. library/custom-post-type.php
    - an example custom post type
    - example custom taxonomy (like categories)
    - example custom taxonomy (like tags)
*/
require_once('library/custom-post-type.php'); // you can disable this if you like
/*
3. library/admin.php
    - removing some default WordPress dashboard widgets
    - an example custom dashboard widget
    - adding custom login css
    - changing text in footer of admin
*/
// require_once('library/admin.php'); // this comes turned off by default
/*
4. library/translation/translation.php
    - adding support for other languages
*/
// require_once('library/translation/translation.php'); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Sidebar 1',
    	'description' => 'The first (primary) sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    /* 
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call 
    your new sidebar just use the following code:
    
    Just change the name to whatever your new
    sidebar's id is, for example:
    
    register_sidebar(array(
    	'id' => 'sidebar2',
    	'name' => 'Sidebar 2',
    	'description' => 'The second (secondary) sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php
    
    */
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
			    <?php 
			    /*
			        this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
			        echo get_avatar($comment,$size='32',$default='<path_to_url>' );
			    */ 
			    ?>
			    <!-- custom gravatar call -->
			    <?php
			    	// create variable
			    	$bgauthemail = get_comment_author_email();
			    ?>
			    <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
			    <!-- end custom gravatar call -->
				<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
				<?php edit_comment_link(__('(Edit)', 'bonestheme'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
       			<div class="alert info">
          			<p><?php _e('Your comment is awaiting moderation.', 'bonestheme') ?></p>
          		</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
    <!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search the Site...','bonestheme').'" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
} // don't remove this bracket!


/************* CUSTOM POST TYPE - PROJECT *****************/

// Registers the new post type and taxonomy
function sad_project_posttype() {
    register_post_type( 'project',
        array(
            'labels' => array(
                'name' => __( 'Project' ),
                'singular_name' => __( 'Project' ),
                'add_new' => __( 'Add New Project' ),
                'add_new_item' => __( 'Add New Project' ),
                'edit_item' => __( 'Edit Project' ),
                'new_item' => __( 'Add New Project' ),
                'view_item' => __( 'View Project' ),
                'search_items' => __( 'Search Projects' ),
                'not_found' => __( 'No projects found' ),
                'not_found_in_trash' => __( 'No projects found in trash' )
            ),
            'public' => true,
            'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
            'capability_type' => 'post',
            'rewrite' => array("slug" => "project"), // Permalinks format
            'menu_position' => 5,
            'register_meta_box_cb' => 'add_project_metaboxes'
        )
    );
}
add_action( 'init', 'sad_project_posttype' );

// Add the Project Meta Boxes
function add_project_metaboxes() {
    add_meta_box('sad_project_data', 'Project Info', 'sad_project_data', 'project', 'normal', 'high');
}

// The Project Name Metabox
function sad_project_data() {
    global $post;
    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="projectmeta_noncename" id="projectmeta_noncename" value="' .
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    // Get the data if its already been entered
    $proj_tech_1 = get_post_meta($post->ID, '_projtech1', true);
	$proj_tech_2 = get_post_meta($post->ID, '_projtech2', true);
	$proj_tech_3 = get_post_meta($post->ID, '_projtech3', true);
	$proj_feat_1 = get_post_meta($post->ID, '_projfeat1', true);
	$proj_feat_2 = get_post_meta($post->ID, '_projfeat2', true);
	$proj_feat_3 = get_post_meta($post->ID, '_projfeat3', true);
	$proj_url = get_post_meta($post->ID, '_projurl', true);
	$proj_cat = get_post_meta($post->ID, '_projcat', true);
    // Echo out the fields
    echo '<p>Technology Used:</p>';
	echo '<input type="text" name="_projtech1" value="' . $proj_tech_1  . '" class="widefat" />';
	echo '<input type="text" name="_projtech2" value="' . $proj_tech_2  . '" class="widefat" />';
	echo '<input type="text" name="_projtech3" value="' . $proj_tech_3  . '" class="widefat" />';
	echo '<p>Features:</p>';
	echo '<input type="text" name="_projfeat1" value="' . $proj_feat_1  . '" class="widefat" />';
	echo '<input type="text" name="_projfeat2" value="' . $proj_feat_2  . '" class="widefat" />';
	echo '<input type="text" name="_projfeat3" value="' . $proj_feat_3  . '" class="widefat" />';
	echo '<p>URL:</p>';
	echo '<input type="text" name="_projurl" value="' . $proj_url  . '" class="widefat" />';
	echo '<p>Category:</p>';
	echo '<input type="radio" name="_projcat" value="jquery" ' . (($proj_cat == 'jquery') ? 'checked="checked"' : '') . '/> jQuery<br />';
	echo '<input type="radio" name="_projcat" value="web" ' . (($proj_cat == 'web') ? 'checked="checked"' : '') . '/> Web Design<br />';
	echo '<input type="radio" name="_projcat" value="prog" ' . (($proj_cat == 'prog') ? 'checked="checked"' : '') . '/> Programming<br />';
}

// Save the Metabox Data
function wpt_save_project_meta($post_id, $post) {
    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( !wp_verify_nonce( $_POST['projectmeta_noncename'], plugin_basename(__FILE__) )) {
    return $post->ID;
    }
    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;
    // OK, we're authenticated: we need to find and save the data
    // We'll put it into an array to make it easier to loop though.
    $proj_meta['_projtech1'] = $_POST['_projtech1'];
	$proj_meta['_projtech2'] = $_POST['_projtech2'];
	$proj_meta['_projtech3'] = $_POST['_projtech3'];
	$proj_meta['_projfeat1'] = $_POST['_projfeat1'];
	$proj_meta['_projfeat2'] = $_POST['_projfeat2'];
	$proj_meta['_projfeat3'] = $_POST['_projfeat3'];
	$proj_meta['_projurl'] = $_POST['_projurl'];
	$proj_meta['_projcat'] = $_POST['_projcat'];
    // Add values of $proj_meta as custom fields
    foreach ($proj_meta as $key => $value) { // Cycle through the $proj_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    }
}
add_action('save_post', 'wpt_save_project_meta', 1, 2); // save the custom fields

// Change the columns for the edit Project screen
function proj_change_columns( $cols ) {
  $cols = array(
    'cb'        => '<input type="checkbox" />',
    'title'     => __( 'Project Title',      'trans' ),
	'projurl'   => __( 'Project URL',      'trans' ),
    'projcat' => __( 'Project Category', 'trans' ),
  );
  return $cols;
}
add_filter( "manage_seminar_posts_columns", "proj_change_columns" );

function proj_custom_columns( $column, $post_id ) {
  switch ( $column ) {
    case "title":
      $col_title = get_the_title($post_id);
	  echo '<a href="' . get_edit_post_link($post_id) . '">' . $col_title . '</a>';
      break;
	case "semdate":
      echo get_post_meta( $post_id, '_semdate', true);
      break;
    case "presenter":
      echo get_post_meta( $post_id, '_sempres', true);
      break;
  }
}

add_action( "manage_posts_custom_column", "proj_custom_columns", 10, 2 );


?>