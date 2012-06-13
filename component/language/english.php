<?php
// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/** FrontEnd */
DEFINE('_CLICK_TO_VIEW_NEWS_PAGE', 'Click here to continue to %CAT_NAME% page');
DEFINE('_MORE_CATEGORY_NEWS', 'More in %CAT_NAME%...');
DEFINE('_PAGE_NOT_FOUND', 'eZine Page Not Found');

DEFINE('_NEWSLETTER_SUBSCRIBE', 'Subscribe to receive further news via email');
DEFINE('_NEWSLETTER_UNSUBSCRIBE', 'We are very sorry if this newsletter might bother you.<br/>If you don`t want to receive our newsletter any more, please <a href="%UNSUBCRIBE_LINK%" target="_blank">click here</a> to unsubscribe.');
DEFINE('_SUBSCRIBE_BUTTON', 'Subscribe');
DEFINE('_UNSUBSCRIBE_BUTTON', 'Unsubscribe');
DEFINE('_SELECT_PAGE_TO_SUBSCRIBE_TO', 'Please select at least one page to subscribe to!!!');
DEFINE('_SELECT_PAGE_TO_UNSUBSCRIBE_FROM', 'Please select at least one page to unsubscribe from!!!');
DEFINE('_FORGOT_INPUT_EMAIL_ADDRESS', 'Please enter your email address!!!');
DEFINE('_SUBSCRIBE_SUCCESS', 'Subscribe successfully completed!!!');
DEFINE('_SUBSCRIBE_FAIL', 'Subscribe is not completed due to internal error!!!');
DEFINE('_UNSUBSCRIBE_SUCCESS', 'Unsubscribe successfully completed!!!');
DEFINE('_UNSUBSCRIBE_FAIL', 'Unsubscribe is not completed due to internal error!!!');
DEFINE('_VALID_EMAIL_REQUIRED', 'Please enter a valid email address.');

/** BackEnd */
DEFINE('_ADD_PAGE', 'Add eZine Page');
DEFINE('_EDIT_PAGE', 'Edit eZine Page');
DEFINE('_LINK_TO_MENU', 'Link to Menu');
DEFINE('_SELECT_MENU', 'Select a Menu:');
DEFINE('_REQUESTED_PAGE_NOT_EXIST', 'Requested page not exist');

DEFINE('_CAT_MAN', 'eZine Category Manager');
DEFINE('_SELECT_PAGE', 'Select eZine page');
DEFINE('_CAT_TITLE_IMG', 'Category Title Image');
DEFINE('_MORE_NEWS_IMG', '"More in..." Link Image');
DEFINE('_NEWS_ORDER', 'Items Order Type');
define('_WORDS_PER_ARTICLE', 'Words per Article');
define('_WORDS_PER_ARTICLE_TIPS', 'How many words to display for article intro-text? 0 means no truncate (full intro-text).');
DEFINE('_NUMBER_OF_LEADING', '# Leading articles');
DEFINE('_NUMBER_OF_INTRO', '# Intro articles');
DEFINE('_NUMBER_OF_INTRO_COLS', '# Intro columns');
DEFINE('_NUMBER_OF_LINK', '# Links');
DEFINE('_NUMBER_OF_LINK_COLS', '# Link columns');
DEFINE('_INTRO_IMG', 'Intro with Image');
DEFINE('_LINK_IMG', 'Links with Image');
DEFINE('_FRONTPAGE_ONLY', 'Frontpage Item Only');
DEFINE('_INTRO_ONLY', 'Intro Text Only');
DEFINE('_SEPARATOR_NEWS_INFO', 'Content Item: ');
DEFINE('_SEPARATOR_TYPED_INFO', 'Static Content: ');
DEFINE('_SEPARATOR_HTML_INFO', 'HTML Code');
DEFINE('_REQUESTED_CAT_NOT_EXIST', 'Requested category not exist');

DEFINE('_SELECT_CONTENT_TYPE', 'Select Content Type');
DEFINE('_CONTENT_SECTION', 'Content Section');
DEFINE('_CONTENT_CATEGORY', 'Content Category');

DEFINE('_ADD_SEC_MAN', 'Add Content Section to %CAT_NAME% Page');
DEFINE('_ADD_CAT_MAN', 'Add Content Category to %CAT_NAME% Page');
DEFINE('_NUMBER_OF_ACT_ITEM', '# Active');
DEFINE('_NUMBER_OF_TRASH_ITEM', '# Trash');

DEFINE('_EDIT_CAT_MAN', 'Edit eZine Category');
DEFINE('_CURRENT_IMG', 'Current Image:');

DEFINE('_EDIT_CSS', 'Edit CSS');
DEFINE('_EDIT_LANG', 'Edit Language');
DEFINE('_FILE_IS', '`%FILE_NAME%` is :');
DEFINE('_WRITEABLE', 'Writeable');
DEFINE('_UNWRITEABLE', 'Unwriteable');
DEFINE('_NOT_CREATED', 'Not Exist');
DEFINE('_MAKE_UNWRITEABLE', 'Make unwriteable after saving');
DEFINE('_OVERRIDE_UNWRITEABLE', 'Override write protection while saving');
DEFINE('_UNABLE_OPEN_FILE', 'Unable to open file `%FILE_NAME%` or file not found.');
DEFINE('_FILE_NOT_OPEN', 'Operation failed: Failed to open file for writing.');
DEFINE('_FILE_SAVED', 'File `%FILE_NAME%` saved successully.');
DEFINE('_CONTENT_EMPTY', 'Operation failed: Content empty.');

DEFINE('_SELECT_SEPARATOR_TYPE', 'Select Separator Type');
DEFINE('_CONTENT_ITEM', 'Content Item (Articles Item)');
DEFINE('_TYPED_CONTENT', 'Static Content (Typed Content)');
DEFINE('_HTML_CODE', 'HTML Code (E.g: Google AdSense code)');
DEFINE('_NEWS_SEPARATOR', 'Add Content Item as Separator');
DEFINE('_TYPED_SEPARATOR', 'Add Static Content as Separator');
DEFINE('_ADD_HTML_SEPARATOR', 'Add HTML Code as Separator');
DEFINE('_EDIT_HTML_SEPARATOR', 'Edit HTML Code Separator');
DEFINE('_HTML_CODE_INPUT', 'Type in or copy/paste your HTML code below...');
DEFINE('_EDIT_SEPARATOR_FAIL', 'Only HTML Code Separator can be edited.');
DEFINE('_EDIT_HTML_SEPARATOR_ONLY', 'Only HTML separator can be editable');

defined('_ID') or DEFINE('_ID', 'ID');
DEFINE('_TITLE', 'Title');
defined('_PUBLISHED') or DEFINE('_PUBLISHED', 'Published');
DEFINE('_FRONTPAGE', 'FrontPage');
DEFINE('_ACCESS', 'Access');
DEFINE('_AUTHOR', 'Author');

DEFINE('_SEARCH_ORDER', 'Order:');
defined('_ORDER') or DEFINE('_ORDER', 'Order');
defined('_REORDER') or DEFINE('_REORDER', 'Reorder');
DEFINE('_LINK', 'Link');

DEFINE('_CONTENT_CAT', 'Category');
DEFINE('_CONTENT_SEC', 'Section');

/* Global setting page */
DEFINE('_GLOBAL_SETTINGS', 'GLOBAL SETTINGS');
DEFINE('_AJAX_SET', 'AJAX Technology Settings');
DEFINE('_CATEGORY_OPEN_AJAX_ENABLE', 'Enable AJAX for Category Page');
DEFINE('_CONTENT_OPEN_AJAX_ENABLE', 'Enable AJAX for Article Page');
DEFINE('_AJAX_SEF_URL_ENABLE', 'Enable SEF for AJAX Pages');

DEFINE('_IMAGE_SET', 'Image Processing Settings');

define('_HIDE_FIRST_MOSIMAGE', 'Hide First <b>{mosimage}</b>');
define('_HIDE_FIRST_MOSIMAGE_TIPS', 'Due to eZine automatically get the image associated with the first <b>{mosimage}</b> tag found in an article for making thumbnail and link image so you might not want this image becomes visible in the full article page. In this case, please select <b>Yes</b>. Select <b>No</b> will display the first image when reading full article.');
define('_REAL_THUMBNAIL', 'Real Thumbnail');
define('_REAL_THUMBNAIL_TIPS', 'Instead of using HTML &lt;img&gt; tag`s &quot;width&quot; and &quot;height&quot; attributes to resize image, create real thumbnail file for article thumbnail, link image and content image (require GD2 library compiled with PHP or ImageMagick / NetPBM software installed in your server)?');
define('_THUMBNAIL_DIR', 'Thumbnail Directory');
define('_THUMBNAIL_DIR_TIPS', 'Relative path from Joomla root directory to where you want to store thumbnail created by eZine. The thumbnail directory must be writeable (chmod it to 0777 if in Unix/Linux system)');
define('_IMAGE_LIB', 'Image Library');
define('_IMAGE_LIB_TIPS', 'Image library/software to handle creation of real thumbnail');
define('_IMAGE_LIB_PATH', 'Path to ImageMagick/NetPBM');
define('_IMAGE_LIB_PATH_TIPS', 'If not choose to use GD2, enter server path to where ImageMagick / NetPBM is installed in your server');

DEFINE('_THUMBNAIL_IMAGE_SET', 'Thumbnail Settings');
DEFINE('_THUMBNAIL_IMAGE_LINK', 'Thumbnail Link To');
DEFINE('_LEADING_THUMBNAIL_IMAGE_POSITION', 'Thumbnail Position (Leading)');
DEFINE('_INTRO_THUMBNAIL_IMAGE_POSITION', 'Thumbnail Position (Intro)');
DEFINE('_THUMBNAIL_POSITION_SELECTOR', 'Select Thumbnail Position');
DEFINE('_LEFT_FEATURED_THUMBNAIL_DIMENSION', 'Left Featured Thumbnail Dimension');
DEFINE('_RIGHT_FEATURED_THUMBNAIL_DIMENSION', 'Right Featured Thumbnail Dimension');
DEFINE('_TOP_FEATURED_THUMBNAIL_DIMENSION', 'Top Featured Thumbnail Dimension');
DEFINE('_BOTTOM_FEATURED_THUMBNAIL_DIMENSION', 'Bottom Featured Thumbnail Dimension');
DEFINE('_LEFT_THUMBNAIL_DIMENSION', 'Left Thumbnail Dimension');
DEFINE('_RIGHT_THUMBNAIL_DIMENSION', 'Right Thumbnail Dimension');
DEFINE('_TOP_THUMBNAIL_DIMENSION', 'Top Thumbnail Dimension');
DEFINE('_BOTTOM_THUMBNAIL_DIMENSION', 'Bottom Thumbnail Dimension');

DEFINE('_CONTENT_IMAGE_PROCESSOR_SET', 'Content Image Settings');
DEFINE('_CONTENT_IMAGE_PROCESSOR', '{mosimage} Processor');
DEFINE('_CONTENT_IMAGE_MARGIN', 'Margin');
DEFINE('_CONTENT_IMAGE_PADDING', 'Padding');
DEFINE('_CONTENT_IMAGE_PROCESS_MENTHOD', 'Process Method');
DEFINE('_REDUCE_LARGE_IMG_ONLY', 'Reduce Large Image Only');
DEFINE('_ENLARGE_SMALL_IMG_ONLY', 'Enlarge Small Image Only');
DEFINE('_BOTH_REDUCE_ENLARGE', 'Both Reduce / Enlarge');
DEFINE('_CONTENT_IMAGE_RESIZE_TO', 'Content Image Size');
DEFINE('_CONTENT_IMAGE_KEEP_RATIO', 'Keep Image Aspect Ratio');
DEFINE('_FIT_WIDTH', 'Fit Width');
DEFINE('_FIT_HEIGHT', 'Fit Height');
DEFINE('_FIT_BOTH', 'Fit Both');
DEFINE('_CONTENT_IMAGE_ENABLE_ENLARGE', 'Click Thumbnail Show Real Size');
DEFINE('_CONTENT_IMAGE_ENABLE_ENLARGE_TEXT', 'Show &quot;Click to Enlarge&quot;');
define('_CONTENT_IMAGE_ENLARGE_TEXT_POS', '&quot;Click to Enlarge&quot; text position');
define('_CONTENT_IMAGE_TEXT_CSS', '&quot;Click to Enlarge&quot; link css class');
DEFINE('_CONTENT_IMAGE_ENLARGE_TEXT', '&quot;Click to Enlarge&quot; Text');
DEFINE('_POPUP_WIN_MAX_SIZE', 'Popup Window Max Size');
define('_CONTENT_IMAGE_POPUP_SHOW_PRINT', 'Show &quot;Print&quot; link in popup window');
define('_CONTENT_IMAGE_POPUP_PRINT_TEXT', '&quot;Print&quot; link text');
define('_CONTENT_IMAGE_POPUP_SHOW_CLOSE', 'Show &quot;Close&quot; link in popup window');
define('_CONTENT_IMAGE_POPUP_CLOSE_TEXT', '&quot;Close&quot; link text');
define('_CONTENT_IMAGE_POPUP_PRINT_CLOSE_CSS', '&quot;Print&quot;, &quot;Close&quot; links css class');

DEFINE('_LINK_IMAGE_PROCESSOR_SET', 'Link Image Settings');
DEFINE('_LINK_IMAGE_TYPE', 'Link Image Type');
DEFINE('_LINK_IMAGE_RESIZE_TYPE', 'Link Image Resize Method');
DEFINE('_LINK_IMAGE_RESIZE_TO', 'Link Image Size');
define('_LINK_IMAGE_DEFAULT', 'Default Link Image');
define('_LINK_IMAGE_DEFAULT_TIPS', 'Full URL or relative path from your Joomla! root dir to an image to use as default link image if no any {mosimage} bot tag found in an article. Leave blank will create empty table cell with the size of link image width and height.');

define('_ARTICLE_LINK_SET', 'Article Link Settings');
define('_ARTICLE_LINK_ITEMID', 'Inherit Itemid?');
define('_ARTICLE_LINK_ITEMID_TIPS', 'When creating link to full article reading page, inherit Itemid of its eZine category`s menu item or not?');

define('_ARTICLE_ICON_SET', 'Icon Settings');
define('_ARTICLE_ICON_POSITION', 'Icons Position');
define('_ARTICLE_ICON_POSITION_TIPS', 'Position of &quot;PDF&quot;, &quot;Print&quot;, &quot;Email&quot; icons/buttons in full article page');
define('_ARTICLE_ICON_ARRANGEMENT_TOP', 'Arrangement for Top');
define('_ARTICLE_ICON_ARRANGEMENT_TOP_TIPS', 'How to arrange &quot;PDF&quot;, &quot;Print&quot;, &quot;Email&quot; icons/buttons at top in full article page?');
define('_ARTICLE_ICON_ARRANGEMENT_BOTTOM', 'Arrangement for Bottom');
define('_ARTICLE_ICON_ARRANGEMENT_BOTTOM_TIPS', 'How to arrange &quot;PDF&quot;, &quot;Print&quot;, &quot;Email&quot; icons/buttons at bottom in full article page?');
define('_ARTICLE_ICON_DISPLAY_TOP', 'Icons or Text for Top');
define('_ARTICLE_ICON_DISPLAY_TOP_TIPS', 'How to display &quot;PDF&quot;, &quot;Print&quot;, &quot;Email&quot; icons/buttons at top in full article page?');
define('_ARTICLE_ICON_DISPLAY_BOTTOM', 'Icons or Text for Bottom');
define('_ARTICLE_ICON_DISPLAY_BOTTOM_TIPS', 'How to display &quot;PDF&quot;, &quot;Print&quot;, &quot;Email&quot; icons/buttons at bottom in full article page?');
define('_ARTICLE_PDF_ICON_TEXT', 'Text for &quot;PDF&quot;');
define('_ARTICLE_PRINT_ICON_TEXT', 'Text for &quot;Print&quot;');
define('_ARTICLE_EMAIL_ICON_TEXT', 'Text for &quot;Email&quot;');

DEFINE('_NEWSLETTER_SUBSCRIBE_SET', 'Newsletter Subscribe/Unsubscribe Page Settings');
DEFINE('_SUBSCRIBE_PAGE_TITLE', 'Subscribe/Unsubscribe page title');
DEFINE('_SHOW_LIST_OF_PAGE', 'Show list of published eZine page');
DEFINE('_EZINE_NEWSLETTER_PAGE', ' eZine newsletter page');
DEFINE('_SUBSCRIBE_PRE_TEXT', 'Pre subscribe/unsubscribe form text');
DEFINE('_SUBSCRIBE_POST_TEXT', 'Post subscribe/unsubscribe form text');
DEFINE('_SUBSCRIBE_LINK', 'Newsletter Subscribe Link');

define('_SEF_SET', 'SEF URL Settings');
define('_SEF_LOWERCASE_ALL', 'Lowercase all URL?');
define('_SEF_LOWERCASE_ALL_TIPS', 'This parameter might be overwritten by the settings of SEF component');
define('_SEF_REPLACE_CHAR', 'Replace symbol character with');
define('_SEF_URL_FORM', 'SEF URL Format');
define('_SEF_PAGE_FIELD', 'eZine page field');
define('_SEF_CAT_FIELD', 'eZine category field');
define('_SEF_ARTICLE_FIELD', 'Content item field');
define('_SEF_MULTI_FORM', 'Multi-page form');

/* eZine Page Settings */
DEFINE('_GENERAL_SET', 'General');
DEFINE('_LAYOUT_SET', 'Layout');
DEFINE('_COVER_SET', 'Cover');
DEFINE('_PAGE_ENABLE_COVER', 'Enable Cover');
DEFINE('_PAGE_COVER_OUTPUT', 'Cover Display Method');
DEFINE('_PAGE_COVER_AUTO_REDIRECT', 'Cover Auto Redirect');
DEFINE('_PAGE_COVER_IMAGE', 'Cover Image');
DEFINE('_PAGE_COVER_HTML_CODE', 'Cover HTML Code');

define('_FEATURED_ARTICLE_SET', 'Featured Article');
define('_SHOW_FEATURED_ARTICLE', 'Enable featured article?');
define('_SHOW_FEATURED_TITLE', 'Show &quot;Featured Article&quot; title?');
define('_FEATURED_TITLE_TEXT', '&quot;Featured Article&quot; title text');
define('_SHOW_FEATURED_ARTICLE_TIPS', 'Display content item marked to show in frontpage as Featured Article');
define('_LIMIT_FEATURED_TO_SECTION', 'Limit to sections');
define('_LIMIT_FEATURED_TO_SECTION_TIPS', 'Limit source to retrieve featured article to sections. Leave none selected will retrieve from all sections');
define('_LIMIT_FEATURED_TO_CATEGORY', 'Limit to categories');
define('_LIMIT_FEATURED_TO_CATEGORY_TIPS', 'Limit source to retrieve featured article to categories. Leave none selected will retrieve from all categories');
define('_FEATURED_WORD_COUNT', 'Words count');
define('_FEATURED_WORD_COUNT_TIPS', 'How many words to display for featured article intro-text? 0 means no truncate (full intro-text)');
define('_FEATURED_LEADING', '# Leading');
define('_FEATURED_LEADING_TIPS', 'How many featured article in leading block?');
define('_FEATURED_LEADING_THUMBNAIL_POSITION', 'Thumbnail position');
define('_FEATURED_LEADING_THUMBNAIL_POSITION_TIPS', 'Thumbnail position for featured article in leading block');
define('_FEATURED_INTRO', '# Intro');
define('_FEATURED_INTRO_TIPS', 'How many featured article in intro block?');
define('_FEATURED_INTRO_COLS', '# Columns');
define('_FEATURED_INTRO_COLS_TIPS', 'How many column to arrange featured article in intro block?');
define('_FEATURED_INTRO_THUMBNAIL_POSITION', 'Thumbnail position');
define('_FEATURED_INTRO_THUMBNAIL_POSITION_TIPS', 'Thumbnail position for featured article in intro block');
define('_FEATURED_ORDER', 'Order article by');

DEFINE('_NO_CATEGORY_FOUND', 'No eZine Content found to display. Please go to <b>Component -> eZine -> Manage eZine Category</b> and create one, if you do not have any or publish existing categories.');
DEFINE('_TIMEOUT_IN_SECONDS_FOR_AUTO_REDIRECT', 'Timeout for auto redirect action (in seconds)');

define('_PAGE_PARAMS_SAVED', 'Page Settings Successfully Saved');

/* eZine Page Management */
DEFINE('_PAGE_MAN', 'eZine Page Manager');
DEFINE('_ADD_AT_LEAST_ONE_PAGE_FIRST', 'At least one eZine Page must be created first');
DEFINE('_PAGE_NAME', 'Page Name');
defined('_PAGE_TITLE') or DEFINE('_PAGE_TITLE', 'Page Title');
DEFINE('_PAGE_SHOW_TITLE', 'Show Page Title');
DEFINE('_SET_MENU_LINKS', 'Click to set menu links');

DEFINE('_PAGE_BLOCK1', '# Block 1 categories');
DEFINE('_PAGE_BLOCK1_TIPS', 'How many eZine category you want to group to Block #1?');
DEFINE('_PAGE_BLOCK1_COLS', '# Block 1 columns');
DEFINE('_PAGE_BLOCK1_COLS_TIPS', 'How many column you want to arrange eZine category in Block #1 into?');
DEFINE('_PAGE_BLOCK2', '# Block 2 categories');
DEFINE('_PAGE_BLOCK2_TIPS', 'How many eZine category you want to group to Block #2?');
DEFINE('_PAGE_BLOCK2_COLS', '# Block 2 columns');
DEFINE('_PAGE_BLOCK2_COLS_TIPS', 'How many column you want to arrange eZine category in Block #2 into?');
DEFINE('_PAGE_BLOCK3', '# Block 3 categories');
DEFINE('_PAGE_BLOCK3_TIPS', 'How many eZine category you want to group to Block #3?');
DEFINE('_PAGE_BLOCK3_COLS', '# Block 3 columns');
DEFINE('_PAGE_BLOCK3_COLS_TIPS', 'How many column you want to arrange eZine category in Block #3 into?');

/* eZine Category Settings */
DEFINE('_CONTENT_SET', 'Content');
DEFINE('_PAGE_LINKED_CAT_TITLE', 'Linked Category Title');
DEFINE('_PAGE_SHOW_MORE_CAT_NEWS', 'Show "More in..." Link');
DEFINE('_PAGE_MORE_CAT_NEWS_TYPE', '"More in..." Page Display Type');

DEFINE('_DISPLAY_SET', 'Display');
DEFINE('_INTRO_WITH_IMG', 'Display intro with image?');
DEFINE('_LINK_WITH_IMG', 'Display link with image?');

DEFINE('_CAT_SHOW_TITLE', 'Show Category Title');

DEFINE('_MORE_IN_SET', 'More In');
define('_PAGE_CLASS_SFX', 'Page Class Suffix');
define('_BACK_BUTTON', 'Back Button');
define('_ARTICLE_TITLE', 'Article Title');
define('_LINKED_ARTICLE_TITLE', 'Linked Article Title');
define('_CAT_TITLE', 'Category Title');
define('_LINKED_CAT_TITLE', 'Linked Category Title');
define('_SEC_TITLE', 'Section Title');
define('_LINKED_SEC_TITLE', 'Linked Section Title');
define('_ITEM_RATING', 'Item Rating');
define('_AUTHOR_NAME', 'Author Name');
define('_CREATED_DATE', 'Created Date and Time');
define('_MODIFY_DATE', 'Modified Date and Time');
define('_PDF_ICON', 'PDF Icon');
define('_PRINT_ICON', 'Print Icon');
define('_EMAIL_ICON', 'Email Icon');
define('_ICON_OR_TEXT', 'Icon or Text');
define('_MORE_IN_PARAMS', 'More In parameters');
define('_CLICK_TO_SET', 'Click to set');
define('_CAT_PARAMS_SAVED', 'Category Settings Successfully Saved');

/* eZine SEF URL Management */
define('_SEF_URL_MAN', 'eZine SEF URL Manager');
define('_SEF_ORG_URL', 'Original eZine URL');
define('_SEF_SEO_URL', 'eZine SEF URL');
define('_SEF_SEO_URL_TIPS', 'The trailing slash at end of eZine SEF URL will be replaced with the suffix parameter of your SEF component automatically so please DO NOT remove it.');
define('_SEF_INPUT_SEO_URL', 'Input new eZine SEF URL for %ORG_URL%:');
define('_ADD_SEF', 'Add new eZine SEF URL');
define('_EDIT_SEF', 'Edit eZine SEF URL');
define('_SEF_URL_SAVED', 'eZine SEF URL Saved');
define('_SEF_URL_REMOVED', 'Selected eZine SEF URL(s) removed');

/* Common */
DEFINE('_IMAGE_SELECTOR', 'Image Selector');
DEFINE('_IMAGE_PREVIEW', 'Image Preview');
DEFINE('_REMOVE_IMAGE', 'Remove Image');
DEFINE('_ORDER_SELECTOR', 'Select Order');

DEFINE('_HTML_EDITOR', 'Cover HTML Editor');
DEFINE('_UPDATE_HTML', 'Update HTML Code');
DEFINE('_REMOVE_HTML', 'Remove HTML Code');

DEFINE('_LOCATION_SELECTOR', 'Location Selector');
DEFINE('_REMOVE_COVER', 'Remove Cover Page');
DEFINE('_PLEASE_LINK_NEWS_PAGE_TO_MENU_FIRST', 'Please create a menu link for this news page first');

DEFINE('_MENU_SELECTOR', 'Menu Selector');
DEFINE('_EXISTED_MENU_ITEM', 'Existed menu link');
DEFINE('_DUPLICATED_MENU_LINK', 'Duplicated link. Menu already has item linked to this eZine Page');

defined('_INVALID_PARAMS') or DEFINE('_INVALID_PARAMS', 'Invalid Parameters');
defined('_ERROR_QUERY_DB') or DEFINE('_ERROR_QUERY_DB', 'Error trying to access to database');
DEFINE('_CONFIG_SAVED', 'Global Settings Successfully Saved.');

DEFINE('_NOT_FOUND_ANY', 'Not found any item');
DEFINE('_AVAILABLE_WHEN_SAVED', 'Settings available when saved');
DEFINE('_UNPUBLISHED_BY_DEFAULT', 'By default, new eZine page is unpublished. After saved, you can publish it in the &quot;eZine Page Manager&quot; page');

DEFINE('_CANNOT_OPEN_CSS_FILE', 'Cannot open CSS file');
DEFINE('_CSS_CONTENT_EMPTY', 'You have left the CSS content empty');

DEFINE('_FILE_NOT_WRITABLE', 'File is not writable');
DEFINE('_CANNOT_OPEN_FILE_TO_WRITE', 'Cannot open file to write');
DEFINE('_CANNOT_OPEN_LANG_FILE', 'Cannot open language file');
DEFINE('_LANG_CONTENT_EMPTY', 'You have left the language file empty');

DEFINE('_NEWSLETTER_MAN', 'eZine Newsletter Manager');
DEFINE('_DATE_CREATED', 'Created date');
DEFINE('_ALREADY_SEND', 'Has been sent?');
DEFINE('_DATE_SEND', 'Has been sent on');
DEFINE('_NEW_NEWSLETTER', 'New eZine newsletter');
DEFINE('_EDIT_NEWSLETTER', 'Edit eZine newsletter');
DEFINE('_NEWSLETTER_CONFIG', 'Newsletter Settings');
DEFINE('_PAGE_TO_GET_CONTENT', 'Get newsletter content from');
DEFINE('_NEWSLETTER_TEMPLATE', 'Template for use with this newsletter');
DEFINE('_NEWSLETTER_CONTENT', 'Newsletter Content');
DEFINE('_PREDEFINED_PLACEHOLDER', '<font style="font-size:150%"><u>Predefined placeholder:</u></font><br/><br/><br/>1. <b>%NAME%</b> will be replaced with receiver`s name<br/><br/>2. <b>%EMAIL%</b> will be replaced with receiver`s email<br/><br/>3. <b>%UNSUBSCRIBE%</b> will be replaced with the unsubscribe link, if this placeholder is not included in the content of newsletter, it will be automatically appended to end of newsletter before send out');
DEFINE('_SELECT_PAGE_TO_GET_CONTENT', 'Please select an eZine page to get content for this newsletter');
DEFINE('_REQUESTED_LETTER_NOT_EXIST', 'Requested letter not exist');

DEFINE('_SUBSCRIBERS_MAN', 'Subscribers List');
DEFINE('_USER_NAME', 'Subscriber name');
DEFINE('_USER_EMAIL', 'Subscriber email');
DEFINE('_DATE_JOIN', 'Subscribe on');
DEFINE('_SUBSCRIBED_TO', 'Subscribe to');
DEFINE('_ADD_SUBSCRIBERS', 'Add users to subscribers list');
DEFINE('_FILTER_USERS', 'Search for users:');
DEFINE('_SELECT_USER_PAGE_FIRST', 'Please select at least one user and at least one eZine page');

DEFINE('_SEND_NEWSLETTER', 'Newsletter Sending');
DEFINE('_SENDING_SET', 'Sending Options');
DEFINE('_EMAIL_PER_BLOCK', 'Emails per block');
DEFINE('_INTERVAL_BETWEEN_BLOCK', 'Delay between blocks');
DEFINE('_NEWSLETTER_SUBJECT', 'Newsletter subject');
DEFINE('_PAGE_HAS_NO_SUBSCRIBER', 'This newsletter has no any subscriber');
DEFINE('_SEND', 'Send Newsletter');
DEFINE('_SENDING_STATUS', 'Sending block #<span id="current_block"></span> of <span id="total_block"></span> ...');
DEFINE('_SEND_SUCCESS', 'Newsletter has been sent.');

define('_FILTER_EMPTY', 'Filter Empty');
define('_SUBSCRIBE_EMPTY', 'Subscriber Empty');
?>