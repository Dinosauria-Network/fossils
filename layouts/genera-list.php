<?php
/**
 * Template Name: Genera List Template
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
                <div id="top">
                  <a id="container" href="#listing">
                    <span class="texture"></span>
                    <h2><span class="h">Currently there are over </span><?php echo wp_count_posts('genus')->publish; ?><span class="h"> different species of dinosaurs that have been identified and named.</span></h2>
                  </a>
                </div> 
            <div id="listing">
            <ul>
<?php $cache_key = 'genera-query';
if ( ! $html = get_transient( $cache_key ) ) {
	$genera = new WP_Query( array(
		'post_status'  => 'publish',
		'post_type'    => array( 'genus' ),
		'has_password' => false,
		'meta_key'     => 'genus_authority__date',
		'orderby'      => 'meta_value title',
		'order'        => 'DESC',
		'nopaging'     => true
	) );
	
	ob_start();

if ( $genera->have_posts() ) {
	$species = $genera->get_posts();

	foreach( $species as $post ) {
		$field = get_post_meta( $post->ID, 'period', true );
		$author = get_post_meta( $post->ID, 'genus_authority__author', true );
		$date = get_post_meta( $post->ID, 'genus_authority__date', true );
		$now = new DateTime("now");
		if ($date) {
			$dateFormatted = ( $now->modify('+1 day') >= new DateTime( $date ) ) ? new DateTime( $date ) : DateTime::createFromFormat( 'Y', $date );
		} ?>
				<li class="clearfix">	
					<div class="species-name">
						<?php the_title( '<h3><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h3>' ); ?>
						<div class="era <?php echo $field; ?>"></div>

						<p><?php echo ucwords( $field ); ?></p>
					</div>
					<div class="species-date">
						<?php if (!empty($dateFormatted)) : ?>
						<h4>
							<time datetime="<?php echo $dateFormatted->format(DateTimeInterface::ISO8601); ?>"><?php echo $dateFormatted->format('Y'); ?></time>
						</h4>
						<?php endif; ?>
						<?php if (!empty($author)) : ?>
						<h5>by <?php echo $author; ?></h5>
						<?php endif; ?>
					</div>
				</li>
				<?php // end of the loop.
	}
}
	$html = ob_get_clean();    
    set_transient( $cache_key, $html, 24 * HOUR_IN_SECONDS );
	
	add_action( 'publish_genus',  function ( $ID, $post ) {
		// A function to perform actions when a post is published.
		delete_transient( $cache_key );
	}, 10, 2 );
}
wp_reset_postdata();
				$genera_html = get_transient( $cache_key ); echo $genera_html; ?>

                        </ul>
                    </div>
                </div>
            </div><!-- #content .site-content -->
        </section><!-- #primary .content-area -->

<?php get_footer(); ?>
