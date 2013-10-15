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
        $this->options = get_option( 'my_option_name' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>Theme Options</h2>
            <form method="post" action="options.php">
            <?php
                //This prints out all hidden setting fields
                settings_fields( 'my_option_group' );
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
            'my_option_group',
            'my_option_name',
            array( $this, 'sanitize' )
        );

        add_settings_section(
            'setting_section_id', //ID
            'General Settings', //Title
            null, //Callback
            'narcissus-setting-admin' //Page
        );

        add_settings_field(
            'credit-link', //ID
            'Remove credit links from footer', //Title
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
    if( !isset( $input['credit_link']))
        $input['credit_link'] = null;
    if( isset( $input['credit_link']))
        $new_input['id_number'] = ( $input['id_number'] == 1 ? 1 : 0 ) ;

    return $new_input;
    }
     
    /**
     *  Getting settings option array and print one of it's values
     */
    public function credit_link_callback() {
        ?>
        <input type="checkbox" id="credit_link" name="my_option_name[credit_link]" value="1" 
        <?php checked( '1', $options['credit_link']); ?> />
        <?php
    }
}

if( is_admin())
    $my_settings_page = new Narcissus_Settings();
    
?>
