<?php

function definition_init() {
	register_post_type( 'definition', array(
		'labels'            => array(
			'name'                => __( 'Glossary', 'rchn-glossary' ),
			'singular_name'       => __( 'Definition', 'rchn-glossary' ),
			'all_items'           => __( 'All Definitions', 'rchn-glossary' ),
			'new_item'            => __( 'New definition', 'rchn-glossary' ),
			'add_new'             => __( 'Add New', 'rchn-glossary' ),
			'add_new_item'        => __( 'Add New definition', 'rchn-glossary' ),
			'edit_item'           => __( 'Edit definition', 'rchn-glossary' ),
			'view_item'           => __( 'View definition', 'rchn-glossary' ),
			'search_items'        => __( 'Search glossary', 'rchn-glossary' ),
			'not_found'           => __( 'No definitions found', 'rchn-glossary' ),
			'not_found_in_trash'  => __( 'No definitions found in trash', 'rchn-glossary' ),
			'parent_item_colon'   => __( 'Parent definition', 'rchn-glossary' ),
			'menu_name'           => __( 'Glossary', 'rchn-glossary' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor' ),
		'has_archive'       => true,
		'rewrite'           => array( 'slug' => 'glossary' ),
		'query_var'         => true,
		'menu_icon'         => 'dashicons-book-alt',
	) );

}
add_action( 'init', 'definition_init' );

function definition_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['definition'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Definition updated. <a target="_blank" href="%s">View definition</a>', 'rchn-glossary'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'rchn-glossary'),
		3 => __('Custom field deleted.', 'rchn-glossary'),
		4 => __('Definition updated.', 'rchn-glossary'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Definition restored to revision from %s', 'rchn-glossary'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Definition published. <a href="%s">View definition</a>', 'rchn-glossary'), esc_url( $permalink ) ),
		7 => __('Definition saved.', 'rchn-glossary'),
		8 => sprintf( __('Definition submitted. <a target="_blank" href="%s">Preview definition</a>', 'rchn-glossary'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Definition scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview definition</a>', 'rchn-glossary'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Definition draft updated. <a target="_blank" href="%s">Preview definition</a>', 'rchn-glossary'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'definition_updated_messages' );
