<?php
/**
 * @package First Response
 * @since First Response 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( is_home() || is_archive() || is_search() ) : // Only display Excerpts for the home page, archives and search ?>
    	<div class="post-image alignleft">
        	<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" >

			<?php
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false );
            if ( $thumb ) {
  			    echo do_shortcode( '[rimg src="' . $thumb[0] . '"]' );
            }
			?>
		</a>
	</div><!-- .post-image -->
    <header class="entry-header">

        <h1 class="summary-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'firstresponse' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        <?php if ( 'post' == get_post_type() ) : ?>
        <div class="entry-meta">
            <?php firstresponse_posted_on(); ?>
        </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->
    <div class="entry-summary">
	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div>
    </div><!-- .entry-summary -->

    <?php else : ?>
    <header class="entry-header">
       <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'firstresponse' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        <?php if ( 'post' == get_post_type() ) : ?>
            <?php firstresponse_posted_by(); ?>
        <?php endif; ?>
        <div class="entry-meta">
            <?php echo time_ago(); ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->
    <div class="entry-content">
        <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'firstresponse' ) ); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'firstresponse' ), 'after' => '</div>' ) ); ?>
    </div><!-- .entry-content -->
    <?php endif; ?>

    <?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
        <footer class="entry-meta">
            <?php
                /* translators: used between list items, there is a space after the comma */
                $categories_list = get_the_category_list( __( ', ', 'firstresponse' ) );
                if ( $categories_list && firstresponse_categorized_blog() ) :
            ?>
            <span class="cat-links">
                <?php printf( __( '%1$s', 'firstresponse' ), $categories_list ); ?>
            </span>
            <?php endif; // End if categories ?>

            <?php
                /* translators: used between list items, there is a space after the comma */
                $tags_list = get_the_tag_list( '', __( ', ', 'firstresponse' ) );
                if ( $tags_list ) :
            ?>
            <span class="sep"> | </span>
            <span class="tag-links">
                <?php printf( __( '%1$s', 'firstresponse' ), $tags_list ); ?>
            </span>
            <?php endif; // End if $tags_list ?>
        </footer><!-- .entry-meta -->
    <?php endif; // End if 'post' == get_post_type() ?>

</article><!-- #post-<?php the_ID(); ?> -->