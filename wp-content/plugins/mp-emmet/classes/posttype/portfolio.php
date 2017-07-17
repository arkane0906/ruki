<?php
add_action( 'init', 'portfolio_register' );

register_activation_hook( __FILE__, 'portfolio_register' );

function portfolio_register() {
	mp_emmet_portfolio_categories_register();
	mp_emmet_portfolio_tags_register();
	flush_rewrite_rules( true );
	$args = array(
		'label'           => __( 'Portfolio', 'mp-emmet' ),
		'singular_label'  => __( 'Project', 'mp-emmet' ),
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'rewrite'         => true,
		'taxonomies'      => array( 'portfolio_category' ),
		'supports'        => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'portfolio', $args );
}

function mp_emmet_portfolio_categories_register() {
	$mp_emmet_labels_cat = array(
		'name'                       => _x( 'Categories', 'taxonomy general name', 'mp-emmet' ),
		'singular_name'              => _x( 'Category', 'taxonomy singular name', 'mp-emmet' ),
		'search_items'               => __( 'Search Categories', 'mp-emmet' ),
		'popular_items'              => __( 'Popular Categories', 'mp-emmet' ),
		'all_items'                  => __( 'All Categories', 'mp-emmet' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Category', 'mp-emmet' ),
		'update_item'                => __( 'Update Category', 'mp-emmet' ),
		'add_new_item'               => __( 'Add New Category', 'mp-emmet' ),
		'new_item_name'              => __( 'New Category Name', 'mp-emmet' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'mp-emmet' ),
		'add_or_remove_items'        => __( 'Add or remove categories', 'mp-emmet' ),
		'choose_from_most_used'      => __( 'Choose from the most used categories', 'mp-emmet' ),
		'not_found'                  => __( 'No categories found.', 'mp-emmet' ),
		'menu_name'                  => __( 'Categories', 'mp-emmet' ),
	);

	$mp_emmet_args_cat = array(
		'hierarchical'          => false,
		'labels'                => $mp_emmet_labels_cat,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => true,
	);

	register_taxonomy( 'portfolio_category', 'portfolio', $mp_emmet_args_cat );
}

function mp_emmet_portfolio_tags_register() {
	$mp_emmet_labels_tag = array(
		'name'                       => _x( 'Tags', 'taxonomy general name', 'mp-emmet' ),
		'singular_name'              => _x( 'Tag', 'taxonomy singular name', 'mp-emmet' ),
		'search_items'               => __( 'Search Tags', 'mp-emmet' ),
		'popular_items'              => __( 'Popular Tags', 'mp-emmet' ),
		'all_items'                  => __( 'All Tags', 'mp-emmet' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Tag', 'mp-emmet' ),
		'update_item'                => __( 'Update Tag', 'mp-emmet' ),
		'add_new_item'               => __( 'Add New Tag', 'mp-emmet' ),
		'new_item_name'              => __( 'New Tag Name', 'mp-emmet' ),
		'separate_items_with_commas' => __( 'Separate tags with commas', 'mp-emmet' ),
		'add_or_remove_items'        => __( 'Add or remove tags', 'mp-emmet' ),
		'choose_from_most_used'      => __( 'Choose from the most used tags', 'mp-emmet' ),
		'not_found'                  => __( 'No tags found.', 'mp-emmet' ),
		'menu_name'                  => __( 'Tags', 'mp-emmet' ),
	);

	$mp_emmet_args_tag = array(
		'hierarchical'          => false,
		'labels'                => $mp_emmet_labels_tag,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => true,
	);

	register_taxonomy( 'portfolio_tag', 'portfolio', $mp_emmet_args_tag );
}