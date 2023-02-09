<?php


/**


 * Custom template tags for this theme.


 *


 * @package First Response


 * @since First Response 1.0


 */


 if ( ! function_exists( 'firstresponse_posted_on' ) ) :


/**


 * Prints HTML with meta information for the current post-date/time and author.


 *


 * @since First Response 1.0


 */


function firstresponse_posted_on() {


    printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><br>', 'firstresponse' ),


        esc_url( get_permalink() ),


        esc_attr( get_the_time() ),


        esc_attr( get_the_date( 'c' ) ),


        esc_html( get_the_date() )


    );


}





function firstresponse_posted_by() {


    printf( __( '<span class="byline"> by <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span></span>', 'firstresponse' ),


        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),


        esc_attr( sprintf( __( 'View all posts by %s', 'firstresponse' ), get_the_author() ) ),


        esc_html( get_the_author() )


    );


}


endif;


 


/**


 * Returns true if a blog has more than 1 category


 *


 * @since First Response 1.0


 */


function firstresponse_categorized_blog() {


    if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {


        // Create an array of all the categories that are attached to posts


        $all_the_cool_cats = get_categories( array(


            'hide_empty' => 1,


        ) );


 


        // Count the number of categories that are attached to the posts


        $all_the_cool_cats = count( $all_the_cool_cats );


 


        set_transient( 'all_the_cool_cats', $all_the_cool_cats );


    }


 


    if ( '1' != $all_the_cool_cats ) {


        // This blog has more than 1 category so firstresponse_categorized_blog should return true


        return true;


    } else {


        // This blog has only 1 category so firstresponse_categorized_blog should return false


        return false;


    }


}


 


/**


 * Flush out the transients used in firstresponse_categorized_blog


 *


 * @since First Response 1.0


 */


function firstresponse_category_transient_flusher() {


    // Like, beat it. Dig?


    delete_transient( 'all_the_cool_cats' );


}


add_action( 'edit_category', 'firstresponse_category_transient_flusher' );


add_action( 'save_post', 'firstresponse_category_transient_flusher' );





if ( ! function_exists( 'firstresponse_content_nav' ) ):





/**


 * Add an "odd" class to odd posts and an "even" class to even posts


 *


 * @since First Response 1.0


 */


function oddeven_post_class ( $classes ) {


   global $current_class;


   $classes[] = $current_class;


   $current_class = ($current_class == 'odd') ? 'even' : 'odd';


   return $classes;


}


add_filter ( 'post_class' , 'oddeven_post_class' );


	global $current_class;


	$current_class = 'odd';


add_filter( 'post_class', 'remove_page_function', 20 );


function remove_page_function( $classes ) {


     if( ( $key = array_search( 'page', $classes ) ) !== false )


         unset( $classes[$key] );


     return $classes;


}


/**


 * Display navigation to next/previous pages when applicable


 *


 * @since First Response 1.0


 */


function firstresponse_content_nav( $nav_id ) {


    global $wp_query, $post;


 


    // Don't print empty markup on single pages if there's nowhere to navigate.


    if ( is_single() ) {


        $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );


        $next = get_adjacent_post( false, '', false );


 


        if ( ! $next && ! $previous )


            return;


    }


 


    // Don't print empty markup in archives if there's only one page.


    if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )


        return;


 


    $nav_class = 'site-navigation paging-navigation clearfix';


    if ( is_single() )


        $nav_class = 'site-navigation post-navigation clearfix';


 


    ?>


    <nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">


        <h1 class="assistive-text"><?php _e( 'Post navigation', 'firstresponse' ); ?></h1>


 


    <?php if ( is_single() ) : // navigation links for single posts ?>


 


        <?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'firstresponse' ) . '</span> %title' ); ?>


        <?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'firstresponse' ) . '</span>' ); ?>


 


    <?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>


 


        <?php if ( get_next_posts_link() ) : ?>


        <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'firstresponse' ) ); ?></div>


        <?php endif; ?>


 


        <?php if ( get_previous_posts_link() ) : ?>


        <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'firstresponse' ) ); ?></div>


        <?php endif; ?>


 


    <?php endif; ?>


 


    </nav><!-- #<?php echo $nav_id; ?> -->


    <?php


}


endif; // firstresponse_content_nav





if ( ! function_exists( 'firstresponse_comment' ) ) :


/**


 * Template for comments and pingbacks.


 *


 * Used as a callback by wp_list_comments() for displaying the comments.


 *


 * @since First Response 1.0


 */


function firstresponse_comment( $comment, $args, $depth ) {


    $GLOBALS['comment'] = $comment;


    switch ( $comment->comment_type ) :


        case 'pingback' :


        case 'trackback' :


    ?>


    <li class="post pingback">


        <p><?php _e( 'Pingback:', 'firstresponse' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'firstresponse' ), ' ' ); ?></p>


    <?php


            break;


        default :


    ?>


    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">


        <article id="comment-<?php comment_ID(); ?>" class="comment">


            <footer>


                <div class="comment-author vcard">


                    <?php echo get_avatar( $comment, 60 ); ?>


                    <?php printf( __( '%s', 'firstresponse' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>


                </div><!-- .comment-author .vcard -->


                <?php if ( $comment->comment_approved == '0' ) : ?>


                    <em><?php _e( 'Your comment is awaiting moderation.', 'firstresponse' ); ?></em>


                    <br />


                <?php endif; ?>


 


                <div class="comment-meta commentmetadata">


                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">


                    <?php


                        /* translators: 1: date, 2: time */


                        printf( __( '%1$s at %2$s', 'firstresponse' ), get_comment_date(), get_comment_time() ); ?>


                    </time></a>


                    <?php edit_comment_link( __( '(Edit)', 'firstresponse' ), ' ' );


                    ?>


                </div><!-- .comment-meta .commentmetadata -->


            </footer>


 


            <div class="comment-content"><?php comment_text(); ?></div>


 


            <div class="reply">


                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>


            </div><!-- .reply -->


        </article><!-- #comment-## -->


 


    <?php


            break;


    endswitch;


}

endif; // ends check for firstresponse_comment()


/*
 * Responsive shortcode
 *
 * @since Fossils 1.5
 */

function responsive_image($atts){
  extract( shortcode_atts( array(
    'src' => '',
    'caption' => '',
  ), $atts ) );

  if($src != '') {
    $img_ID = attachment_url_to_postid($src);
    $alt = get_post_meta( $img_ID, '_wp_attachment_image_alt', true );
    $caption = wp_get_attachment_caption( $img_ID );
    $attachment_metadata = wp_get_attachment_metadata( $img_ID );
    $credit = $attachment_metadata['image_meta']['credit'] ? $attachment_metadata['image_meta']['credit'] : $caption;
    $desc = get_post( $img_ID )->post_content;
    $large = wp_get_attachment_image_src( $img_ID, 'resp-large' );
    $medium = wp_get_attachment_image_src( $img_ID, 'resp-medium' );
    $small = wp_get_attachment_image_src( $img_ID, 'resp-small' );
    $thumb = wp_get_attachment_image_src( $img_ID, 'thumbnail' );

    $output = <<<HTML
        <div class="responsive-image">
            <div data-picture data-alt="$alt">
                <div data-src="$thumb[0]"></div>
                <div data-src="$small[0]" data-media="(min-width: 480px)"></div>
                <div data-src="$medium[0]" data-media="(min-width: 640px)"></div>
                <div data-src="$large[0]" data-media="(min-width: 960px)"></div>
                <div data-src="$src" data-media="(min-width: 1280px)"></div>
                <noscript>
                    <img src="$src" alt="$alt">
                </noscript>
            </div>
    HTML;

    if ( $desc || $credit ) $output.= '    <figcaption class="caption">';
    if ( $desc ) $output.= '    <p class="caption-text">Enlarge <span class="sep">/</span> ' . $desc . '</p>';
    if ( $credit ) $output.= '  <p class="caption-credit">' . $credit . '</p>';
    if ( $desc || $caption ) $output.= '    </figcaption>';

    $output.= '</div>';

  } else {
    $output = '';
  }

  return $output;

}


add_shortcode('rimg', 'responsive_image');