<?php
/**
 * Fileman wrapper
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

require_once dirname(__FILE__) . '/lib/fileman.php';

$fileman = new fileman();

$fileman->magicLocation = false;
$fileman->includePath = 'http://filmfeed.ru/static/files/';
$fileman->cacheDir = dirname(__FILE__) . '/../../filmfeed-cache/';
$fileman->allowedTypes = 'image';
$fileman->debug = false;

$fileman->send();
