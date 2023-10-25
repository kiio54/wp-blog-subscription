<?php
/*
Plugin Name : admin planel
description : for admin planel
version: 1.0
Author Name : ashish
*/


//Activation And Deactivaion Hooks
function my_plugin_activation() {
    //Add Activation code here

}
register_activation_hook(__FILE__, 'my_plugin_activate');


function my_plugin_deactivate() {
    //Add deactivation code here

}
register_deactivation_hook(__FILE__, 'my_plugin_deactivate')

function MY_Plugin_menu() {
    add _menu_page(
        'my plugin settings' ,
        'my plugin'
        'manage_options'
        'my-plugin-settings'
        'my_plugin_settings_page'
    );
}
add_action('admin_menu', 'my_plugin_menu')

function my_plugin_setting_page() {
    /check user capabilities
    if (!current_user_can('manage_options')) {
        wp_die('you do not have permission to access this page.');

    }

    // Output the setting form
    ?>
    <div class="wrap">
        <h2>my plugin settings</h2>
        <form method="post" action="">
            <!-- Add your form fields here -->
        </form>
    </div>
    <?php
}

// Save the plugin settings
update_option('my_plugin_option_name', $_POST['my_plugin_option_name']);

// Retrieve the plugin settings
$plugin_option = get_option('my_plugin_option_name');