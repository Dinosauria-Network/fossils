    <?php
    /**
     * The Header for our theme.
     *
     * Displays all of the <head> section and everything up till <div id="main">
     *
     * @package First Response
     * @since First Response 1.0
     */
    ?>
    <!DOCTYPE html>
     
    <!--[if IE 8]>
    <html id="ie8" <?php language_attributes(); ?>>
    <![endif]-->
    <!--[if !(IE 8) ]><!-->
    <html <?php language_attributes(); ?>>
    <!--<![endif]-->
     
    <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0" />
    <title>
    <?php
    /*
     * Print the <title> tag based on what is being viewed.
     */
    global $page, $paged;
    wp_title( '|', true, 'right' );
     
    // Add the blog name.
    bloginfo( 'name' );
     
    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
    echo " | $site_description";
     
    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
    echo ' | ' . sprintf( __( 'Page %s', 'firstresponse' ), max( $paged, $page ) );
    ?>
    </title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
     
    </head>
    <?php flush(); ?>
     
    <body <?php body_class(); ?>>
    <div id="page" class="hfeed site">
    <div id="inner-wrap">
    <header id="masthead" class="site-header" role="banner">
      <div class="hgroup">
        <h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
          <?php bloginfo( 'name' ); ?>
          </a></h1>
        <h2 class="site-description">
          <?php bloginfo( 'description' ); ?>
        </h2>
      </div>
      <a class="nav-btn" id="nav-open-btn" href="#nav">&sect; Sections</a> </header>
    <!-- #masthead .site-header -->
     
    <nav role="navigation" id="nav" class="site-navigation main-navigation">
      <h2 class="assistive-text">
        <?php _e( 'Menu', 'firstresponse' ); ?>
      </h2>
      <div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'response' ); ?>">
        <?php _e( 'Skip to content', 'firstresponse' ); ?>
        </a></div>
      <div id="block">
        <?php get_search_form( $echo ); ?>
        <h3 class="widget-title">
          <?php _e( '&sect; Sections', 'firstresponse' ); ?>
        </h3>
        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        <a class="close-btn" id="nav-close-btn" href="#masthead">Return to Content</a> </div>
    </nav>
    <!-- .site-navigation .main-navigation -->
     
    <div id="main" class="site-main">
