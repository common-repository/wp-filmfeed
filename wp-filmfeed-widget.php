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
 */

/**
 * Widget class
 */
class WP_Filmfeed_Widget extends WP_Widget
{

    /**
     * Default poster width
     */
    const DEFAULT_WIDTH = 70;

    /**
     * Data for views
     *
     * @var array
     */
    public $data = array();

    /**
     * Widget constructor
     */
    public function __construct()
    {
        parent::WP_Widget(false, 'Filmfeed');
    }

    /**
     * Render widget
     *
     * @param array $args     Widget arguments
     * @param array $instance Settings for widget instance
     *
     * @return void
     */
    public function widget($args, $instance)
    {
        $this->data = array(
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '',
            'after_title'   => '',
        );

        $this->data = array_merge($this->data, $args);

        $this->data['title'] = apply_filters('widget_title', $instance['title']);
        $this->data['items'] = $this->_fetch_feed(
            $instance['username'],
            $instance['show']
        );
        $this->data['after_content'] = ($instance['after_content'])
            ? $instance['after_content']
            : '';

        $attr = 'w='
            . (($instance['width']) ? $instance['width'] : self::DEFAULT_WIDTH)
            . (($instance['height']) ? '&amp;h=' . $instance['height'] : '');
        $this->data['img_link'] = get_option('siteurl') . '/wp-content/plugins/'
            . dirname(plugin_basename(__FILE__))
            . '/file.php?' . $attr . '&amp;src=';

        include dirname(__FILE__) . '/views/widget.php';
    }

    /**
     * Update widget settings
     *
     * @param array $new_instance New settings
     * @param array $old_instance Old settings
     *
     * @return array
     */
    public function update($new_instance, $old_instance)
    {
        return $new_instance;
    }

    /**
     * Render widget settings form
     *
     * @param array $instance Instance data
     *
     * @return string|void
     */
    public function form($instance)
    {
        $this->data = array(
            'title'         => esc_attr($instance['title']),
            'username'      => esc_attr($instance['username']),
            'show'          => esc_attr($instance['show']),
            'width'         => esc_attr($instance['width']),
            'height'        => esc_attr($instance['height']),
            'after_content' => esc_attr($instance['after_content']),
        );

        include dirname(__FILE__) . '/views/widget_options.php';
    }

    /**
     * Fetch filmfeed feed
     *
     * @param bool $username Filmfeed username
     * @param int  $show     Number of entries to show
     *
     * @return array
     */
    private function _fetch_feed($username = false, $show = 10)
    {
        if (!$username) {
            return array();
        }

        $show = (empty($show)) ? 10 : $show;

        include_once ABSPATH . WPINC . '/feed.php';
        $feed = fetch_feed("http://filmfeed.ru/feeds/users/{$username}/");

        $items = array();
        if (!is_wp_error($feed)) {
            $items = $feed->get_items(0, $show);
        }

        return $items;
    }

    /**
     * Get image file name from url
     *
     * @param string $url Image url
     *
     * @return mixed
     */
    public function get_image_filename($url)
    {
        return str_replace(
            array(
                'http://filmfeed.ru/static/files/',
                'http://filmfeed.ru/static//files/',
            ), 
            '', 
            $url
        );
    }
}
