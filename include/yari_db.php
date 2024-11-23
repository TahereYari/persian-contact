<?php
function yari_tbl_create()
{

    global $wpdb;
    $yari_tbl_name   = $wpdb->prefix . 'yari_tbl';
    $charset_collate = $wpdb->get_charset_collate();

    $yari_query = "CREATE TABLE $yari_tbl_name (

        id INT(10) NOT NULL AUTO_INCREMENT,
        user_name  VARCHAR(100) DEFAULT '',
        user_email VARCHAR(100) DEFAULT '',
        message_text TEXT DEFAULT '',
        PRIMARY KEY(id)

    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    dbDelta($yari_query);
}


function yari_insert_db($user_name, $user_email,$message) {
    global $wpdb;
    $yari_tbl_name   = $wpdb->prefix . 'yari_tbl';

    return $wpdb->insert(
        $yari_tbl_name,
        array(
            'user_name'    => $user_name,
            'user_email'   => $user_email,
            'message_text' => $message,),
        array('%s', '%s', '%s')
        );

}
