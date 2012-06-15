<?php
/*
* JEZ Rego Joomla! 1.5 Template :: Wrappers :: standard output
*
* @package		JEZ Rego
* @version		1.5.0
* @author		JoomlaEZ.com
* @copyright	Copyright (C) 2008, 2009 JoomlaEZ. All rights reserved unless otherwise stated.
* @license		Commercial Proprietary
*
* Please visit http://www.joomlaez.com/ for more information
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

if (!(isset($_COOKIE['jezTplName']) && isset($_COOKIE['jezTplDir']))) {
	// get template directory
	$tpl_dir = dirname(__FILE__);
	setcookie('jezTplDir', $tpl_dir);

	// get the active template
	$template = basename($tpl_dir);
	setcookie('jezTplName', $template);
} else {
	$tpl_dir = $_COOKIE['jezTplDir'];
	$template = $_COOKIE['jezTplName'];
}

// is language loaded?
if ( preg_match('/\?*JEZ_REGO\?*/', JText::_('JEZ_REGO')) ) {
	$lang =& JFactory::getLanguage();
	$lang->load( "tpl_{$template}", $tpl_dir );
}

// customize template
define( 'TEMPLATE_PATH', dirname(__FILE__) );
require_once(TEMPLATE_PATH.DS.'custom.php');

// Should not output the XML declaration to prevent IE6 from using quirks mode.
// See http://en.wikipedia.org/wiki/Quirks_mode#Comparison_of_document_types for details.
// echo '<?xml version="1.0" encoding="utf-8"?'.">\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="head" />
</head>

<body<?php echo $this->params->get('pageclass_sfx') != '' ? ' class="'.$this->params->get('pageclass_sfx').'"' : ''; ?>>
	<?php
	if ($this->params->get('_modLogo') || $this->params->get('logo') != '' || $this->params->get('_navCount'))
		jezWrapper($this->params->get('wrapperHeader'), 'header', $this->params, 'jezHeader');

	jezWrapper($this->params->get('wrapperPage'), 'page', $this->params, 'jezPage', ($this->params->get('_blksCount') ? 'hasTop' : ''));

	if (!defined('RAW_OUTPUT') && ($this->params->get('_extsCount') || $this->params->get('_modUser9')))
		jezWrapper($this->params->get('wrapperExtras'), 'extras', $this->params, 'jezExtras');

	if ($this->params->get('_modFooter') || $this->params->get('_modSyndicate'))
		jezWrapper($this->params->get('wrapperFooter'), 'footer', $this->params, 'jezFooter');

	if ($this->params->get('dev') && $this->params->get('dev_panel')) : ?>
	<a href="<?php echo $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'], '?') === false ? '?' : '&').'tmpl=devpanel'; ?>" onclick="window.open(this.href, 'jezDevPanel', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=640,height=480'); return false;" id="dev_panel_link" class="button" title="<?php echo JText::_('Open Dev Mode Panel'); ?>" rel="nofollow"><?php echo JText::_('Dev Mode Panel'); ?></a>
	<?php endif; ?>
</body>
</html>
