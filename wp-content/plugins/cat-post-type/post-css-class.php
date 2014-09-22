<?php
/*
Plugin Name: Post Css Class
Plugin URI: http://wordpress.org/extend/plugins/cat-post-type/
Description: In complement of cat-post-type, add the possibility to return the class "post" in function post_class to your custom post type. Some wordpress themes need this class for a correct dipslay of your custom post.
Author: Michel Bobillier aka Athos99
Version: 1.0.1
Author URI: http://php.athos99.com
*/

function cat_post_type_post_class(   $classes, $class, $post_id ) {
    if ( ($post_type = get_post_type( )) != false) {
        $post_type_object = get_post_type_object($post_type);
        if ( !$post_type_object->_builtin && $post_type_object->capability_type=='post' && !in_array('post', $classes)) {
            $classes[] = 'post';
        }
    }
    return $classes;
}


add_filter( 'post_class', 'cat_post_type_post_class', 10, 3 );



