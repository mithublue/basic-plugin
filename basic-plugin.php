<?php
/**
 * Plugin Name: Basic Plugin
 * Description: This plugin  is to demonstrate the use of plugin api, oop and basic interaction of database.
 * Plugin URI:
 * Version:     1.0
 * Author:      Md. Abdul Quayium
 * Author URI:
 * Text Domain: wpbp
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

final class WPBP_Init {

    /**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.0.0
     *
     * @access public
     * @static
     *
     * @return WPBP_Init An instance of the class.
     */
    public static function instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    public function __construct() {
        //This demonstrates wordpress api
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }

    /**
     * This will add menu to admin panel
     */
    public function admin_menu() {
        add_menu_page( __( 'Test Page', 'wpbp'), __( 'Test Page', 'wpbp'), 'administrator', 'wpbp-test-page', array( $this, 'build_menu_page' ) );
    }


    /**
     * This will build menu page
     */
    public function build_menu_page() {
        //Basic interaction with database
        $posts = get_posts( array(
                'post_type' => 'post',
            'post_status' => 'publish'
        ) );

        if( !empty( $posts ) ) {
            foreach (  $posts as $k => $each ) {
                ?>
                <div style="border: 1px solid #000000; -webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px; padding: 10px; margin-bottom: 5px;">
                    <h4><?php echo $each->post_title; ?></h4>
                    <div>
                        <?php echo $each->post_excerpt; ?>
                    </div>
                </div>
                <?php
            }
        } else { ?>
            <h3><?php _e( 'No post at this moment', 'wpbp' ); ?></h3>
        <?php
        }
    }
}

WPBP_Init::instance();