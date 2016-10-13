<?php


/**


 * The template for displaying search forms in First Response


 *


 * @package First Response


 * @since First Response 1.0


 */


?>


    <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">


        <label for="s" class="assistive-text"><?php _e( 'Search', 'firstresponse' ); ?></label>


        <input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search&hellip;', 'firstresponse' ); ?>" />


        <input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'firstresponse' ); ?>" />


    </form>