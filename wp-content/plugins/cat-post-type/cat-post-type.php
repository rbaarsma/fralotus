<?php
/*
Plugin Name: Cat Post Type
Plugin URI: http://wordpress.org/extend/plugins/cat-post-type/
Description: Add the possibility display custom post by selecting tags and categories.
Author: Michel Bobillier aka Athos99
Version: 1.0.1
Author URI: http://php.athos99.com
*/

function catposttype(  $q )
{
    if ( $q->is_category && empty($q->query_vars['post_type'])) {
        $q->query_vars['post_type'] = 'any';
    }
       if ( $q->is_tag && empty($q->query_vars['post_type'])) {
        $q->query_vars['post_type'] = 'any';
    }

}
add_action( 'pre_get_posts', 'catposttype' );


