<?php

function yari_display_message() {
    

 global $wpdb;
$yari_tbl_name   = $wpdb->prefix . 'yari_tbl';
$yari_results = $wpdb->get_results("SELECT * FROM $yari_tbl_name");
?>


<div>
    <table id="user_messages">
        <tr>
            <td>نام</td>
            <td>ایمیل</td>
            <td>پیغام</td>
        </tr>
        <?php
        foreach ($yari_results as $yari_result) {
           $username = $yari_result->user_name;
           $email = $yari_result->user_email;
           $message = $yari_result->message_text;

            ?>
            <tr>
                <td><?php echo $username?></td>
                <td><?php echo $email?></td>
                <td><?php echo $message?></td>
                
            </tr>

            <?php
        }

        ?>
    </table>
</div>
<?php
}