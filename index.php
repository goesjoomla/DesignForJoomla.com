<?php /* Joomla Template by DesignForJoomla.com */
/* Custom Settings Begin *****************************************************/
$header_image = "header1.png";
/******************************************************* Custom Settings End */

/*** DO NOT EDIT ANYTHING BELOW THIS LINE ***/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( '_TEMPLATE_URL', $mosConfig_live_site.'/templates/'.$cur_template );
define( '_TEMPLATE_PATH', str_replace('\\', '/', dirname(__FILE__)) );

// prepare current URL
$CURRENT_URL = preg_replace("/(\?|&|&amp;)+(changeFont|changeWidth)+=(1|\-1|0|\d+)+/", '', $_SERVER['REQUEST_URI']);
$CURRENT_URL = preg_match("/\?+/", $CURRENT_URL) ? $CURRENT_URL.'&amp;' : $CURRENT_URL.'?';
$CURRENT_URL = ampReplace( $CURRENT_URL );

$iso = split( '=', _ISO );
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php if ( $my->id ) initEditor(); ?>
<?php mosShowHead(); ?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css.css" />
	<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie.css" />
	<style type="text/css">
	.image_ie {
		filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo _TEMPLATE_URL.'/images/header/'.$header_image; ?>', sizingMethod='scale')
	}
	</style>
	<![endif]-->
	<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo _TEMPLATE_URL; ?>/css/template_css_ie7.css" />
	<![endif]-->
	<style type="text/css">
<?php
	require_once( _TEMPLATE_PATH.'/func/style/d4j_stylechanger.php' );
	if (mosCountModules ('user9')) { ?>
		#user9{height:auto}
<?php
	} else {
?>
		#user9{height:0px;width:0px}
<?php
	}
?>
	</style>
	<script type="text/javascript" language="JavaScript" src="<?php echo _TEMPLATE_URL; ?>/func/style/d4j_stylechanger.js"></script>
</head>

<body><center>

<div id="container">
	<div id="title"><?php if (mosCountModules('user8')) mosLoadModules('user8', -2); else
		echo '<h1>Merry</h1><h2>Christmas</h2>';
	?></div>

	<div id="header">
		<div id="header1">
			<div id="logo">
				<h1 title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><a href="<?php echo $GLOBALS['mosConfig_live_site']; ?>" title="<?php echo $GLOBALS['mosConfig_sitename']; ?>"><?php echo $GLOBALS['mosConfig_sitename']; ?></a></h1>
			</div>
			<div id="slogan"><?php if (mosCountModules('user7')) mosLoadModules('user7', -2); else
				echo '<h1>Company Name</h1><h2>Place for your slogan</h2>';
			?></div>
		</div>

		<div id="tools"><div>
			<a href="<?php echo $CURRENT_URL; ?>changeFont=1"  onclick="changeFont(1);return false;"><img name="increase" src="<?php echo _TEMPLATE_URL ?>/images/button1.gif" alt="Increase font size" border="0"></img></a>
			<a href="<?php echo $CURRENT_URL; ?>changeFont=-1" onclick="changeFont(-1);return false;"><img name="decrease" src="<?php echo _TEMPLATE_URL ?>/images/button2.gif" alt="Decrease font size" border="0"></img></a>
			<a href="<?php echo $CURRENT_URL; ?>changeFont=0"  onclick="revertStyles(); return false;"><img name="revert"  src="<?php echo _TEMPLATE_URL ?>/images/button3.gif" alt="Revert font size to default" border="0"></img></a>
		</div></div>

		<div id="userbox">
			<div id="image">
				<?php echo '<img id ="header_image_file" src="'._TEMPLATE_URL.'/images/header/'.$header_image.'" width="318" height="225" alt="" />'; ?>
				<!--[if lt IE 7]>
				<script type="text/javascript">
				//	document.getElementById('image').style.top = '5px';
					var header_img = document.getElementById('header_image_file');
						header_img.src = '<?php echo _TEMPLATE_URL ?>/images/spacer.gif';
						header_img.className = 'image_ie';
				</script>
				<![endif]-->
			</div>
		</div>

		<div id="mbox">
			<div id="menu"><?php
				$database->setQuery("SELECT id,name,link,type,browserNav FROM #__menu WHERE menutype = 'mainmenu' AND published = 1 AND access <= $my->gid AND parent = 0 ORDER BY ordering LIMIT 0,4");
				if ($rows = $database->loadObjectList()) {
					echo'<ul id="mainmenu">';
					for ($i = 0, $n = count($rows); $i < $n; $i++) {
						$id = $Itemid == $rows[$i]->id ? ' id="active_menu1"' : '';
						$link = $rows[$i]->type == 'url' ? $rows[$i]->link : sefRelToAbs($rows[$i]->link.'&Itemid='.$rows[$i]->id);
						$link1 = ampReplace($link);
						$link2 = ' onclick="location.href = \''.$link1.'\'"';
						if ($rows[$i]->browserNav == 1) {
							$link1 .= '" target="_blank';
							$link2 = ' onclick="window.open(\''.$link1.'\', \'\', \'\')"';
						} elseif ($rows[$i]->browserNav == 2) {
							$link1 .= '" onclick="window.open(\''.$link.'\', \'\', \'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550\'); return false';
							$link2 = ' onclick="window.open(\''.$link1.'\', \'\', \'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550\')"';
						}
						echo '<li'.$id.$link2.'><a href="'.$link1.'" class="mainlevel">'.$rows[$i]->name.'</a></li>';
					}
					echo '</ul>';
				}
			?></div>
		</div>
	</div>

	<div id="content">
		<div id="lbox">
			<?php if (mosCountModules( "top" )) { ?><div class="leftbox">
				<div id="top" class="leftblock"><?php mosLoadModules ( "top", -3 ); ?></div>
			</div><?php } ?>

			<div id="mainbox_top">
				<div id="main_t_l">
					<div id="mainbody"><?php mosMainbody(); ?></div>
				</div>
				<div id="main_t_r"><!-- --></div>
			</div>

			<div id="mainbox_bottom">
				<div id="main_b_l"><!-- --></div>
				<div id="main_b_r"><!-- --></div>
			</div>

			<div class="clr"><!-- --></div>

			<?php if (mosCountModules( "bottom" )) { ?><div class="leftbox">
				<div id="bottom" class="leftblock"><?php mosLoadModules ( "bottom", -3 ); ?></div>
			</div><?php } ?>

			<div class="clr"><!-- --></div>
		</div>

		<div id="rbox">
			<div id="box">
				<div id="search_field">
					<?php
					$query = "SELECT id FROM #__menu WHERE link = 'index.php?option=com_search'";
					$database->setQuery( $query );
					$rows = $database->loadObjectList();
					// try to auto detect search component Itemid
					if ( count( $rows ) ) {
						$_Itemid = $rows[0]->id;
						$link = 'index.php?option=com_search&amp;Itemid='. $_Itemid;
					} else {
						// Assign no Itemid
						$_Itemid = '';
						$link = 'index.php?option=com_search';
					}
					?>
					<form name="searchForm" action="<?php echo $link ?>" method="post" style="margin:0px">
						<input type="hidden" name="option" value="com_search" />
						<input type="hidden" name="Itemid" value="<?php echo $_Itemid ?>"/>
						<div id="search">
							<div id="text1"><?php echo _SEARCH_TITLE; ?></div>
							<div id="inputbox">
								<input name="searchword" maxlength="40" alt="search" class="inputbox" type="text" value="<?php echo _SEARCH_TITLE; ?>" onfocus="if(this.value=='<?php echo _SEARCH_TITLE; ?>'){this.value='';}" onblur="if(this.value==''){this.value='<?php echo _SEARCH_TITLE; ?>';}"/>
							</div>
							<div id="button">
								<input class="button" type="image" alt="search" src="<?php echo _TEMPLATE_URL ?>/images/go.gif" onclick="document.searchForm.submit();" />
							</div>
						</div>
					</form>
				</div>

				<div id="loginbox">
					<?php

					if ($my->id) {
						if ($my->name) {
							$name = $my->name;
						} else {
							$name = $my->username;
						}
					echo "
					<h1><br />Hi, <b>$name</b>. <br />Click" ?> <a href="<?php echo sefRelToAbs( 'index.php?option=logout' ); ?>"><?php echo "here" ?></a><?php echo " to logout.</h1>"; ?>
					<?php
					} else {
						$validate = josSpoofValue(1);
					?>
					<form action="<?php echo sefRelToAbs( 'index.php' ); ?>" method="post" name="login" >
						<div id="sform">
							<div id="user">
								<input name="username" id="mod_login_username1" type="text" class="inputbox" alt="username" size="10" value="<?php echo _USERNAME; ?>" onfocus="if(this.value=='<?php echo _USERNAME; ?>'){this.value='';}" onblur="if(this.value==''){this.value='<?php echo _USERNAME; ?>';}" />
							</div>
							<div id="pass">
								<input type="password" id="mod_login_password1" name="passwd" class="inputbox" size="10" alt="password" value="<?php echo _PASSWORD; ?>" onfocus="if(this.value=='<?php echo _PASSWORD; ?>'){this.value='';}" onblur="if(this.value==''){this.value='<?php echo _PASSWORD; ?>';}" />
							</div>
							<div id="go">
								<input class="button" type="image" src="<?php echo _TEMPLATE_URL ?>/images/enter.gif" alt="Click here" value="<?php echo _BUTTON_LOGIN; ?>" />
							</div>
							<div id="remember">
								<input type="checkbox" name="remember" id="mod_login_remember1" class="inputbox" value="yes" alt="Remember Me" />
							</div>
							<div id="text2"><?php echo "Remember Me" ?></div>
						</div>
						<input type="hidden" name="option" value="login" />
						<input type="hidden" name="op2" value="login" />
						<input type="hidden" name="<?php echo $validate; ?>" value="1" />
					</form>
					<?php } ?>
				</div>
			</div>

			<?php if (mosCountModules( "left" )) { ?><div class="leftbox">
				<div id="left" class="leftblock"><?php mosLoadModules ( "left", -3 ); ?></div>
			</div><?php } ?>

			<?php if (mosCountModules( "right" )) { ?><div class="leftbox">
				<div id="right" class="leftblock"><?php mosLoadModules ( "right", -3 ); ?></div>
			</div><?php } ?>

			<div class="clr"><!-- --></div>
		</div>
	</div>

	<div class="clr"><!-- --></div>

	<div id="footer_container">
		<div id="user9"><?php if (mosCountModules('user9')) mosLoadModules('user9', -1); ?></div>
		<div id="footer"><?php if (mosCountModules('footer')) mosLoadModules('footer', -1); else include_once(_TEMPLATE_PATH.'/css/bottom.css.php'); ?></div>
	</div>
</div>

</center><?php include_once(_TEMPLATE_PATH.'/css/footer.css.php') ?></body>

</html><!-- Joomla Template by DesignForJoomla.com -->