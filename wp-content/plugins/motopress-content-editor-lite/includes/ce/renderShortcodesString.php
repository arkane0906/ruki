<?php
function motopressCERenderShortcodeString() {	
    require_once dirname(__FILE__).'/../verifyNonce.php';
    require_once dirname(__FILE__).'/../settings.php';
    require_once dirname(__FILE__).'/../access.php';
    require_once dirname(__FILE__).'/../functions.php';

    $errorMessage = sprintf(__("An error occurred while rendering %s", 'motopress-content-editor-lite'), __("shortcode", 'motopress-content-editor-lite'));

    if (isset($_POST['content']) && !empty($_POST['content'])) {
        global $motopressCESettings;
        $errors = array();

		$content = $_POST['content'];
		
        $motopressCELibrary = MPCELibrary::getInstance();
        if ($content) {
	        require_once $motopressCESettings['plugin_dir_path'] . 'includes/ce/renderContent.php';

            $content = stripslashes($content);
            $content = motopressCECleanupShortcode($content);
            $content = preg_replace('/\][\s]*/', ']', $content);
//            $content = motopressCEWrapOuterCode($content);
            $content = motopressCEParseObjectsRecursive($content);
            echo apply_filters('the_content', $content);
        } else {
            $errors[] = $errorMessage;
        }

        if (!empty($errors)) {
            if ($motopressCESettings['debug']) {
                print_r($errors);
            } else {
                motopressCESetError($errorMessage);
            }
        }
    } else {
        motopressCESetError($errorMessage);
    }
    exit;
}