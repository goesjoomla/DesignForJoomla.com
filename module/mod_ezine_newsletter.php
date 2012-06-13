<?php
/**
* Newsletter Subscribe/Unsubscribe module for eZine v2.1
*
* @copyright Design for Joomla team
*       Author           : Nguyen Manh Cuong
*       Author`s email   : cuongnm@designforjoomla.com
*       Author`s hompage : http://designforjoomla.com
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
**/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

define( '_IN_EZINE_MODULE', 1);

// module setting
$moduleclass_sfx = $params->get( 'moduleclass_sfx' );
$list_page = $params->get( 'list_page', 1 );
$input_width = $params->get( 'input_width', 20 );
$newsletter_page = $params->get( 'newsletter_page', '' );
$pre_text = $params->get( 'pre_text', '' );
$post_text = $params->get( 'post_text', '' );
$subscribe_button = $params->get( 'subscribe_button', 'Subscribe' );
$unsubscribe_button = $params->get( 'unsubscribe_button', 'Unsubscribe' );
$submit_button = $params->get( 'submit_button', 'Go' );
$submit_button_alignment = $params->get( 'submit_button_alignment', 'center' );

global $my, $mosConfig_absolute_path, $mosConfig_lang;

if (file_exists($mosConfig_absolute_path.'/language/'.$mosConfig_lang.'.php') AND file_exists($mosConfig_absolute_path.'/components/com_d4j_ezine/language/'.$mosConfig_lang.'.php'))
	require_once($mosConfig_absolute_path.'/components/com_d4j_ezine/language/'.$mosConfig_lang.'.php');
elseif (file_exists($mosConfig_absolute_path.'/components/com_d4j_ezine/language/english.php'))
	require_once($mosConfig_absolute_path.'/components/com_d4j_ezine/language/english.php');
elseif (file_exists($mosConfig_absolute_path.'/language/'.$mosConfig_lang.'.php') AND file_exists($mosConfig_absolute_path.'/components/com_ezine/language/'.$mosConfig_lang.'.php'))
	require_once($mosConfig_absolute_path.'/components/com_ezine/language/'.$mosConfig_lang.'.php');
elseif (file_exists($mosConfig_absolute_path.'/components/com_ezine/language/english.php'))
	require_once($mosConfig_absolute_path.'/components/com_ezine/language/english.php');
else {
	echo 'Newsletter Subscribe/Unsubscribe module require D4J eZine Joomla extension installed first';
	return;
}

if ($my->id) {
	$database->setQuery( "SELECT subcribed_pages FROM #__ezine_newsletter_users WHERE uid = '".$my->id."' LIMIT 0,1");
	$subcribed_pages = explode(',', $database->loadResult());
} else {
	$subcribed_pages = array();
}

$k = 0;
// get list of published eZine pages
if ($list_page) {
	$database->setQuery( "SELECT id AS value, menu_name AS `text` FROM #__ezine_page ORDER BY id" );
	if ($pages = $database->loadObjectList()) {
		$lists['pages'] = '';
		$row = 0;
		foreach ($pages AS $page) {
			$lists['pages'] .= '<tr class="sectiontableentry'.($k + 1).'"><td width="20">'.str_replace('onclick="isChecked(this.checked);"', (in_array($page->value, $subcribed_pages) ? 'checked=checked' : ''), mosHTML::idBox( $row, $page->value, false, 'pages' )).'</td>';
			$lists['pages'] .= '<td>&nbsp;'.$page->text.'</td></tr>';
			$row++;
			$k = 1 - $k;
		}
	}
} else {
	$pages = explode(',', $newsletter_page);
	$database->setQuery( "SELECT id AS value FROM #__ezine_page WHERE menu_name = '".implode("' OR menu_name = '", $pages)."'" );
	if ($pages = $database->loadObjectList()) {
		$lists['pages'] = '<div style="display:none">';
		$row = 0;
		foreach ($pages AS $page) {
			$lists['pages'] .= str_replace('onclick="isChecked(this.checked);"', 'checked="checked"', mosHTML::idBox( $row, $page->value, false, 'pages' ));
			$row++;
		}
		$lists['pages'] .= '</div>';
	}
}

if (file_exists(str_replace('\\', '/', dirname(__FILE__)).'/../components/com_d4j_ezine/class/d4jJS.php'))
	include_once(str_replace('\\', '/', dirname(__FILE__)).'/../components/com_d4j_ezine/class/d4jJS.php');
elseif (file_exists(str_replace('\\', '/', dirname(__FILE__)).'/../components/com_ezine/class/d4jJS.php'))
	include_once(str_replace('\\', '/', dirname(__FILE__)).'/../components/com_ezine/class/d4jJS.php');
?>

<script type="text/javascript">
// Joomla live site
var newsletter_action = 'subscribe';
var _SELECT_PAGE_TO_SUBSCRIBE_TO = '<?php echo _SELECT_PAGE_TO_SUBSCRIBE_TO; ?>';
var _SELECT_PAGE_TO_UNSUBSCRIBE_FROM = '<?php echo _SELECT_PAGE_TO_UNSUBSCRIBE_FROM; ?>';
var _FORGOT_INPUT_EMAIL_ADDRESS = '<?php echo _FORGOT_INPUT_EMAIL_ADDRESS; ?>';
var _SUBSCRIBE_SUCCESS = '<?php echo _SUBSCRIBE_SUCCESS; ?>';
var _SUBSCRIBE_FAIL = '<?php echo _SUBSCRIBE_FAIL; ?>';
var _UNSUBSCRIBE_SUCCESS = '<?php echo _UNSUBSCRIBE_SUCCESS; ?>';
var _UNSUBSCRIBE_FAIL = '<?php echo _UNSUBSCRIBE_FAIL; ?>';
var _VALID_EMAIL_REQUIRED = '<?php echo _VALID_EMAIL_REQUIRED; ?>';
</script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_ezine_newsletter.compact.js"></script>
<form name="mod_ezine_newsletter" method="post">
<?php if (!$list_page) echo $lists['pages']; ?>
<table border="0" cellspacing="1" cellpadding="1">
	<tr><td colspan="2">
		<?php echo $pre_text; ?>
	</td></tr>
	<?php if ($list_page) echo $lists['pages']; ?>
	<?php if (!$my->id) { ?>
	<tr><td colspan="2">
		Name:<br/>
		<input type="text" class="inputbox" name="name" value="" size="<?php echo $input_width; ?>" />
		<br/>
		Email:<br/>
		<input type="text" class="inputbox" name="email" value="" size="<?php echo $input_width; ?>" />
	</td></tr>
	<?php } ?>
	<tr><td colspan="2">
		<?php echo $post_text; ?>
	</td></tr>
	<tr class="sectiontableentry<?php echo ($k + 1); $k = 1 - $k; ?>"><td width="20">
		<input name="action" value="subscribe" type="radio" checked="checked" style="margin-top:0" onclick="newsletter_action = 'subscribe';" />
	</td><td>
		&nbsp;<?php echo $subscribe_button; ?>
	</td></tr>
	<tr class="sectiontableentry<?php echo ($k + 1); ?>"><td width="20">
		<input name="action" value="unsubscribe" type="radio" style="margin-top:0" onclick="newsletter_action = 'unsubscribe';" />
	</td><td>
		&nbsp;<?php echo $unsubscribe_button; ?>
	</td></tr>
	<tr><td colspan="2" align="<?php echo $submit_button_alignment; ?>">
		<input type="button" name="submit_button" value="<?php echo $submit_button; ?>" onclick="if (newsletter_action == 'subscribe') call_subscribe(); else if (newsletter_action == 'unsubscribe') call_unsubscribe(); else alert(newsletter_action);" class="button" />
		<input type="hidden" name="checkbox" value="<?php echo count($pages); ?>" />
		<?php if ($my->id) { ?>
		<input type="hidden" name="uid" value="<?php echo $my->id; ?>" />
		<?php } ?>
		<?php if (!$list_page) { ?>
		<input type="hidden" name="dontListPage" value="yes" />
		<?php } ?>
	</td></tr>
</table>
</form>
