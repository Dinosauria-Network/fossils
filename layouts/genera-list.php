<?php
/**
 * Template Name: Genera List Template
 *
 * Description: Fossils has a special post-type called Genera. This template displays them nicely.
 *
 * @package WordPress
 * @subpackage Fossils
 * @since Fossils 1.2
 */

get_template_part('templates/page', 'header'); ?>

<section id="primary" class="content-area one-col">
	<div id="content" class="site-content" role="main">
		<div id="top">
			<a id="container" href="#listing">
				<span class="texture"></span>
				<h2><span class="sr-only">Currently there are over </span><?php echo wp_count_posts('genus')->publish; ?><span class="sr-only"> different species of dinosaurs that have been identified and named.</span></h2>
			</a>
		</div>
		<div id="listing">
			<ul>
<?php $loop = new WP_Query( array( 'post_type' => 'genus', 'posts_per_page' => 1000 ) ); ?>

<?php while ( $loop->have_posts() ) : $loop->the_post(); 
$posts = get_posts(array(
	'meta_key' => 'description-date',
	'orderby' => 'meta_value_num',
	'order' => 'ASC'
));
get_template_part( 'templates/content', 'page' );
if( $posts )
{
	foreach( $posts as $post )
	{
		setup_postdata( $post );
		// ...
	}
	wp_reset_postdata();
} ?>

	<li class="clearfix">	
	    <div class="species-name">
			<?php the_title( '<h3><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h3>' ); ?>
			<div class="era <?php echo get_post_meta($post->ID, 'period', true); ?>"></div>
		
			<p><?php echo ucwords(get_post_meta($post->ID, 'period', true)); ?></p>
	    </div>
	    <div class="species-date">
			<?php $date = DateTime::createFromFormat('Ymd', get_post_meta($post->ID, 'description-date', true)); if(!empty($date)) : ?>
			<h4>
				<time datetime="<?php echo $date->format('Y-m-d'); ?>"><?php echo $date->format('Y'); ?></time>
			</h4>
			<?php endif; ?>
			<h5>by <?php echo get_post_meta($post->ID, 'author', true); ?></h5>
	    </div>
	</li>
<?php endwhile; // end of the loop. ?>
			</ul>
		</div>        
	</div>
</section>