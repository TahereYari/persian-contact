<?php
/*
 Plugin Name: Persian Content
Plugin URI: https://example.ir
Description:Persian Content
Author:Tahere Yari

 */
require_once __DIR__ . '/include/attachment-register.php';

 require_once __DIR__ .'/include/yari_db.php';


 require_once __DIR__.'/settings.php';

 require_once __DIR__ .'/include/shortcode.php';

 register_activation_hook(__FILE__, 'yari_tbl_create');


