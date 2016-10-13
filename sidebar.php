<?php
/**
* The Sidebar containing the main widget areas.
*
* @package First Response
* @since First Response 1.0
*/
?>

<aside id="secondary" class="widget-area" role="complementary">
    <?php do_action( 'before_sidebar' ); ?>
    <?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

        <section id="search" class="widget widget_search">
            <?php get_search_form(); ?>
        </section>

        <section id="archives" class="widget">
            <h3 class="widget-title"><?php _e( 'Archives', 'firstresponse' ); ?></h3>
            <ul>
                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
            </ul>
        </section>

        <section id="meta" class="widget">
            <h3 class="widget-title"><?php _e( 'Meta', 'firstresponse' ); ?></h3>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </section>

    <?php endif; // end sidebar widget area ?>
</aside><!-- #secondary .widget-area -->

<?php if ( function_exists( 'dynamic_sidebar' ) && ! is_sidebar_active(2) )
		return;
	// If we get this far, we have widgets. Let do this.
?>

<?php if ( is_sidebar_active(2) ) : ?>
	<aside id="tertiary" class="widget-area" role="supplementary">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</aside><!-- #tertiary .widget-area -->
<?php endif; ?>