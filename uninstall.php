<?php
/**
 *
 * @package    DMSFP_Searching_for_Posts
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Access the database via SQL
global $wpdb;
$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'search_post'" );
$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );
$wpdb->query( "UPDATE `wp_posts` SET `post_content` = REPLACE(`post_content`,  'search_post',  'Routes:') 
WHERE `post_content` LIKE '%search_post%';" );