<?php
/**
 *  Customized Theme Options
 */
class Narcissus_Settings
{
    /**
     *  Values for field callbacks
     */
    private $options;

    /**
     * Start
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_theme_page'));
        add_action( 'admin_init', array( $this, 'page_init'));
    }

    /**
     *  Add options page
     */
    public function add_theme_page() {
        //This page will be under Appearance -> Theme Options
        add_theme_page(
            'Narcissus Theme Options',
            'Theme Options',
            'manage_options',
            'narcissus-setting-admin',
            array( $this, 'create_admin_page')
        );
    }

    /**
     *  Options Page callback
     */
    public function create_admin_page() {
        //Set Class property
        $this->options = get_option( 'narcissus_theme_options' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>Theme Options</h2>
            <form method="post" action="options.php">
            <?php
                //This prints out all hidden setting fields
                settings_fields( 'narcissus_option_group' );
                do_settings_sections( 'narcissus-setting-admin' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     *  Register and add settings
     */
    public function page_init() {
        register_setting(
            'narcissus_option_group',
            'narcissus_theme_options',
            array( $this, 'sanitize' )
        );

        add_settings_section(
            'setting_section_id', //ID
            'General Settings', //Title
            array( $this, 'print_section_info'), //Callback
            'narcissus-setting-admin' //Page
        );

        add_settings_field(
            'credit_link', //ID
            'Show credit links in footer', //Title
            array( $this, 'credit_link_callback' ), //Callback
            'narcissus-setting-admin', //Page
            'setting_section_id' //Section
        );
    }

    /**
     *  Sanitize each field
     *
     *  @param array $input Contains all fields as array keys
     */
    public function sanitize( $input ) {
    $new_input = array();
    //Sanitize Credit Link
    if( isset( $input['credit_link'] ) && (
                'both'          == $input['credit_link'] ||
                'wordpress'     == $input['credit_link'] ||
                'theme'         == $input['credit_link'] ||
                'none'          == $input['credit_link'] ) )
            $new_input['credit_link'] = $input['credit_link'];
    else
        $new_input['credit_link'] = 'both';

    return $new_input;
    }
     
    /**
     *  Setting Section Callback
     */
    public function print_section_info() {
        echo "Here you can customize the theme to fit your needs.";
    }

    /**
     *  Getting settings option array and print one of it's values
     */
    public function credit_link_callback() {
        ?>
        <select id="narcissus_theme_options[credit_link]" name="narcissus_theme_options[credit_link]">
            <option value="both" <?php selected( $this->options['credit_link'], 'both' ); ?>>Both</option>
            <option value="wordpress" <?php selected( $this->options['credit_link'], 'wordpress' ); ?>>WordPress</option>
            <option value="theme" <?php selected( $this->options['credit_link'], 'theme' ); ?>>Theme/Author</option>
            <option value="none" <?php selected( $this->options['credit_link'], 'none' ); ?>>None</option>
        </select>
        <?php
    }
}

if( is_admin())
    $my_settings_page = new Narcissus_Settings();
    
?>
