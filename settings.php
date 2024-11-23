<?php
require_once __DIR__ . '/include/display_messages.php';

function yari_persian_contact_add_menu()
{
    add_menu_page(
        'Yari Pligin Settings',
        'تنظیمات ارتباط با کاربر',
        'manage_options',
        'yari_options',
        'yari_plugin_option_page'
    );

   add_submenu_page(
        'yari_options',
        'نمایش پیام ها',
        'نمایش پیام ها',
        'manage_options',
        'yari_display',
        'yari_display_message'
    );
}
add_action('admin_menu', 'yari_persian_contact_add_menu');

function yari_plugin_option_page()
{
?>
    <div class="warp">
        <form action="options.php" method="post">
            <?php
            settings_fields('yari_plugin_options');
            do_settings_sections('yari_plugin');
            submit_button('Save Changes', 'primary');
            ?>
        </form>
    </div>
<?php
}

function yari_plugin_admin_init()
{
    $args = array(
        'type' => 'string',
        'sanitize_callback' => 'yari_plugin_validate_option',
        'default' => null,
    );
   
    register_setting('yari_plugin_options','yari_plugin_options', $args);

    add_settings_section('yari_plugin_main', 'تنظیمات فرم', 'yari_plugin_main_section', 'yari_plugin');
    add_settings_field('yari_plugin_name_force', 'فیلد نام اجباری است', 'yari_plugin_setting_name_force', 'yari_plugin', 'yari_plugin_main');
    add_settings_field('yari_plugin_mail_force', 'فیلد ایمیل اجباری است', 'yari_plugin_setting_mail_force', 'yari_plugin', 'yari_plugin_main');
}

add_action('admin_init', 'yari_plugin_admin_init');

function yari_plugin_main_section()
{
    echo '<p>تنظیمات فرم را در این سکشن مشخص کنید</p>';
}

function yari_plugin_setting_name_force()
{
    $options = get_option('yari_plugin_options');
    // $name_force = isset($options['name_force']) ? $options['name_force'] : 'no';
    $name_force = $options['name_force'];

    $yes_checked = ($name_force == "yes") ? "checked" : "";
    $no_checked = ($name_force == "no") ? "checked" : "";

    echo '<fieldset>';
    echo '<input type="radio" name="yari_plugin_options[name_force]" value="yes" ' . $yes_checked . '> بله&nbsp;&nbsp;';
    echo '<input type="radio" name="yari_plugin_options[name_force]" value="no" ' . $no_checked . '> خیر';
    echo '</fieldset>';


}

function yari_plugin_setting_mail_force()
{
    $options = get_option('yari_plugin_options');
    $mail_force = isset($options['mail_force']) ? $options['mail_force'] : 'no';

    $yes_checked = ($mail_force == "yes") ? "checked" : "";
    $no_checked = ($mail_force == "no") ? "checked" : "";

    echo '<fieldset>';
    echo '<input type="radio" name="yari_plugin_options[mail_force]" value="yes" ' . $yes_checked . '> بله&nbsp;&nbsp;';
    echo '<input type="radio" name="yari_plugin_options[mail_force]" value="no" ' . $no_checked . '> خیر';
    echo '</fieldset>';
}

function yari_plugin_validate_option($input)
{
   var_dump($input);
    $yesorno = ['yes','no'];
    $valid = array();

    if (in_array($input['name_force'], $yesorno)) {
        $valid['name_force'] = $input['name_force'];
    } else {
        $valid['name_force'] = 'no';
    }

    if (in_array($input['mail_force'], $yesorno)) {
        $valid['mail_force'] = $input['mail_force'];
    } else {
        $valid['mail_force'] = 'no';
    }

    return $valid;
}
