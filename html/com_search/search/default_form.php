<?php
/*
* JEZ Rego Joomla! 1.5 Template :: Output Overrides
*
* @package		JEZ Rego
* @version		1.5.0
* @author		JoomlaEZ.com
* @copyright	Copyright (C) 2008, 2009 JoomlaEZ. All rights reserved unless otherwise stated.
* @license		Commercial Proprietary
*
* Please visit http://www.joomlaez.com/ for more information
*/

/*----------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');

if (!(isset($_COOKIE['jezTplName']) && isset($_COOKIE['jezTplDir']))) {
	// get template directory
	$tpl_dir = dirname(dirname(dirname(dirname(__FILE__))));
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

// load required scripts
JHTML::_('behavior.mootools');

require_once($tpl_dir.DS.'helper.php');
jezThemeBaseHelper::loadScripts( 'jezBaseFx.js', 'templates/'.$template.'/scripts/' );
?>
<script type="text/javascript" language="javascript"><!-- // --><![CDATA[
window.addEvent('domready', function() {
	var aO = $('advanced_options');
	new jezFxStyle(aO, {
		activateOn: 'click',
		deactivateOn: 'click',
		activeCss: {'opacity': 1, 'height': aO.offsetHeight, 'margin-bottom': aO.getStyle("margin-bottom")},
		inactiveCss: {'opacity': 0, 'height': 0, 'margin-bottom': 0},
		activeFx: {duration: 500, transition: Fx.Transitions.expoOut},
		inactiveFx: {duration: 500, transition: Fx.Transitions.expoIn}
	}, $('options_switcher'));
});
// ]]></script>
<noscript>
<h6>Warning</h6>
<p>This website uses <a href="http://www.joomlaez.com/" title="Joomla Theme JEZ Rego"><em>Joomla Theme JEZ Rego</em></a>.</p>
<p><em>JEZ Rego</em> will not fully functional because your browser either does not support JavaScript or has JavaScript disabled.</p>
<p>Please either switch to a modern web browser, <em><a href="http://www.mozilla.com">FireFox</a></em> is recommended, or enable JavaScript support in your browser for best experience with Joomla theme <em>JEZ Rego</em>.</p>
<p>Visit <em><a href="http://www.joomlaez.com/" title="Download Joomla themes and Joomla modules">JoomlaEZ.com to browse and download professional Joomla themes and Joomla modules for making your Joomla site more attractive</a></em>.</p>
</noscript>
<form id="searchForm" action="<?php echo JRoute::_( 'index.php?option=com_search' );?>" method="post" name="searchForm">
<fieldset>
<legend><?php echo JText::_( 'Search Keyword' ); ?></legend>
<div class="tr gr2">
	<div class="fl tc tar">
		<input type="text" class="inputbox" name="searchword" id="search_searchword" size="30" maxlength="20" value="<?php echo $this->escape($this->searchword); ?>" title="<?php echo JText::_('Enter keyword'); ?>" />
	</div>
	<div class="fl">
		<input type="submit" name="search" title="<?php echo JText::_( 'Search' );?>" value="<?php echo JText::_( 'Search' );?>" />
		&nbsp;&nbsp;&nbsp;<a id="options_switcher" title="<?php echo JText::_( 'Show / hide advanced search options' );?>"><?php echo JText::_('Advanced options') ?></a>
	</div>
</div>
</fieldset>

<div id="advanced_options">
<fieldset>
<legend><?php echo JText::_('Advanced Options') ?></legend>
<div class="tr">
	<div class="fl tc w20p"><label><?php echo JText::_( 'Search For' ); ?></label></div>
	<div class="fl w80p"><?php echo $this->lists['searchphrase']; ?></div>
</div>
<div class="tr">
	<div class="fl tc w20p"><label for="ordering"><?php echo JText::_( 'Ordering' ); ?></label></div>
	<div class="fl w80p"><?php echo $this->lists['ordering'];?></div>
</div>
<?php if ($this->params->get( 'search_areas', 1 )) : ?>
<div class="tr">
	<div class="fl tc w20p"><label><?php echo JText::_( 'Search Only' ); ?></label></div>
	<div class="fl w80p">
		<?php foreach ($this->searchareas['search'] as $val => $txt) :
			$checked = is_array( $this->searchareas['active'] ) && in_array( $val, $this->searchareas['active'] ) ? 'checked="checked"' : ''; ?>
		<div><input type="checkbox" name="areas[]" value="<?php echo $val;?>" id="area_<?php echo $val;?>" title="<?php echo JText::_($txt); ?>" <?php echo $checked;?> />
		<label for="area_<?php echo $val;?>"><?php echo JText::_($txt); ?></label></div>
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>
<div class="tr">
	<div class="fl tc w20p">&nbsp;</div>
	<div class="fl w80p">
		<button type="submit" name="search" title="<?php echo JText::_( 'Search' );?>">
			<?php echo JHTML::_('image', "templates/$template/images/icons/silk/magnifier.png", JText::_('Icon'), array('class' => 'png24')) . JText::_( 'Search' );?></button>
	</div>
</div>
</fieldset>
</div>
<?php if ($this->searchword != '') : ?>
<p class="intro">
	<?php echo JText::_( 'Search Keyword' ) .': <strong>'. $this->escape($this->searchword) .'</strong>'; ?>
	<br /><?php echo $this->result; ?>
</p>
<?php endif;

if ($this->total > 0) : ?>
<div class="fr filter">
	<label for="limit"><?php echo JText::_( 'Display' ); ?></label>
	<?php echo $this->pagination->getLimitBox( ); ?>
	&nbsp;&nbsp;<input type="submit" title="<?php echo JText::_('Change'); ?>" value="<?php echo JText::_('Change'); ?>" />
	<?php
	if ($this->pagination->getPagesCounter() != '')
		echo '&nbsp;&nbsp;'.$this->pagination->getPagesCounter();
	?>
</div>
<?php endif; ?>
<input type="hidden" name="task" value="search" />
</form>
