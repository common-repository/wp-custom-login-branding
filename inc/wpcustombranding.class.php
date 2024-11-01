<?php
/**
 * @User Brendan
 * @Package wp-custom-login-branding
 * @File wpcustombranding.class.php
 * @Date 12-Jul-16  10:44 AM
 * @Version 1.0
 */
class wpCustomBranding
{


    private $wclb_options;

    function __construct()
    {


        $this->wclb_options = get_option('custom_login_settings_option_name');

        add_action('login_message', array($this, 'wclb_before_form'));
        add_action('login_footer', array($this, 'wclb_after_form'));
        add_action( 'login_enqueue_scripts', array($this, 'wclb_css'));
        if(!empty($this->wclb_options['change_login_url'])) {
            add_filter('login_headerurl', array($this, 'change_login_link_url'));
        }
    }


    function wclb_css()
    {
        $custom_css = $this->wclb_options['custom_css_5'];
        $custom_js = $this->wclb_options['custom_js_6'];
        $bg_image = $this->wclb_options['background_image_1'];
        $bg_colour = $this->wclb_options['background_colour_2'];
        $main_logo = $this->wclb_options['logo_0'];
        $hyperlinks = $this->wclb_options['hyperlink_colour_3'];
        $label_colour = $this->wclb_options['label_colour_4'];
        $logo_height = $this->wclb_options['logo_height'];
        $logo_width = $this->wclb_options['logo_width'];
        $body_font_colour = $this->wclb_options['body_font_colour'];
        $button_font_colour = $this->wclb_options['button_font_colour'];
        $button_bg_colour = $this->wclb_options['button_bg_colour'];
        if (isset($this->wclb_options['hide_box_shadow'])) {
            $box_shadow = $this->wclb_options['hide_box_shadow'];
        } else {
            $box_shadow = "";
        }


        ?>
        <style>
        body.login{
        background-image: url('<?php echo $bg_image;?>');
        background-color: <?php echo $bg_colour;?>;
        color: <?php echo $body_font_colour;?>;
        }
        body.login label{
        color:<?php echo $label_colour;?>;
        }
        body.login div#login h1 a {
        background-image: url('<?php echo $main_logo;?>');
        background-size: cover;
        <?php if(!empty($logo_height)){
        echo "height: ".$logo_height.";";
        }
        if(!empty($logo_width)){
        echo "width: ".$logo_width.";";
        }?>

        }
        body.login #backtoblog a, body.login #nav a {
        color: <?php echo $hyperlinks;?>;
        }

        body.login #login .button-primary {
        background: <?php echo $button_bg_colour;?>;
        border-color: <?php echo $button_bg_colour;?>;
        color: <?php echo $button_font_colour;?>;
            text-shadow: none;
        }

        <?php if(empty($box_shadow)){?>
        body.login form {
            box-shadow: none !important;
        }

        <?php } ?>
        </style>
        <!-- Custom Login CSS-->
        <?php echo $custom_css;?>
        <!--#End Custom Login CSS-->

        <!-- Custom Login JS-->
        <?php echo $custom_js;?>
        <!--#End Custom Login JS-->

        <?php
    }



    function wclb_before_form(){



        $before_form_text = $this->wclb_options['text_before_form_7'];

        if(!empty($before_form_text)){

            echo "<div class='wclb_before_text'>".$before_form_text."</div>";


        }


    }

    function wclb_after_form(){


        $after_form_text = $this->wclb_options['text_after_form_8'];

        if(!empty($after_form_text)){

            echo "<div class='wclb_after_text'>".$after_form_text."</div>";


        }



    }


    function change_login_link_url(){

        if(!empty($this->wclb_options['change_login_url'])){
            return $this->wclb_options['change_login_url'];
        }else{
            return "https://wordpress.org/";
        }

    }


}

$wclb = new wpCustomBranding();