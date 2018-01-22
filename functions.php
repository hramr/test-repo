<?php
/**
 * ura functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ura
 */

function ura_lehti_protected_excerpt( $excerpt ) {
  if ( post_password_required() ) {
    $post = get_post();
    $excerpt=$post->post_excerpt;
  }
  return $excerpt;
}
add_filter( 'the_excerpt', 'ura_lehti_protected_excerpt' );
 
function ura_lehti_protected_excerpt_posts( $content ) {
  if ( post_password_required() && is_single() ) {
  $post = get_post();
 
  return $post->post_excerpt.$content;
}}
add_filter( 'the_content', 'ura_lehti_protected_excerpt_posts', 10 );

/*rest api test*/
add_action( 'rest_api_init', 'ura_lehti_add_thumbnail_to_JSON' );
function ura_lehti_add_thumbnail_to_JSON() {
//Add featured image
register_rest_field( 'post',
    'featured_image_src', //NAME OF THE NEW FIELD TO BE ADDED - you can call this anything
    array(
        'get_callback'    => 'ura_lehti_get_image_src',
        'update_callback' => null,
        'schema'          => null,
         )
    );
}

function ura_lehti_get_image_src( $object, $field_name, $request ) {
    $feat_img_array = wp_get_attachment_image_src($object['featured_media'], 'thumbnail', true);
    return $feat_img_array[0];
}

/*custom functions*/

function ura_lehti_youtube_as_featured_image($post_id) {  
    // only want to do this if the post has no thumbnail
    if(!has_post_thumbnail($post_id)) { 

        // find the youtube url
        $post_array = get_post($post_id, ARRAY_A);
        $content = $post_array['post_content'];
        // $youtube_id = ura_lehti_youtube_id($content);   
        $meta_values = get_post_meta($post_id, $key, $single);
        $youtube_id = $meta_values['youtube_id'][0];

          // build the thumbnail string
          $youtube_thumb_url = 'https://img.youtube.com/vi/' . $youtube_id . '/maxresdefault.jpg';

          // next, download the URL of the youtube image
          media_sideload_image($youtube_thumb_url, $post_id, 'Sample youtube image.');

          //add hidden custom field
          //add_post_meta( $post_id, 'youtube_id', $youtube_id, true );        

          // find the most recent attachment for the given post
          $attachments = get_posts(
              array(
                  'post_type' => 'attachment',
                  'numberposts' => 1,
                  'order' => 'ASC',
                  'post_parent' => $post_id
              )
          );
          $attachment = $attachments[0];

          // and set it as the post thumbnail
          set_post_thumbnail( $post_id, $attachment->ID );


    } // end if

} // set_youtube_as_featured_image
// add_action('save_post', 'ura_lehti_youtube_as_featured_image');

function ura_lehti_youtube_id($content) {

    // find the youtube-based URL in the post
    $urls = array();
    preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $content, $urls);
    $youtube_url = $urls[0][0];

    // next, locate the youtube video id
    $youtube_id = '';
    if(strlen(trim($youtube_url)) > 0) {
        parse_str( parse_url( $youtube_url, PHP_URL_QUERY ) );
        $youtube_id = $v;
    } // end if

    return $youtube_id; 

} // end get_youtube_id

/*load wpcf7 only when needed*/
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

add_action('publish_page', 'ura_lehti_add_custom_field_automatically');
add_action('publish_post', 'ura_lehti_add_custom_field_automatically');
function ura_lehti_add_custom_field_automatically($post_ID) {
  global $wpdb;
  if(!wp_is_post_revision($post_ID) && 'post_type' == 'nimitykset' ) {
    add_post_meta($post_ID, 'pvm', ' tyhja ', true);
  }
}

function ura_lehti_cpt_tags( $tagQuery ) {
    if ( $tagQuery->is_tag() && $tagQuery->is_main_query() ) {
        $tagQuery->set( 'post_type', array( 'blogit' ) );
    }
}
add_action( 'pre_get_posts', 'ura_lehti_cpt_tags' );

/*acf respo*/
add_filter( 'acf_the_content', 'wp_make_content_images_responsive' );

add_action( 'post_submitbox_misc_actions', 'ura_lehti_featured_post_field' );
function ura_lehti_featured_post_field() {
    global $post;

    /* check if this is a post, if not then we won't add the custom field */
    /* change this post type to any type you want to add the custom field to */
    if (get_post_type($post) == ('page' )) return true;

    /* get the value corrent value of the custom field */
    $value = get_post_meta($post->ID, 'ura_lehti_featured_post_field', true);
    ?>
        <div class="misc-pub-section">
            <?php //if there is a value (1), check the checkbox ?>
            <label><input type="checkbox"<?php echo (!empty($value) ? ' checked="checked"' : null) ?> value="1" name="ura_lehti_featured_post_field" /> Toimituksen tärppi</label>
        </div>
    <?php
}

add_action( 'save_post', 'ura_lehti_save_postdata');
function ura_lehti_save_postdata($postid)
{
    /* check if this is an autosave */
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return false;

    /* check if the user can edit this page */
    if ( !current_user_can( 'edit_page', $postid ) ) return false;

    /* check if there's a post id and check if this is a post */
    /* make sure this is the same post type as above */
    if(empty($postid) || $_POST['post_type'] == 'page' ) return true;

    /* if you are going to use text fields, then you should change the part below */
    /* use add_post_meta, update_post_meta and delete_post_meta, to control the stored value */

    /* check if the custom field is submitted (checkboxes that aren't marked, aren't submitted) */
    if(isset($_POST['ura_lehti_featured_post_field'])){
        /* store the value in the database */
        add_post_meta($postid, 'ura_lehti_featured_post_field', 1, true );
    }
    else{
        /* not marked? delete the value in the database */
        delete_post_meta($postid, 'ura_lehti_featured_post_field');
    }
}


/*excerpt class*/
add_action('the_excerpt','ura_lehti_class_to_excerpt');
function ura_lehti_class_to_excerpt( $excerpt ){
    return '<div class="excerptContainer">'.$excerpt.'</div>';
}

/**
 * Registers an editor stylesheet for the theme.
 */
function ura_lehti_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'admin_init', 'ura_lehti_add_editor_styles' );

 /* Custom elements to TinyMCE*/

function ura_lehti_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'ura_lehti_mce_buttons_2');

/*
* Callback function to filter the MCE settings
*/

function ura_lehti_before_init_insert_formats( $init_array ) {  

// Define the style_formats array

  $style_formats = array(  
    // Each array child is a format with it's own settings
    array(  
      'title' => 'nosto',  
      'block' => 'div',  
      'classes' => 'nosto',
      'wrapper' => true,
    ),
        array(  
      'title' => 'kainalo-block',  
      'block' => 'div',  
      'classes' => 'kainalo-block',
      'wrapper' => true,
    ),
  );  
  // Insert the array, JSON ENCODED, into 'style_formats'
  $init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'ura_lehti_before_init_insert_formats' ); 


// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Remove WP Version From Styles	
add_filter( 'style_loader_src', 'ura_lehti_remove_ver_css_js', 9999 );
// Remove WP Version From Scripts
add_filter( 'script_loader_src', 'ura_lehti_remove_ver_css_js', 9999 );

// Function to remove version numbers
function ura_lehti_remove_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

//remove admin menu items

function ura_lehti_remove_page_fields() {
 remove_meta_box( 'commentstatusdiv' , 'home' , 'normal' ); //removes comments status
 remove_meta_box( 'commentsdiv' , 'home' , 'normal' ); //removes comments
 //remove_meta_box( 'authordiv' , 'home' , 'normal' ); //removes author 
}
//add_action( 'admin_menu' , 'ura_lehti_remove_page_fields' );

// unregister all widgets
function ura_lehti_remove_default_widgets() {
      unregister_widget('WP_Widget_Pages');
      unregister_widget('WP_Widget_Calendar');
      unregister_widget('WP_Widget_Archives');
      unregister_widget('WP_Widget_Links');
      unregister_widget('WP_Widget_Meta');
      unregister_widget('WP_Widget_Search');
      unregister_widget('WP_Widget_Text');
      unregister_widget('WP_Widget_Categories');
      unregister_widget('WP_Widget_Recent_Posts');
      unregister_widget('WP_Widget_Recent_Comments');
      unregister_widget('WP_Widget_RSS');
      unregister_widget('WP_Widget_Tag_Cloud');
      unregister_widget('WP_Nav_Menu_Widget');
  }
add_action('widgets_init', 'ura_lehti_remove_default_widgets', 11);

/*https://codex.wordpress.org/Function_Reference/remove_menu_page*/
function remove_menus(){

  //remove_menu_page( 'edit-comments.php' );//Comments
  //remove_menu_page('tools.php' );         //Tools
  //remove_menu_page('index.php' );         //Dashboard
  //remove_menu_page('edit.php' );          //Posts
  //remove_menu_page('profile.php' );       //Profiili
}
add_action( 'admin_menu', 'remove_menus' );

//cpt
function ura_lehti_cpt_nimitykset(){

  register_post_type('Nimitykset',
    array(
      'label' => ('Nimitykset'),
      'public' => true,
      'show_ui'=>true,
      'has_archive' => true,
      'menu_icon'  => 'dashicons-groups',
      'show_in_nav_menus'=>true,
      'rewrite'=>array(
        'slug'=> '',
        'with_front'=>false,
        ),
        'supports' =>array(
          'title','thumbnail','editor','excerpt','custom-fields', 'revisions'),
        	'taxonomies'=>array('post_title')
        ));
}
add_action('init', 'ura_lehti_cpt_nimitykset');

function ura_lehti_cpt_lainMukaan(){
  register_post_type('lainMukaan',
    array(
      'label' => ('Lain Mukaan'),
      'public' => true,
      'show_ui'=>true,
      'has_archive' => true,
      'show_in_nav_menus'=>true,
      'rewrite'=>array(
        'slug'=> '',
        'with_front'=>false,
        ),
        'supports' =>array(
          'title','thumbnail','editor','excerpt','custom-fields'),
        	'taxonomies'=>array('post_title')
        ));
}
add_action('init', 'ura_lehti_cpt_lainMukaan');

function ura_lehti_cpt_lehdet(){
  register_post_type('lehdet',
    array(
      'label' => ('Lehdet'),
      'public' => true,
      'publicly_queryable'  => false,
      'exclude_from_search' => true,
      'menu_icon'  => 'dashicons-book',
      'show_ui'=>true,      
      'show_in_nav_menus'=>true,
      'rewrite'=>array(
        'slug'=> '',
        'with_front'=>false,
        ),
        'supports' =>array(
          'title','thumbnail','editor','excerpt','custom-fields'),
          'taxonomies'=>array('post_title')
        ));
}
add_action('init', 'ura_lehti_cpt_lehdet');

function ura_lehti_cpt_blogit(){
  register_post_type('blogit',
    array(
      'label' => ('Blogit'),
      'publicly_queryable'  => true,
      'show_in_rest' => true,
      'public' => true,
      'menu_icon'  => 'dashicons-money',
      'has_archive' => true,
      'show_ui'=>true,
      'show_in_nav_menus'=>true,
      'rewrite'=>array(
        'slug'=> '',
        'with_front'=>true,
        ),
        'supports' =>array(
          'title','thumbnail','editor','custom-fields','comments','revisions'),
        	'taxonomies'=>array('post_title','post_tag')
        ));
}
add_action('init', 'ura_lehti_cpt_blogit');

// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'ura_lehti_blogit_taxonomies', 0 );

function ura_lehti_blogit_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Blogaukset', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Blogaus', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Blogaukset', 'textdomain' ),
		'all_items'         => __( 'All Blogaukset', 'textdomain' ),
		'parent_item'       => __( 'Parent Blogaus', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Blogaus:', 'textdomain' ),
		'edit_item'         => __( 'Edit Blogaus', 'textdomain' ),
		'update_item'       => __( 'Update Blogaus', 'textdomain' ),
		'add_new_item'      => __( 'Add New Blogaus', 'textdomain' ),
		'new_item_name'     => __( 'New Blogaus Name', 'textdomain' ),
		'menu_name'         => __( 'Blogaus', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'blogikirjoitus' ),
	);
  register_taxonomy( 'blokaus', 'blogit' , $args );  
  register_taxonomy_for_object_type( 'blokaus', 'blogit' );  
}

/*kirjoittajat*/
function ura_lehti_cpt_kirjoittajat(){
  register_post_type('kirjoittajat',
    array(
      'label' => ('Kirjoittajat'),
      'public' => true,      
      'show_ui'=>true,
      'show_in_nav_menus'=>true,
      'menu_icon'  => 'dashicons-edit',
      'rewrite'=>array(
        'slug'=> '',
        'with_front'=>true,
        ),
        'supports' =>array(
          'title','thumbnail'),
          'taxonomies'=>array('post_title')
        ));
}
add_action('init', 'ura_lehti_cpt_kirjoittajat');


if ( ! function_exists( 'ura_lehti_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ura_lehti_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ura, use a find and replace
	 * to change 'ura-lehti' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ura-lehti', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	// register_nav_menus( array(
	// 	'menu-1' => esc_html__( 'Primary', 'ura-lehti' ),
 //    'menu-2' => esc_html__( 'Secondary Menu', 'ura-lehti' ),
	// ) );

function ura_lehti_register_my_menus() {
  register_nav_menus(
    array(
      'menu-1' => __( 'Menu-1' ),
      'menu-2' => __( 'Menu-2' )
    )
  );
}
add_action( 'init', 'ura_lehti_register_my_menus' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ura_lehti_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'ura_lehti_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ura_lehti_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ura_lehti_content_width', 640 );
}
add_action( 'after_setup_theme', 'ura_lehti_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ura_lehti_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ura-lehti' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ura-lehti' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ura_lehti_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ura_lehti_scripts() {
	wp_enqueue_style( 'ura-lehti-style', get_stylesheet_uri() );

	wp_enqueue_script( 'ura-lehti-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'ura-lehti-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ura_lehti_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/* Metabox youtube */
$yt_types = array('post');

add_action('add_meta_boxes', 'ura_youtube_src_metabox');
    function ura_youtube_src_metabox(){
    add_meta_box('meta_box_yt_html_id', 'Youtube ID', 'ura_youtube_src_functions', $yt_types, 'normal', 'high');
}

function ura_youtube_src_functions() {
    global $post;  
    echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
    wp_create_nonce(plugin_basename(__FILE__)) . '" />';
    $youtube_src = get_post_meta($post->ID, '_youtube_src', true);
?>

    Muotoa: 4nAKsWkQ2s0 - eli lisätään ainoastaan videon tunnusosa.
    <input type="text" name="youtube_src" value="<?php echo $youtube_src; ?>" class="widefat" />
<?php
}

add_action ('save_post', 'ura_save_youtube_src');

function ura_save_youtube_src($post_id) {
     if ($_POST['youtube_src'] != '') {
        update_post_meta ($post_id, '_youtube_src', strip_tags($_POST['youtube_src']));
        if(!has_post_thumbnail($post_id)) {         
          $youtube_thumb_url = 'https://img.youtube.com/vi/' . $_POST['youtube_src'] . '/maxresdefault.jpg';
          media_sideload_image($youtube_thumb_url, $post_id, 'Sample youtube image.');
          $attachments = get_posts(
              array(
                  'post_type' => 'attachment',
                  'numberposts' => 1,
                  'order' => 'ASC',
                  'post_parent' => $post_id
              )
          );
          $attachment = $attachments[0];
          set_post_thumbnail( $post_id, $attachment->ID );
        }
     }
}

/* Metabox youtube END */

/* Vanhojen URLien käsittelyt */

$url_types = array('post', 'page', 'blogit', 'lainMukaan', 'Nimitykset');

add_action('add_meta_boxes', 'ura_old_url_metabox');
    function ura_old_url_metabox(){
    add_meta_box('meta_box_html_id', 'Vanha URL', 'ura_old_url_functions', $url_types, 'normal', 'high');
}

function ura_old_url_functions() {
    global $post;  
    echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
    wp_create_nonce(plugin_basename(__FILE__)) . '" />';
    $old_url = get_post_meta($post->ID, '_old_url', true);
?>

    Muotoa: "kategoria/juttu-artikkeli". Eli pelkästään vanhan osoitteen polku, ei domainia.
    <input type="text" name="old_url" value="<?php echo $old_url; ?>" class="widefat" />
<?php
}


add_action ('save_post', 'ura_save_old_url');

function ura_save_old_url($post_id) {
     if (isset( $_POST['old_url'])) {
     update_post_meta ($post_id, '_old_url', strip_tags($_POST['old_url']));
     }
}

function ura_old_url_redirect() {
    global $post; 
    $request = parse_url($_SERVER['REQUEST_URI']);
    $path = $request["path"];

    // poista liveen siirron yhteydessä
    // $path = explode('/~uralehti', $path);
	
    // poista liveen siirron yhteydessä
    $length = count($path);
    $result = $path[$length-1];

    $result = rtrim($result,'/');
    $result = ltrim($result,'/');

    $id;

    if ($result != '') {
	    $args = array(
	        'post_type'  => 'any',
	        'meta_key'   => '_old_url',
	        'meta_value'   => array( $result )
	    );
	    $posts = new WP_query( $args );
	    if($posts->have_posts()) {
	        while ( $posts->have_posts() ) {   
	            $posts->the_post();
	            $id = $post->ID;            
	            $url = get_permalink($id);
	            wp_redirect($url , 301 );
	            exit();
	        }
	    }
    }
}
add_action('template_redirect', 'ura_old_url_redirect');

/* Vanhojen URLien käsittelyt END */

remove_all_actions( 'do_feed_rss2' );  
function create_my_custom_feed() {  
    load_template( TEMPLATEPATH . '/feed-rss2.php');  
}  
add_action('do_feed_rss2', 'create_my_custom_feed', 10, 1);
