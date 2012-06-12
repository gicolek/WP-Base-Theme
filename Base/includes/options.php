<?php

/**
 * Options page using Settings API
 */
function skeleton_admin_options_page() {
    /*
     * Fill the inputs with option values
     * really basic stuff here
     */
    ?>

    <div class="wrap">
        <?php
        if ( isset( $_GET['settings-updated'] ) ) {
            echo "<div class='updated'><p>Theme settings updated successfully.</p></div>";
        }
        ?>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'skeleton_options' );
            do_settings_sections( 'skeleton_settings' );
            ?>
            <br />
            <input name="theme_skeleton_options[submit]" type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Settings', 'skeleton' ); ?>" />
        </form>
    </div>
    <?php
}

// add the admin settings and such
add_action( 'admin_init', 'plugin_admin_init' );

function plugin_admin_init() {

    register_setting( 'skeleton_options', 'skeleton_options', 'skeleton_options_validate' );

    add_settings_section( 'skeleton_main', 'Main Settings', 'skeleton_section_text', 'skeleton_settings' );

    add_settings_field( 'skeleton_copyright', 'Copyright Text', 'skeleton_copyright', 'skeleton_settings', 'skeleton_main' );
    add_settings_field( 'skeleton_address', 'Address Text', 'skeleton_address_text', 'skeleton_settings', 'skeleton_main' );
    
}

function skeleton_section_text() {
    echo '<p>Change the footer copyright text here.</p>';
}

function skeleton_copyright() {
    $options = get_option( 'skeleton_options' );
    
    if(!empty($options['skeleton_copyright'])){
        echo "<input id='skeleton_copyright' name='skeleton_options[skeleton_copyright]' size='80' type='text' value='{$options['skeleton_copyright']}' />";  
    }
    else
        echo "<input id='skeleton_copyright' name='skeleton_options[skeleton_copyright]' size='80' type='text' value='' />";
    
}

function skeleton_address_text() {
     $options = get_option( 'skeleton_options' );
    
     if(!empty($options['skeleton_copyright'])){
        echo "<textarea id='skeleton_address' name='skeleton_options[skeleton_address]' cols='80'/>{$options['skeleton_address']}</textarea>";  
    }
    else
        echo "<textarea id='skeleton_address' name='skeleton_options[skeleton_address]' /></textarea>";
  
   

}

function skeleton_options_validate( $input ) {
    $valid = array( );

    $valid['skeleton_copyright'] = sanitize_text_field( $input['skeleton_copyright'] );
    $valid['skeleton_address'] = sanitize_text_field( esc_html($input['skeleton_address']) );
    return $valid;
}

add_action( 'admin_menu', 'skeleton_options_page' );

function skeleton_options_page() {

    add_theme_page( 'Theme Options', 'Theme Options', 'manage_options', 'skeleton_settings', 'skeleton_admin_options_page' );
}
?>
