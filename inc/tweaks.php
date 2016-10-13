<?php


/**


 * Custom functions that act independently of the theme templates


 *


 * @package First Response


 * @since First Response 1.0


 */


 


/**


 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.


 *


 * @since First Response 1.0


 */


function firstresponse_page_menu_args( $args ) {


    $args['show_home'] = true;


    return $args;


}


add_filter( 'wp_page_menu_args', 'firstresponse_page_menu_args' );


 


/**


 * Adds custom classes to the array of body classes.


 *


 * @since First Response 1.0


 */


function firstresponse_body_classes( $classes ) {


    // Adds a class of group-blog to blogs with more than 1 published author


    if ( is_multi_author() ) {


        $classes[] = 'group-blog';


    }


 


    return $classes;


}


add_filter( 'body_class', 'firstresponse_body_classes' );


 


/**


 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages


 *


 * @since First Response 1.0


 */


function firstresponse_enhanced_image_navigation( $url, $id ) {


    if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )


        return $url;


 


    $image = get_post( $id );


    if ( ! empty( $image->post_parent ) && $image->post_parent != $id )


        $url .= '#main';


 


    return $url;


}


add_filter( 'attachment_link', 'firstresponse_enhanced_image_navigation', 10, 2 );





/**


 * Change the default CSS for avatars


 *


 * @since Fossils 1.0


 */


add_filter('get_avatar', 'change_avatar_css');


function change_avatar_css($avatar) {


    return str_replace(' photo', ' alignleft', $avatar);


}





/**


 * Remove WordPress-generated empty tags.


 *


 * @since Fossils 1.0


 */


add_filter( 'the_content', 'clean_post_content' );


function clean_post_content($content) {





    // For individual posts and the index page


    if ( is_single() || is_home() ) {





        // Remove empty tags


        $post_cleaners = array('<p></p>' => '', '<p> </p>' => '', '<p> </p>' => '', '<span></span>' => '', '<span> </span>' => '', '<span> </span>' => '', '<span>' => '', '</span>' => '', '<font>' => '', '</font>' => '');


        $content = strtr($content, $post_cleaners);


    }


    return $content;


}