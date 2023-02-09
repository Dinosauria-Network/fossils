<?php
    /**
     * Fossils and definitions
     *
     * @package Fossils
     * @since Fossils 1.0
     */
    /**
     * Set the content width based on the theme's design and stylesheet.
     *
     * @since Fossils 1.0
     */
     
    if (!isset($content_width)) $content_width = 662; /* pixels */
     
    if (!function_exists('firstresponse_setup')):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which runs
     * before the init hook. The init hook is too late for some features, such as indicating
     * support post thumbnails.
     *
     * @since First Response 1.0
     */
    function firstresponse_setup()
    {
    /**
     * Custom template tags for this theme.
     */
    require (get_template_directory() . '/inc/template-tags.php');
     
    /**
     * Custom functions that act independently of the theme templates
     */
    require (get_template_directory() . '/inc/tweaks.php');
     
    /**
     * Make theme available for translation
     * Translations can be filed in the /languages/ directory
     * If you're building a theme based on First Response, use a find and replace
     * to change 'firstresponse' to the name of your theme in all the template files
     */
    load_theme_textdomain('firstresponse', get_template_directory() . '/languages');
    /**
     * Add default posts and comments RSS feed links to head
     */
    add_theme_support('automatic-feed-links');
    /**
     * Enable support for the Aside Post Format
     */
    add_theme_support('post-formats', array(
    'aside'
    ));
    /**
     * This theme uses post thumbnails
     */
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(150, 150, true);
    /**
     * This theme uses wp_nav_menu() in one location.
     */
    register_nav_menus(array(
    'primary' => __('Primary Menu', 'firstresponse') ,
    ));
    }
     
    endif; // firstresponse_setup
    add_action('after_setup_theme', 'firstresponse_setup');
    /*
    * Custom image sizes for responsivity.
    *
    * @since Fossils 1.5
    */
     
    if (function_exists('add_image_size')) {
        add_image_size('resp-large', 768, 9999);
        add_image_size('resp-medium', 480, 9999);
        add_image_size('resp-small', 233, 233, true);
    }
     
    /**
     * Enqueue scripts and styles
     */
     
    function firstresponse_scripts()
    {
    wp_enqueue_style('style', get_stylesheet_uri());
    if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
    }
     
    wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', array(
    'jquery'
    ) , true);
    wp_enqueue_script('nav_open', get_template_directory_uri() . '/js/main.js', array(
    'jquery'
    ) , '20120206', true);
    wp_enqueue_script('picturefill', get_template_directory_uri() . '/js/picturefill.js', true, true);
    wp_enqueue_script('favicons', get_template_directory_uri() . '/js/favicons.js', true, true);
    }
     
    add_action('wp_enqueue_scripts', 'firstresponse_scripts');
    /**
     * Register widgetized area and update sidebar with default widgets
     *
     * @since First Response 1.0
     */
     
    function is_sidebar_active($index = 2)
    {
    $sidebars = wp_get_sidebars_widgets();
    $key = (string)'sidebar-' . $index;
    return (isset($sidebars[$key]));
    }
     
    add_filter('post_class', 'wps_first_post_class');
     
    function wps_first_post_class($classes)
    {
    global $wp_query;
    if (is_home() || is_archive() || is_search() and 0 == $wp_query->current_post) $classes[] = 'first';
    return $classes;
    }
     
    function firstresponse_widgets_init()
    {
    register_sidebar(array(
    'name' => __('Primary Widget Area', 'firstresponse') ,
    'id' => 'sidebar-1',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget' => '</section>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ));
    register_sidebar(array(
    'name' => __('Secondary Widget Area', 'firstresponse') ,
    'id' => 'sidebar-2',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget' => '</section>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ));
     
    // Area 3, located in the footer. Empty by default.
     
    register_sidebar(array(
    'name' => __('First Footer Widget Area', 'firstresponse') ,
    'id' => 'first-footer-widget-area',
    'description' => __('The first footer widget area', 'firstresponse') ,
    'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</section>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ));
     
    // Area 4, located in the footer. Empty by default.
     
    register_sidebar(array(
    'name' => __('Second Footer Widget Area', 'firstresponse') ,
    'id' => 'second-footer-widget-area',
    'description' => __('The second footer widget area', 'firstresponse') ,
    'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</section>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ));
     
    // Area 5, located in the footer. Empty by default.
     
    register_sidebar(array(
    'name' => __('Third Footer Widget Area', 'firstresponse') ,
    'id' => 'third-footer-widget-area',
    'description' => __('The third footer widget area', 'firstresponse') ,
    'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</section>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ));
     
    // Area 6, located in the footer. Empty by default.
     
    register_sidebar(array(
    'name' => __('Fourth Footer Widget Area', 'firstresponse') ,
    'id' => 'fourth-footer-widget-area',
    'description' => __('The fourth footer widget area', 'firstresponse') ,
    'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</section>',
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
    ));
    }
     
    add_action('widgets_init', 'firstresponse_widgets_init');
     
    if (!function_exists('firstresponse_posted_on')):
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     * Create your own firstresponse_posted_on to override in a child theme
     *
     * @since Fossils 1.0
     */
    function firstresponse_posted_on() {
        printf(__('<div class="author vcard"><a class="url fn n" href="%6$s" title="%7$s" rel="author">%8$s</a></span><span class="sep">&bull;</div><span class="date"><span class="extra">Posted </span><a href="%1$s" title="%2$s at %3$s" rel="bookmark"><time class="entry-date" datetime="%4$s" pubdate>%5$s</time></a></span>', 'firstresponse') , esc_url(get_permalink()) , esc_attr(get_the_date()) , esc_attr(get_the_time()) , esc_attr(get_the_date('c')) , esc_html(firstresponse_time_ago()) , esc_url(get_author_posts_url(get_the_author_meta('ID'))) , esc_attr(sprintf(__('View all posts by %s', 'firstresponse') , get_the_author())) , get_the_author());
    }
     
    endif;
     
    function firstresponse_time_ago() {
        global $post;
        $date = get_post_time('G', true, $post);
        /**
         * Where you see 'firstresponse' below, you'd
         * want to replace those with whatever term
         * you're using in your theme to provide
         * support for localization.
         */
        
        // Array of time period chunks
        
        $chunks = array(
            array(
                60 * 60 * 24 * 365,
                __('year', 'firstresponse') ,
                __('years', 'firstresponse')
            ),
            array(
                60 * 60 * 24 * 30,
                __('month', 'firstresponse'),
                __('months', 'firstresponse')
            ),
            array(
                60 * 60 * 24 * 7,
                __('week', 'firstresponse'),
                __('weeks', 'firstresponse')
            ),
            array(
                60 * 60 * 24,
                __('day', 'firstresponse'),
                __('days', 'firstresponse')
            ),
            array(
                60 * 60,
                __('hour', 'firstresponse'),
                __('hours', 'firstresponse')
            ),
            array(
                60,
                __('minute', 'firstresponse'),
                __('minutes', 'firstresponse')
            ),
            array(
                1,
                __('second', 'firstresponse'),
                __('seconds', 'firstresponse')
            )
        );
        if (!is_numeric($date)) {
            $time_chunks = explode(':', str_replace(' ', ':', $date));
            $date_chunks = explode('-', str_replace(' ', '-', $date));
            if ($time_chunks[1] ?? null) {
                $date = gmmktime(
                    (int)$time_chunks[1],
                    (int)$time_chunks[2],
                    (int)$time_chunks[3],
                    (int)$date_chunks[1],
                    (int)$date_chunks[2],
                    (int)$date_chunks[0]
                );
            }
        }
        
        $current_time = current_time('mysql', $gmt = 0);
        $newer_date = time();
        
        // Difference in seconds
        
        $since = $newer_date - $date;
        
        // Something went wrong with date calculation and we ended up with a negative date.
        
        if (0 > $since) return __('sometime', 'firstresponse');
        /**
         * We only want to output one chunks of time here, eg:
         * x years
         * xx months
         * so there's only one bit of calculation below:
         */
        
        // Step one: the first chunk
        
        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            
            // Finding the biggest chunk (if the chunk fits, break)
            
            if (($count = floor($since / $seconds)) != 0) break;
        }
        
        // Set output var
        
        $output = (1 == $count) ? '1 ' . $chunks[$i][1] : $count . ' ' . $chunks[$i][2];
        if (!(int)trim($output)) {
            $output = '0 ' . __('seconds', 'firstresponse');
        }
        
        $output.= __(' ago', 'firstresponse');
        return $output;
    }
     
    // Filter our firstresponse_time_ago() function into WP's the_time() functionfunction wp_change_target($content){
     
    return preg_replace_callback('/<a[^>]+/', 'wp_target_callback', firstresponse_time_ago());
     
    function wp_target_callback($matches) {
        $link = $matches[0];
        $mu_url = get_bloginfo('url');
        if (strpos($link, 'target') === false) {
            $link = preg_replace("%(href=\S(?!$mu_url))%i", 'target="_blank" $1', $link);
        }
        elseif (preg_match("%href=\S(?!$mu_url)%i", $link)) {
            $link = preg_replace('/target=S(?!_blank)\S*/i', 'target="_blank"', $link);
        }
        
        return $link;
    }
     
    add_filter('the_permalink', 'wp_change_target');
