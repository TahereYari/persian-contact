<?php

$errors = array();
$succes = array();
$option = get_option('yari_plugin_options');
$name_status = $option['name_force'];
$mail_status = $option['mail_force'];


if (isset($_POST['send'])) {

    if ($name_status == 'yes' and $_POST['yari_username'] == '') {
        array_push($errors, 'وارد کردن نام ضروری است .');
    } else {
        $_POST['yari_username'] = preg_replace("/[^a-zA-Z0-9آ-ی_-]/u", '', $_POST['yari_username']);
    }


    if ($mail_status == 'yes' and $_POST['yari_mail'] == '') {
        array_push($errors, 'وارد کردن ایمیل ضروری است .');
    } elseif (!empty($_POST['yari_mail'] and !filter_var($_POST['yari_mail'], FILTER_VALIDATE_EMAIL))) {
        array_push($errors, 'فرمت ایمیل صحیح نمی باشد .');
    }

    $_POST['yari-message'] = preg_replace("/[^a-zA-Z0-9آ-ی_-]/u", '', $_POST['yari-message']);

    if (empty($errors)) {
        $result =  yari_insert_db($_POST['yari_username'], $_POST['yari_mail'], $_POST['yari-message']);
        if ($result) {
            array_push($succes, 'پیام شما با موفقیت ثبت شد.');
        } else {
            array_push($errors, 'خطایی رخ داده است .');
        }
    }
}


function yari_shortcode_render($name_force, $mail_force)
{
    global $errors;
    global $succes;
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error;
            // echo  '<div class="yari-form-error">$error</div>' ;
        }
    }


    if (!empty($succes)) {
        foreach ($succes as $succe) {
            echo $succe;
            // echo  '<div class="yari-form-success">$succe</div>';
        }
    }

?>

    <form class="yari-form" method="post">
        <table>
            <tr>
                <td>
                    <input type="text" id="username" name="yari_username" placeholder="نام خود را وارد کنید"
                        <?php echo $name_force ?>>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="email" id="mail" name="yari_mail" placeholder="ایمیل خود را وارد کنید"
                        <?php echo $mail_force ?>>
                </td>
            </tr>

            <tr>
                <td>
                    <textarea name="yari-message" id="messge" placeholder="متن را وارد کنید"></textarea>
                </td>
            </tr>

            <tr>
                <td>
                    <button type="submit" name="send">ارسال</button>
                </td>
            </tr>
        </table>
    </form>

<?php
}

function yari_shortcode_status_form()
{
    $option = get_option('yari_plugin_options');
    if ($option['name_force'] == 'yes') {
        $name_force = 'required';
    } else {
        $name_force = '';
    }

    if ($option['mail_force'] == 'yes') {
        $mail_force = 'required';
    } else {
        $mail_force = '';
    }
    yari_shortcode_render($name_force, $mail_force);
}


add_action('init', function () {
    add_shortcode('yari_contact_form', 'yari_shortcode_status_form');
});



function add_shortcode_before_content($content)
{
  
    $shortcode_output = do_shortcode('[yari_contact_form]');

   
    return $shortcode_output . $content;
}

add_filter('the_content', 'add_shortcode_before_content');
?>