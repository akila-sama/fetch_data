<?php
/*
* Plugin Name: My plugin tasks
* Description: This is a testing plugin. This plugin is my first plugin.
* Author: akila
* Version: 1.0
*/




/**Custom Post Type: Implement a plugin that registers a custom
post type, such as "Portfolio" or "Testimonials". Add some custom
fields to this post type, like "Client Name" and "Project URL".**/


// Register Custom Post Type
function custom_portfolio_post_type() {

	$labels = array(
		'name'                  => _x( 'Portfolio', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Portfolio Item', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Portfolio', 'text_domain' ),
		'name_admin_bar'        => __( 'Portfolio', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args   = array(
		'label'               => __( 'Portfolio Item', 'text_domain' ),
		'description'         => __( 'Portfolio items', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-portfolio',
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'portfolio', $args );
}
add_action( 'init', 'custom_portfolio_post_type', 0 );

// Add custom fields to the Portfolio post type
function add_custom_fields() {
	add_meta_box(
		'portfolio_fields',
		'Portfolio Item Details',
		'render_portfolio_fields',
		'portfolio',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'add_custom_fields' );

// Render custom fields
function render_portfolio_fields( $post ) {
	$client_name = get_post_meta( $post->ID, 'client_name', true );
	$project_url = get_post_meta( $post->ID, 'project_url', true );
	?>
	<label for="client_name">Client Name:</label>
	<input type="text" id="client_name" name="client_name" value="<?php echo esc_attr( $client_name ); ?>"><br><br>

	<label for="project_url">Project URL:</label>
	<input type="text" id="project_url" name="project_url" value="<?php echo esc_attr( $project_url ); ?>"><br><br>
	<?php
	// Generate nonce field
	wp_nonce_field( 'save_portfolio_fields', 'portfolio_fields_nonce' );
}

// Save custom fields data
function save_custom_fields( $post_id ) {
	// Verify nonce
	if ( ! isset( $_POST['my_custom_nonce'] ) || ! wp_verify_nonce( $_POST['my_custom_nonce'], 'my_action' ) ) {
		return;
	}

	if ( array_key_exists( 'client_name', $_POST ) ) {
		update_post_meta(
			$post_id,
			'client_name',
			sanitize_text_field( $_POST['client_name'] )
		);
	}

	if ( array_key_exists( 'project_url', $_POST ) ) {
		update_post_meta(
			$post_id,
			'project_url',
			sanitize_text_field( $_POST['project_url'] )
		);
	}
}
add_action( 'save_post', 'save_custom_fields' );

/**Shortcode Extension: Extend the functionality of a shortcode.
For example, create a shortcode that displays a list of recent
posts with a specific category.  **/

function recent_posts_by_category_shortcode( $atts ) {
	// Extract shortcode attributes
	$atts = shortcode_atts(
		array(
			'category' => '', // default category
			'count'    => 5,     // default number of posts to display
		),
		$atts,
		'recent_posts_by_category'
	);

	// Query recent posts with the specified category
	$query_args  = array(
		'posts_per_page' => $atts['count'],
		'category_name'  => $atts['category'],
	);
	$posts_query = new WP_Query( $query_args );

	// Output the list of recent posts
	$output = '<ul>';
	if ( $posts_query->have_posts() ) {
		while ( $posts_query->have_posts() ) {
			$posts_query->the_post();
			$output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
		}
	} else {
			$output .= '<li>No posts found</li>';
	}
	$output .= '</ul>';

	// Restore global post data
	wp_reset_postdata();

	return $output;
}
add_shortcode( 'recent_posts_by_category', 'recent_posts_by_category_shortcode' );
