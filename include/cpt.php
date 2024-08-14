<?php

// register cpt "Jobs"
function create_jobs_post_type() {
    $labels = array(
        'name'               => 'Jobs',
        'singular_name'      => 'Job',
        'menu_name'          => 'Jobs',
        'name_admin_bar'     => 'Job',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Job',
        'new_item'           => 'New Job',
        'edit_item'          => 'Edit Job',
        'view_item'          => 'View Job',
        'all_items'          => 'All Jobs',
        'search_items'       => 'Search Jobs',
        'not_found'          => 'No jobs found.',
        'not_found_in_trash' => 'No jobs found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'jobs' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );

    register_post_type( 'job', $args );
}
add_action( 'init', 'create_jobs_post_type' );
