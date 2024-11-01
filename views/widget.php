<?php
/**
 * Widget view
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
<?php echo $this->data['before_widget']; ?>

<?php if ($this->data['title']): ?>
    <?php echo $this->data['before_title'] . $this->data['title'] . $this->data['after_title']; ?>
<?php endif; ?>

    <div class="filmfeed_clear"></div>

    <ul id="filmfeed_list">
        <?php foreach ($this->data['items'] as $item): ?>
            <?php
                /** @var $item      SimplePie_Item */
                /** @var $enclosure SimplePie_Enclosure */
                /** @var $image     SimplePie_Enclosure */

                $image = false;
                $enclosures = $item->get_enclosures();

                foreach ($enclosures as $enclosure) {
                    if (preg_match('/^image/', $enclosure->get_type())) {
                        $image = $enclosure;
                    }
                }
            ?>
            <?php if ($image): ?>
                <li>
                    <a href="<?php echo($item->get_link());?>" title="<?php echo($item->get_title());?>">
                        <img src="<?php echo($this->data['img_link'] . $this->get_image_filename($image->get_link()));?>" alt="<?php echo($item->get_title());?>"/>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
    <?php echo $this->data['after_content']; ?>
<?php echo $this->data['after_widget']; ?>
