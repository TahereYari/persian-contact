<?php
function yari_admin_styles(){

    wp_register_style('admin-style',plugins_url('persian-contact/css/admin-styles.css'));
    wp_enqueue_style('admin-style');

   
}
add_action('admin_print_styles' , 'yari_admin_styles');


function yari_contact_form_styles()
{


    wp_register_style('form-style', plugins_url('persian-contact/css/form-style.css'));
    wp_enqueue_style('form-style');
}

add_action('wp_enqueue_scripts', 'yari_contact_form_styles');