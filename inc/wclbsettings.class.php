<?php

/**
 * @User Brendan
 * @Package wp-custom-login-branding
 * @File wclbsettings.class.php
 * @Date 12-Jul-16  11:04 AM
 * @Version
 */


class CustomLoginSettings {
    private $custom_login_settings_options;

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'custom_login_settings_add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'custom_login_settings_page_init' ) );
        add_action( 'admin_enqueue_scripts', array($this, 'wclb_enqueue_scripts' ));
    }

    public function custom_login_settings_add_plugin_page() {
        add_options_page(
            'Custom Login Settings',
            'Custom Login',
            'manage_options',
            'custom-login-settings',
            array( $this, 'custom_login_settings_create_admin_page' )
        );
    }


    public  function wclb_enqueue_scripts(){

        wp_enqueue_media();
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wclb-scripts', plugins_url('js/admin.js', __DIR__ ), array( 'wp-color-picker' ), false, true );

    }

    public function custom_login_settings_create_admin_page() {
        $this->custom_login_settings_options = get_option( 'custom_login_settings_option_name' ); ?>

        <div class="wrap">
            <h2>Custom Login Settings</h2>
            <p>Brand your WordPress login screen</p>
            <?php settings_errors(); ?>

            <form method="post" action="options.php">
                <?php
                settings_fields( 'custom_login_settings_option_group' );
                do_settings_sections( 'custom-login-settings-admin' );
                submit_button();
                ?>
            </form>
        </div>
    <?php }

    public function custom_login_settings_page_init() {
        register_setting(
            'custom_login_settings_option_group',
            'custom_login_settings_option_name',
            array( $this, 'custom_login_settings_sanitize' )
        );

        add_settings_section(
            'custom_login_settings_setting_section',
            'Settings', // title
            array( $this, 'custom_login_settings_section_info' ),
            'custom-login-settings-admin'
        );

        add_settings_field(
            'logo_0', // id
            'Logo', // title
            array( $this, 'logo_0_callback' ), // callback
            'custom-login-settings-admin', // page
            'custom_login_settings_setting_section' // section
        );

        add_settings_field(
            'logo_width', // id
            'Logo Width', // title
            array( $this, 'logo_width_callback' ), // callback
            'custom-login-settings-admin', // page
            'custom_login_settings_setting_section' // section
        );

        add_settings_field(
            'logo_height', // id
            'Logo Height', // title
            array( $this, 'logo_height_callback' ), // callback
            'custom-login-settings-admin', // page
            'custom_login_settings_setting_section' // section
        );



        add_settings_field(
            'background_image_1', // id
            'Background Image', // title
            array( $this, 'background_image_1_callback' ), // callback
            'custom-login-settings-admin', // page
            'custom_login_settings_setting_section' // section
        );


        add_settings_field(
            'body_font_colour', // id
            'Body Font Colour', // title
            array( $this, 'body_font_colour_callback' ), // callback
            'custom-login-settings-admin', // page
            'custom_login_settings_setting_section' // section
        );


        add_settings_field(
            'background_colour_2', // id
            'Background Colour', // title
            array( $this, 'background_colour_2_callback' ), // callback
            'custom-login-settings-admin', // page
            'custom_login_settings_setting_section' // section
        );

        add_settings_field(
            'hyperlink_colour_3', // id
            'Hyperlink Colour', // title
            array( $this, 'hyperlink_colour_3_callback' ), // callback
            'custom-login-settings-admin', // page
            'custom_login_settings_setting_section' // section
        );

        add_settings_field(
            'label_colour_4', // id
            'Label Colour', // title
            array( $this, 'label_colour_4_callback' ), // callback
            'custom-login-settings-admin', // page
            'custom_login_settings_setting_section' // section
        );

        add_settings_field(
            'button_bg_colour', // id
            'Login Button Background', // title
            array( $this, 'button_bg_colour_callback' ), // callback
            'custom-login-settings-admin', // page
            'custom_login_settings_setting_section' // section
        );

        add_settings_field(
            'button_font_colour', // id
            'Login Button Font Colour', // title
            array( $this, 'button_font_colour_callback' ), // callback
            'custom-login-settings-admin', // page
            'custom_login_settings_setting_section' // section
        );

        add_settings_field(
            'hide_box_shadow', // id
            'Login Form Box Shadow', // title
            array( $this, 'hide_box_shadow_callback' ), // callback
            'custom-login-settings-admin', // page
            'custom_login_settings_setting_section' // section
        );

        add_settings_field(
            'change_login_url', // id
            'Custom Logo Link', // title
            array( $this, 'change_login_url_callback' ), // callback
            'custom-login-settings-admin', // page
            'custom_login_settings_setting_section' // section
        );

        add_settings_field(
            'custom_css_5', // id
            'Custom CSS', // title
            array( $this, 'custom_css_5_callback' ), // callback
            'custom-login-settings-admin', // page
            'custom_login_settings_setting_section' // section
        );

        add_settings_field(
            'custom_js_6', // id
            'Custom JS', // title
            array( $this, 'custom_js_6_callback' ), // callback
            'custom-login-settings-admin', // page
            'custom_login_settings_setting_section' // section
        );

        add_settings_field(
            'text_before_form_7', // id
            'Text Before Form', // title
            array( $this, 'text_before_form_7_callback' ), // callback
            'custom-login-settings-admin', // page
            'custom_login_settings_setting_section' // section
        );

        add_settings_field(
            'text_after_form_8', // id
            'Text After Form', // title
            array( $this, 'text_after_form_8_callback' ), // callback
            'custom-login-settings-admin', // page
            'custom_login_settings_setting_section' // section
        );
    }

    public function custom_login_settings_sanitize($input) {
        $sanitary_values = array();
        if ( isset( $input['logo_0'] ) ) {
            $sanitary_values['logo_0'] = sanitize_text_field( $input['logo_0'] );
        }

        if ( isset( $input['logo_width'] ) ) {
            $sanitary_values['logo_width'] = sanitize_text_field( $input['logo_width'] );
        }

        if ( isset( $input['logo_height'] ) ) {
            $sanitary_values['logo_height'] = sanitize_text_field( $input['logo_height'] );
        }

        if ( isset( $input['background_image_1'] ) ) {
            $sanitary_values['background_image_1'] = sanitize_text_field( $input['background_image_1'] );
        }

        if ( isset( $input['body_font_colour'] ) ) {
            $sanitary_values['body_font_colour'] = sanitize_text_field( $input['body_font_colour'] );
        }

        if ( isset( $input['background_colour_2'] ) ) {
            $sanitary_values['background_colour_2'] = sanitize_text_field( $input['background_colour_2'] );
        }

        if ( isset( $input['hyperlink_colour_3'] ) ) {
            $sanitary_values['hyperlink_colour_3'] = sanitize_text_field( $input['hyperlink_colour_3'] );
        }

        if ( isset( $input['label_colour_4'] ) ) {
            $sanitary_values['label_colour_4'] = sanitize_text_field( $input['label_colour_4'] );
        }

        if ( isset( $input['button_bg_colour'] ) ) {
            $sanitary_values['button_bg_colour'] = sanitize_text_field( $input['button_bg_colour'] );
        }

        if ( isset( $input['button_font_colour'] ) ) {
            $sanitary_values['button_font_colour'] = sanitize_text_field( $input['button_font_colour'] );
        }


        if ( isset( $input['body_font_colour'] ) ) {
            $sanitary_values['body_font_colour'] = sanitize_text_field( $input['body_font_colour'] );
        }

        if ( isset( $input['hide_box_shadow'] ) ) {
            $sanitary_values['hide_box_shadow'] = sanitize_text_field( $input['hide_box_shadow'] );
        }

        if ( isset( $input['custom_css_5'] ) ) {
            $sanitary_values['custom_css_5'] = $input['custom_css_5'];
        }

        if ( isset( $input['custom_js_6'] ) ) {
            $sanitary_values['custom_js_6'] = $input['custom_js_6'];
        }

        if ( isset( $input['text_before_form_7'] ) ) {
            $sanitary_values['text_before_form_7'] = $input['text_before_form_7'];
        }

        if ( isset( $input['text_after_form_8'] ) ) {
            $sanitary_values['text_after_form_8'] = $input['text_after_form_8'];
        }

        if( isset($input['change_login_url'])){

            $sanitary_values['change_login_url'] = $input['change_login_url'];

        }

        return $sanitary_values;
    }

    public function custom_login_settings_section_info() {

    }

    public function logo_0_callback() {
        printf(
            '<input class="regular-text" type="text" name="custom_login_settings_option_name[logo_0]" id="logo_0" value="%s"> <button class="button button-primary" id="wclb-logo" type="button">Upload</button>',
            isset( $this->custom_login_settings_options['logo_0'] ) ? esc_attr( $this->custom_login_settings_options['logo_0']) : ''
        );
    }

    public function logo_width_callback() {
        printf(
            '<input class="regular-text" type="text" name="custom_login_settings_option_name[logo_width]" id="logo_width" style="width:100px" placeholder="500px" value="%s"><br /><small>Accepts pixels or percentage</small>',
            isset( $this->custom_login_settings_options['logo_width'] ) ? esc_attr( $this->custom_login_settings_options['logo_width']) : ''
        );
    }

    public function logo_height_callback() {
        printf(
            '<input class="regular-text" type="text" name="custom_login_settings_option_name[logo_height]" id="logo_height" style="width:100px" placeholder="500px" value="%s"><br /><small>Accepts pixels or percentage</small>',
            isset( $this->custom_login_settings_options['logo_height'] ) ? esc_attr( $this->custom_login_settings_options['logo_height']) : ''
        );
    }

    public function background_image_1_callback() {
        printf(
            '<input class="regular-text" type="text" name="custom_login_settings_option_name[background_image_1]" id="background_image_1" value="%s"> <button class="button button-primary" id="wclb-bg" type="button">Upload</button>',
            isset( $this->custom_login_settings_options['background_image_1'] ) ? esc_attr( $this->custom_login_settings_options['background_image_1']) : ''
        );
    }

    public function background_colour_2_callback() {
        printf(
            '<input class="regular-text wclb-color" type="text" name="custom_login_settings_option_name[background_colour_2]" id="background_colour_2" value="%s">',
            isset( $this->custom_login_settings_options['background_colour_2'] ) ? esc_attr( $this->custom_login_settings_options['background_colour_2']) : ''
        );
    }

    public function body_font_colour_callback() {
        printf(
            '<input class="regular-text wclb-color" type="text" name="custom_login_settings_option_name[body_font_colour]" id="body_font_colour" value="%s">',
            isset( $this->custom_login_settings_options['body_font_colour'] ) ? esc_attr( $this->custom_login_settings_options['body_font_colour']) : ''
        );
    }

    public function hyperlink_colour_3_callback() {
        printf(
            '<input class="regular-text wclb-color" type="text" name="custom_login_settings_option_name[hyperlink_colour_3]" id="hyperlink_colour_3" value="%s">',
            isset( $this->custom_login_settings_options['hyperlink_colour_3'] ) ? esc_attr( $this->custom_login_settings_options['hyperlink_colour_3']) : ''
        );
    }

    public function label_colour_4_callback() {
        printf(
            '<input class="regular-text wclb-color" type="text" name="custom_login_settings_option_name[label_colour_4]" id="label_colour_4" value="%s">',
            isset( $this->custom_login_settings_options['label_colour_4'] ) ? esc_attr( $this->custom_login_settings_options['label_colour_4']) : ''
        );
    }

    public function button_font_colour_callback() {
        printf(
            '<input class="regular-text wclb-color" type="text" name="custom_login_settings_option_name[button_font_colour]" id="button_font_colour" value="%s">',
            isset( $this->custom_login_settings_options['button_font_colour'] ) ? esc_attr( $this->custom_login_settings_options['button_font_colour']) : ''
        );
    }

    public function button_bg_colour_callback() {
        printf(
            '<input class="regular-text wclb-color" type="text" name="custom_login_settings_option_name[button_bg_colour]" id="button_bg_colour" value="%s">',
            isset( $this->custom_login_settings_options['button_bg_colour'] ) ? esc_attr( $this->custom_login_settings_options['button_bg_colour']) : ''
        );
    }

    public function hide_box_shadow_callback() {


        printf(
            '<input type="checkbox" name="custom_login_settings_option_name[hide_box_shadow]" id="hide_box_shadow" value="%s" %s>', 'yes' ,
            checked( isset( $this->custom_login_settings_options['hide_box_shadow'] ), true, false )

        );
    }

    public function change_login_url_callback(){

        printf(
            '<input class="regular-text" type="text" name="custom_login_settings_option_name[change_login_url]" id="change_login_url" placeholder="http://www.example.com" value="%s">',
            isset( $this->custom_login_settings_options['change_login_url'] ) ? esc_attr( $this->custom_login_settings_options['change_login_url']) : ''
        );

    }


    public function custom_css_5_callback() {
        printf(
            '<textarea class="large-text" rows="5" name="custom_login_settings_option_name[custom_css_5]" id="custom_css_5">%s</textarea><br /><small>Opening and closing style tags required.</small>',
            isset( $this->custom_login_settings_options['custom_css_5'] ) ?  $this->custom_login_settings_options['custom_css_5'] : ''
        );
    }

    public function custom_js_6_callback() {
        printf(
            '<textarea class="large-text" rows="5" name="custom_login_settings_option_name[custom_js_6]" id="custom_js_6">%s</textarea><br /><small>Opening and closing script tags required.</small>',
            isset( $this->custom_login_settings_options['custom_js_6'] ) ?  $this->custom_login_settings_options['custom_js_6'] : ''
        );
    }

    public function text_before_form_7_callback() {
        printf(
            '<textarea class="large-text" rows="5" name="custom_login_settings_option_name[text_before_form_7]" id="text_before_form_7">%s</textarea>',
            isset($this->custom_login_settings_options['text_before_form_7']) ? $this->custom_login_settings_options['text_before_form_7'] : ''
        );
    }

    public function text_after_form_8_callback() {
        printf(
            '<textarea class="large-text" rows="5" name="custom_login_settings_option_name[text_after_form_8]" id="text_after_form_8">%s</textarea>',
            isset($this->custom_login_settings_options['text_after_form_8']) ? $this->custom_login_settings_options['text_after_form_8'] : ''
        );
    }

}
if ( is_admin() )
    $custom_login_settings = new CustomLoginSettings();

