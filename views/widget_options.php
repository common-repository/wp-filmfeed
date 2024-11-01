<?php
/**
 * Widget options form view
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
?>
<?php /** @var $this WP_Filmfeed_Widget */ ?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>">
        <?php _e('Title:'); ?>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $this->data['title']; ?>" />
    </label>
</p>

<p>
    <label for="<?php echo $this->get_field_id('username'); ?>">
        <?php _e('Filmfeed username:'); ?>
        <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $this->data['username']; ?>" />
    </label>
</p>

<p>
    <label for="<?php echo $this->get_field_id('show'); ?>">
        <?php _e('How many items would you like to display? <em>(default &ndash; 10)</em>'); ?>
        <input id="<?php echo $this->get_field_id('show'); ?>" name="<?php echo $this->get_field_name('show'); ?>" type="text" value="<?php echo $this->data['show']; ?>" size="2" />
    </label>
</p>

<p>
    <label>
        <?php _e('Thumbnail size:'); ?>
        <input id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" size="4" />X<input id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $this->data['height']; ?>" size="4" />
    </label>
</p>

<p>
    <label for="<?php echo $this->get_field_id('after_content'); ?>">
        <?php _e('Custom text after widget content'); ?>
        <textarea id="<?php echo $this->get_field_id('after_content'); ?>" class="widefat" name="<?php echo $this->get_field_name('after_content'); ?>" cols="20" rows="5"><?php echo $this->data['after_content']; ?></textarea>
    </label>
</p>
