<?php
define( 'HOME_PAGE_ID', get_option( 'page_on_front' ) );
define( 'BLOG_ID', get_option( 'page_for_posts' ) );
define( 'POSTS_PER_PAGE', get_option( 'posts_per_page' ) );
/* INCLUD CUSTOM FUNCTIONS
   ========================================================================== */
// Recommended plugins installer
//require_once 'include/plugins/init.php';
// Custom functionality
require_once 'include/core.php';
//require_once 'include/acf/acf-settings.php';
//require_once 'include/woocommerce.php';
 require_once('include/cpt.php');

//update image  size
// add_image_size( '2048x2048_cropped', '2048', '2048', true );

function set_default_image_sizes() {
	update_option( 'thumbnail_size_w', 400 );
	update_option( 'thumbnail_size_h', 400 );
	update_option( 'medium_size_w', 800 );
	update_option( 'medium_size_h', 800 );
	update_option( 'large_size_w', 2048 );
	update_option( 'large_size_h', 2048 );
}

add_action( 'after_switch_theme', 'set_default_image_sizes' );


/* REGISTER MENUS
   ========================================================================== */
register_nav_menus( array(
	'main_menu'   => 'Main navigation',
	'second_menu' => 'Second navigation',
	'foot_menu'   => 'Footer navigation'
) );

function wp_get_attachment( $attachment_id ) {

	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}


add_filter('wp_check_filetype_and_ext', 'ignore_upload_ext', 10, 4);
function ignore_upload_ext($checked, $file, $filename, $mimes)
{
    //we only need to worry if WP failed the first pass
    if (!$checked['type']) {
        //rebuild the type info
        $wp_filetype = wp_check_filetype($filename, $mimes);
        $ext = $wp_filetype['ext'];
        $type = $wp_filetype['type'];
        $proper_filename = $filename;
        //preserve failure for non-svg images
        if ($type && 0 === strpos($type, 'image/') && $ext !== 'svg') {
            $ext = $type = false;
        }
        //everything else gets an OK, so e.g. we've disabled the error-prone finfo-related checks WP just went through. whether or not the upload will be allowed depends on the <code>upload_mimes</code>, etc.
        $checked = compact('ext', 'type', 'proper_filename');
    }
    return $checked;
}

/**
 * Add file support for media
 *
 */
function svg_myme_types($mime_types)
{
    $mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
    return $mime_types;
}

add_filter('upload_mimes', 'svg_myme_types', 1, 1);

//add_filter('acf/settings/show_admin', '__return_false');
function imgSvg($term_img)
{
    $url = $term_img;
    $arrContextOptions = array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
        ),
    );
    $response = file_get_contents($url, false, stream_context_create($arrContextOptions));
    echo $response;
}

function my_acf_admin_head() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.layout').not('.clones .layout').addClass('-collapsed');
        });
    </script>
    <?php
}
add_action('acf/input/admin_head', 'my_acf_admin_head');

// check function exists
if( function_exists('acf_register_block') ) {

    // register a testimonial block
    acf_register_block(array(
        'name'              => 'test', // Name/key block
        'title'             => __('Test WPWP'),
        'description'       => __('A custom test block.'),
        'render_callback'   => 'my_acf_block_render_callback',
        'render_template'   => 'my_acf_block_render_callback',
        'enqueue_assets'   => 'my_acf_block_render_assets',
        'category'          => 'formatting',
        'icon'              => 'admin-comments', // icon in Gutenberg
        'keywords'          => array( 'test', 'test2' ),
    ));

    // register home first block
    acf_register_block(array(
        'name'              => 'information-wpwp', // Name/key block
        'title'             => __('Information Block'),
        'description'       => __('Information about of war'),
        'render_callback'   => 'my_acf_block_render_callback',
        'render_template'   => 'my_acf_block_render_callback',
        'enqueue_assets'   => 'my_acf_block_render_assets',
        'category'          => 'formatting',
        'icon'              => 'chart-bar', // icon in Gutenberg
        'keywords'          => array( 'war', 'test2', 'test2' ),
    ));

}
// add meta-box for cpt jobs
function add_jobs_meta_boxes() {
    add_meta_box(
        'job_details',
        'Job Details',
        'render_job_details_meta_box',
        'job',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'add_jobs_meta_boxes' );

function render_job_details_meta_box($post) {
    $job_title = get_post_meta($post->ID, 'job_title', true);
    $salary = get_post_meta($post->ID, 'salary', true);
    $location = get_post_meta($post->ID, 'location', true);

    ?>
    <p>
        <label for="job_title">Job Title:</label><br>
        <input type="text" name="job_title" id="job_title" value="<?php echo esc_attr($job_title); ?>" class="widefat">
    </p>
    <p>
        <label for="salary">Salary:</label><br>
        <input type="text" name="salary" id="salary" value="<?php echo esc_attr($salary); ?>" class="widefat">
    </p>
    <p>
        <label for="location">Location:</label><br>
        <input type="text" name="location" id="location" value="<?php echo esc_attr($location); ?>" class="widefat">
    </p>
    <?php
}

function save_job_details_meta_box($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['job_title'])) {
        update_post_meta($post_id, 'job_title', sanitize_text_field($_POST['job_title']));
    }

    if (isset($_POST['salary'])) {
        update_post_meta($post_id, 'salary', sanitize_text_field($_POST['salary']));
    }

    if (isset($_POST['location'])) {
        update_post_meta($post_id, 'location', sanitize_text_field($_POST['location']));
    }
}
add_action('save_post', 'save_job_details_meta_box');
