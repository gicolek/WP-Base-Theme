<?php
/**
 * Options page using Settings API - no error callback used yet
 * 
 * TODO: Add Error Callback
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
        
        <?php
        // http://codex.wordpress.org/Function_Reference/get_settings_errors
        $errors = get_settings_errors();

        if ( $errors ) {
            echo "<div class='error'>";
            foreach ( $errors as $error ) {
                echo $error['message'];
            }
            echo "</div>";
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

    add_settings_field( 'skeleton_address', 'Aposta Home Text', 'skeleton_address_text', 'skeleton_settings', 'skeleton_main' );
    add_settings_field( 'skeleton_copyright', 'Skeleton Copyrightkele', 'skeleton_copyright', 'skeleton_settings', 'skeleton_main' );
    
    
}

function skeleton_section_text() {
    echo '<p>Change the footer about text here.</p>';
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
    
     $settings = array('textarea_name' => 'skeleton_options[skeleton_address]', 'media_buttons' => false, 'wpautop' => true);
     
     if(!empty($options['skeleton_address'])){
         wp_editor($options['skeleton_address'],'skeleton_addres', $settings);
     }
     else
         wp_editor('About Secret Agent','skeleton_addres', $settings);

}

function skeleton_options_validate( $input ) {
    $valid = array( );

    $valid['skeleton_copyright'] = sanitize_text_field( $input['skeleton_copyright'] );
    $valid['skeleton_address'] = $input['skeleton_address'];
    
    // add_settings_error( 'secreta_about', 'settings_updated', 'error fucker' );
    return $valid;
}

add_action( 'admin_menu', 'skeleton_options_page' );

function skeleton_options_page() {

    add_theme_page( 'Theme Options', 'Theme Options', 'manage_options', 'skeleton_settings', 'skeleton_admin_options_page' );
}