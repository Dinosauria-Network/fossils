<?php


/**


 * Template Name: One Column, No Sidebar Template


 *


 * Description: Fossils loves the no-sidebar look as much as


 * you do. Use this page template to remove the sidebar from any page.


 *


 * @package WordPress


 * @subpackage Fossils


 * @since Fossils 1.0


 */


 


get_header(); ?>


 


        <section id="primary" class="content-area one-col">


            <div id="content" class="site-content" role="main">


 


                <?php while ( have_posts() ) : the_post(); ?>


 


                    <?php get_template_part( 'content', 'page' ); ?>


 


                    <?php comments_template( '', true ); ?>


 


                <?php endwhile; // end of the loop. ?>


 


            </div><!-- #content .site-content -->


        </section><!-- #primary .content-area -->





<?php get_footer(); ?>