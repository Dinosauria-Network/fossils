<?php
/**
* The template for displaying the footer.
*
* Contains the closing of the id=main div and all content after
*
* @package First Response
* @since First Response 1.0
*/
?>

			</div><!-- #main .site-main -->

			<footer id="footer" class="site-footer" role="contentinfo">
				<div id="colophon" class="clearfix">
					<?php /* A sidebar in the footer? Yep. You can can customize your footer with four columns of widgets. */
						get_sidebar( 'footer' );?>
				</div><!-- #colophon -->

				<div class="feeds">
					<span class="sep">Follow us:</span>
					<a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS', 'firstresponse'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>', 'firstresponse'); ?></a>
					<span class="sep">|</span> 
					<a href="<?php bloginfo('atom_url'); ?>" title="<?php _e('Syndicate this site using Atom', 'firstresponse'); ?>"><?php _e('Atom', 'firstresponse'); ?></a>
				</div>

				<p class="site-info">
					<?php do_action( 'firstresponse_credits' ); ?>
					<?php printf( __( 'Design by %1$s.', 'firstresponse' ), '<a href="http://pixelasticity.com/" rel="designer">A. Bell</a>' ); ?>
				</p><!-- .site-info -->

				<p class="copyright">
					<?php the_date( 'Y', '&copy; <time datetime="2010-02-08">2010</time>&ndash;' ); ?> <?php bloginfo('name'); ?>
				</p><!-- .copyright -->

    			<a id="going-up" title="<?php _e( 'back to top', 'firstresponse' ) ?>" href="#masthead"><?php _e( 'Top', 'firstresponse' ) ?></a>

			</footer><!-- #footer .site-footer -->
		</div><!-- #inner-wrap -->
	</div><!-- #page .hfeed .site -->

	<?php wp_footer(); ?>

	</body>
</html>
