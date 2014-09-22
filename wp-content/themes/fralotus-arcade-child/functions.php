<?php

//require_once(__DIR__.'/../arcade-basic/functions.php');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Remove the default Thematic blogtitle function
function remove_arcade_actions() {
    remove_action('wp_nav_menu_args','bavotasan_nav_menu_args');
}
// Call 'remove_thematic_actions' (above) during WP initialization
add_action('init','remove_arcade_actions');

/**
 * Set our new walker only if a menu is assigned and a child theme hasn't modified it to one level deep
 *
 * This function is attached to the 'wp_nav_menu_args' filter hook.
 *
 * @author Kirk Wight <http://kwight.ca/adding-a-sub-menu-indicator-to-parent-menu-items/>
 * @since 1.0.0
 */
function swc_nav_menu_args( $args ) {
    if ( 1 !== $args[ 'depth' ] && has_nav_menu( 'primary' ) && $args['menu']=== '' )
        $args[ 'walker' ] = new Bavotasan_Page_Navigation_Walker;

    return $args;
}

// Add our custom function to the 'thematic_header' phase
add_filter( 'wp_nav_menu_args', 'swc_nav_menu_args' );