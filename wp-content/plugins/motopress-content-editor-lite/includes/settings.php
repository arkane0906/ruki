<?php
require_once ABSPATH . 'wp-admin/includes/plugin.php';
global $motopressCESettings, $wp_version;
$motopressCESettings = array();
$motopressCESettings['debug'] = false;
$motopressCESettings['script_suffix'] = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
//$motopressCESettings['demo'] = false;
$motopressCESettings['admin_url'] = get_admin_url();
$motopressCESettings['plugin_root'] = WP_PLUGIN_DIR;
$motopressCESettings['plugin_root_url'] = plugins_url();
$motopressCESettings['plugin_file'] = $motopress_plugin_file;
$motopressCESettings['plugin_real_dir_name'] = basename(dirname($motopress_plugin_file));
$motopressCESettings['plugin_symlink_dir_name'] = isset($plugin) ? basename(dirname($plugin)) : $motopressCESettings['plugin_real_dir_name'];
$motopressCESettings['plugin_name'] = basename($motopressCESettings['plugin_file'], '.php');
$motopressCESettings['plugin_short_name'] = 'mpce';
$motopressCESettings['plugin_dir_path'] = plugin_dir_path($motopressCESettings['plugin_file']);
if (version_compare($wp_version, '3.9', '<')) {
	$motopressCESettings['plugin_dir_url'] = plugin_dir_url($motopressCESettings['plugin_symlink_dir_name'] . '/' . basename($motopress_plugin_file));
} else {
	$motopressCESettings['plugin_dir_url'] = plugin_dir_url($motopress_plugin_file);
}
$pluginData = get_plugin_data($motopressCESettings['plugin_file'], false, false);
$motopressCESettings['plugin_version'] = $pluginData['Version'];
$motopressCESettings['plugin_author'] = $pluginData['Author'];
//$motopressCESettings['update_url'] = $pluginData['PluginURI'] . 'motopress-content-editor-update/?time=' . time();
$motopressCESettings['license_type'] = "Lite";
$motopressCESettings['edd_mpce_store_url'] = $pluginData['PluginURI'];
$motopressCESettings['edd_mpce_item_name'] = $pluginData['Name'] . ' ' . $motopressCESettings['license_type'];
$motopressCESettings['edd_mpce_item_id'] = 1577;
$motopressCESettings['renew_url'] = $pluginData['PluginURI'];

$motopressCESettings['versions_to_update'] = array('2.4.0');

$motopressCESettings['translation_service_url'] = '';
$motopressCESettings['wordpress_version'] = get_bloginfo('version');
$motopressCESettings['canjs_version'] = '2.3.24';
$motopressCESettings['license_tabs'] = array();

$motopressCESettings['home_addons_url'] = 'http://www.getmotopress.com/addons/';
$motopressCESettings['white_label_active'] = is_plugin_active('motopress-white-label/motopress-white-label.php');

$mpCurrentTheme = wp_get_theme();
$mpCurrentThemeName = urlencode($mpCurrentTheme->get('Name'));
$mpCurrentThemeAuthor = urlencode($mpCurrentTheme->get('Author'));

$motopressCESettings['lite_upgrade_url'] = $pluginData['PluginURI'] . 'content-editor-lite-upgrade/?utm_campaign=lite&utm_source=' . $mpCurrentThemeAuthor . '&utm_medium=' . $mpCurrentThemeName . '&utm_content=v1';

function motopressCEGetLang() {
    global $motopressCESettings;

    $defaultLocale = 'en';
    $wpLocale      = get_locale();
    $locale        = substr($wpLocale, 0, 2);
    $locale2       = str_replace('_', '-', $wpLocale);

    $vendors = $motopressCESettings['plugin_dir_path'] . 'vendors';

    if (file_exists("{$vendors}/tinymce/langs/{$locale}.js")) {
	    $tinymce = $locale;
    } elseif (file_exists("{$vendors}/tinymce/langs/{$wpLocale}.js")) {
    	$tinymce = $wpLocale;
    } else {
    	$tinymce = $defaultLocale;
    }

    if (file_exists("{$vendors}/select2/select2_locale_{$locale}.js")) {
    	$select2 = $locale;
    } elseif (file_exists("{$vendors}/select2/select2_locale_{$locale2}.js")) {
		$select2 = $locale2;
    } else {
    	$select2 = $defaultLocale;
    }

    $lang = array(
    	'tinymce' => $tinymce,
    	'select2' => $select2,
    );

    return $lang;
}
$motopressCESettings['lang'] = motopressCEGetLang();

$motopressCESettings['load_scripts_url'] = $motopressCESettings['admin_url'] . 'load-scripts.php?c=0&load=jquery-ui-core,jquery-ui-widget,jquery-ui-mouse,jquery-ui-position,jquery-ui-draggable,jquery-ui-droppable,jquery-ui-resizable,jquery-ui-button,jquery-ui-dialog,jquery-ui-tabs,jquery-ui-slider,jquery-ui-accordion,jquery-ui-sortable,jquery-ui-spinner'; //utils

$upload_dir = wp_upload_dir();
$motopressCESettings['wp_upload_dir_error'] = $upload_dir['error'];
$motopressCESettings['wp_upload_dir'] = $upload_dir['basedir'];
$motopressCESettings['plugin_upload_dir_path'] = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . $motopressCESettings['plugin_name'] . DIRECTORY_SEPARATOR;
$motopressCESettings['plugin_upload_dir_url'] = $upload_dir['baseurl'] . "/" . $motopressCESettings['plugin_name'] . "/";
$motopressCESettings['custom_css_file_path'] = $motopressCESettings['plugin_upload_dir_path'] . "motopress-ce-custom.css";
$motopressCESettings['custom_css_file_url'] = $motopressCESettings['plugin_upload_dir_url'] . "motopress-ce-custom.css";
$motopressCESettings['google_font_classes_prefix'] = 'mpce-font-';
$motopressCESettings['google_font_classes_dir'] = $motopressCESettings['plugin_upload_dir_path'] . 'google-font-classes' . DIRECTORY_SEPARATOR;
$motopressCESettings['google_font_classes_dir_url'] = $motopressCESettings['plugin_upload_dir_url'] . "google-font-classes/";
$motopressCESettings['spellcheck'] = get_option('motopress-ce-spellcheck-enable', '1');
$motopressCESettings['default_fixed_row_width'] = 1170;

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https' : 'http';
$wpIncludesUrl = str_replace($protocol.'://'.$_SERVER['HTTP_HOST'], '', includes_url());
$motopressCESettings['motopress_localize'] = array(
    'ajaxUrl' => admin_url('admin-ajax.php'),
    'wpJQueryUrl' => $wpIncludesUrl . 'js/jquery/',
    'wpCssUrl' => $wpIncludesUrl . 'css/',
    'pluginVersion' => $motopressCESettings['plugin_version'],
    'pluginVersionParam' => '?ver=' . $motopressCESettings['plugin_version'],
    'scriptSuffix' => $motopressCESettings['script_suffix']
);
$motopressCESettings['palettes'] = get_option('motopress-palettes', array_fill(0,8,'#ffffff'));