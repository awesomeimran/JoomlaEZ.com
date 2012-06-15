<?php
/*
* JEZ Thema Joomla! 1.5 Theme Base :: Output Overrides
*
* @package		JEZ Thema
* @version		1.1.0
* @author		JoomlaEZ.com
* @copyright	Copyright (C) 2008, 2009 JoomlaEZ. All rights reserved unless otherwise stated.
* @license		Commercial Proprietary
*
* Please visit http://joomlaez.com/ for more information
*/

/*----------------------------------------------------------------------------*/

defined('_JEXEC') or die;
?>
<div class="tac mod_randomimage<?php echo $params->get( 'moduleclass_sfx' ); ?>">
<?php if ($link) : ?>
<a href="<?php echo $link; ?>" title="<?php echo $image->name; ?>" target="_self">
<?php endif;

echo JHTML::_('image', $image->folder.'/'.$image->name, $image->name, array('width' => (strtolower(trim($params->get('moduleclass_sfx'))) == 'fluid' ? '100%' : $image->width), 'height' => $image->height));

if ($link) : ?>
</a>
<?php endif; ?>
</div>
