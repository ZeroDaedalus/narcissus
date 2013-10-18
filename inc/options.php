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
     *  Valid Arguments for functions
     */
    private $arguments = array(
                'credit_link' => array ( 'both', 'wordPress', 'theme', 'none'),
                'custom_sidebar' => array ( 'right', 'left', 'none')
                );

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
            'general_theme_settings', //ID
            'General Settings', //Title
            array( $this, 'print_section_info'), //Callback
            'narcissus-setting-admin' //Page
        );

        add_settings_field(
            'credit_link', //ID
            'Show credit links in footer', //Title
            array( $this, 'select_populate' ), //Callback
            'narcissus-setting-admin', //Page
            'general_theme_settings', //Section
            array( 'id' => 'credit_link',
                   'options' => 'narcissus_theme_options' )    
        );
        
        add_settings_field(
            'custom_sidebar',
            'Choose sidebar layout',
            array($this, 'select_populate'),
            'narcissus-setting-admin',
            'general_theme_settings',
            array( 'id' => 'custom_sidebar', //id
                   'options' => 'narcissus_theme_options' ) //theme options
       
        );
    }

    /**
     *  Sanitize each field
     *
     *  @param array $input Contains all fields as array keys
     */
    public function sanitize( $input ) {
    $new_input = array();
    foreach ( $input as $option_key=>$option_value) {
        if (isset($option_key ) && in_array($option_value, $this->arguments[$option_key]) )
            $new_input[$option_key] = $input[$option_key];
        else
            $new_input[$option_key] = $this->arguments[$option_key][0];
    }

    return $new_input;
    }
     
    /**
     *  Settings Section Callback
     */
    public function print_section_info() {
        echo "Here you can customize the theme to fit your needs.";
    }

    /**
     *  Populate select options in <select> tags
     */
    public function select_populate( $input ) {
        $args = $this->arguments[$input['id']];
        $options = get_option( $input['options']);

        printf('<select id="%2$s[%1$s]" name="%2$s[%1$s]">', $input['id'], $input['options'] ); 
        
        for( $i = 0; $i < sizeof($args); $i++ ) {
            $selected = selected($options[$input['id']], $args[$i]);
            printf('<option value="%s" %s >%s</option>', $args[$i], $selected, ucfirst($args[$i]) );
        }

        echo "</select>";
    }

}

if( is_admin())
    $my_settings_page = new Narcissus_Settings();
    
?>
