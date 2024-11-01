<?php
/**
 * Filmfeed widget
 *
 * PHP version 5
 *
 * @category   WordPress
 * @package    WordPress
 * @subpackage Wp-Filmfeed
 * @author     Sergey Storchay <r8@r8.com.ua>
 * @copyright  2012-2013 Sergey Storchay (email: r8@r8.com.ua)
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL2
 * @link       http://r8.github.com/wp-filmfeed/
 *
 * Plugin Name: WP-Filmfeed
 * Plugin URI: http://r8.github.com/wp-filmfeed/
 * Description: Filmfeed widget
 * Version: 1.0.3
 * License: GPL2
 * Author: Sergey Storchay
 * Author URI: http://r8.com.ua
 * Min WP Version: 2.8.0
 * Max WP Version: 2.8.0+
 */

// Include widget class
require_once dirname(__FILE__) . '/wp-filmfeed-widget.php';

/**
 * Plugin class
 */
class WP_Filmfeed
{

    /**
     * Plugin version
     */
    const VERSION = '1.0.2';

    /**
     * Cache path (relative to Wordpress content folder)
     */
    const CACHE_DIR  = '/filmfeed-cache';

    /**
     * Cache time to live
     */
    const CACHE_TTL = 259200; // 60 * 60 * 24 * 3 (3 days)

    /**
     * Plugin activate hook
     *
     * @return void
     */
    public function activate()
    {
        $this->purge_cache();
        wp_schedule_event(time(), 'daily', 'filmfeed_purge_cache');
    }

    /**
     * Plugin deactivate hook
     *
     * @return void
     */
    public function deactivate()
    {
        wp_clear_scheduled_hook('filmfeed_purge_cache');
    }

    /**
     * Purge image cache
     *
     * @return void
     */
    public function purge_cache()
    {
        $cacheDir = WP_CONTENT_DIR . self::CACHE_DIR . '/';

        foreach (glob($cacheDir . '*.*') as $filename) {
            if (filemtime($filename) + self::CACHE_TTL < time()) {
                unlink($filename);
            }
        }
    }

    /**
     * Load css for widget
     *
     * @return void
     */
    public function load_css()
    {
        $css_url = plugins_url(
            basename(dirname(__FILE__)) . '/css/wp-filmfeed.css'
        );

        wp_register_style('wp-filmfeed', $css_url, false, self::VERSION);
        wp_enqueue_style('wp-filmfeed');
    }

    /**
     * Initialize widget
     *
     * @return void
     */
    public function widget_init()
    {
        register_widget('WP_Filmfeed_Widget');
    }
}

$WP_Filmfeed = new WP_Filmfeed();

add_action('widgets_init', array($WP_Filmfeed, 'widget_init'));

add_action('wp_print_styles', array($WP_Filmfeed, 'load_css'));
add_action('filmfeed_purge_cache', array($WP_Filmfeed, 'purge_cache'));

register_activation_hook(__FILE__, array($WP_Filmfeed, 'activate'));
register_deactivation_hook(__FILE__, array($WP_Filmfeed, 'deactivate'));
