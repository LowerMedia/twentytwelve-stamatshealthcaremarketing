<?php

/*
#
#   ADD PRODUCTS CONTENT TYPE (CUSTOM POST TYPE)
#
*/

// function products_custom_init() {
//   $labels = array(
//     'name' => 'products',
//     'singular_name' => 'product',
//     'add_new' => 'Add product',
//     'add_new_item' => 'Add New product',
//     'edit_item' => 'Edit product',
//     'new_item' => 'New product',
//     'all_items' => 'All products',
//     'view_item' => 'View product',
//     'search_items' => 'Search products',
//     'not_found' =>  'No products found',
//     'not_found_in_trash' => 'No products found in Trash', 
//     'parent_item_colon' => '',
//     'menu_name' => 'products'
//   );

//   $args = array(
//     'labels' => $labels,
//     'description'   => 'Canna Delivery product',
//     'menu_position' => 1,
//     'public' => true,
//     'publicly_queryable' => true,
//     'show_ui' => true, 
//     'show_in_menu' => true, 
//     'query_var' => true,
//     'rewrite' => array( 'slug' => 'canna-delivery-products' ),
//     'capability_type' => 'post',
//     'has_archive' => true, 
//     'hierarchical' => false,
//     'menu_position' => null,
//     'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
//     'taxonomies' => array('category', 'post_tag')
//   ); 

//   register_post_type( 'products', $args );
// }
// add_action( 'init', 'products_custom_init' );

/*
#
#   BACKGROUND IMAGE JS REGISTER AND FUNCTION
#
*/

function lowermedia_sfsb_load_admin_scripts( $hook ) {
    if( 'appearance_page_full-screen-background' !== $hook )
        return;

    wp_enqueue_media();
    wp_enqueue_script( 'fsb-scripts', get_template_directory_uri(). 'fsb-scripts.js', array( 'jquery', 'media-upload', 'thickbox' ), filemtime( get_template_directory_uri() . 'fsb-scripts.js' ) );
}
add_action( 'admin_enqueue_scripts', 'lowermedia_sfsb_load_admin_scripts' );

function lowermedia_fsb_display_image() {
    $sfsb_options = get_option('fsb_settings');
    //global $sfsb_options;

    if ( isset( $sfsb_options['image'] ) ) {
        $image = $sfsb_options['image'];
        if( is_ssl() ) {
            $image = str_replace( 'http://', 'https://', $image );
        }
        
        /*HOME PAGE*/
        if( is_front_page() ) {
            //echo '<img src="' . esc_url( $image ) . '" id="fsb_image"/>';
        }

        /*ABOUT PAGE*/
        if( is_page( 35 ) ) {
            echo '<img src="' . esc_url( "http://stamatshealthcaremarketing.petelower.com/wp-content/uploads/2014/08/background-maroon.jpg" ) . '" id="fsb_image"/>';
        }

        /*CLIENTS PAGE*/
        if( is_page( 36 ) ) {
            echo '<img src="' . esc_url( "http://stamatshealthcaremarketing.petelower.com/wp-content/uploads/2014/08/background-salmon.jpg" ) . '" id="fsb_image"/>';
        }

        /*SERVICES PAGE*/
        if( is_page( 37 ) ) {
            echo '<img src="' . esc_url( "http://stamatshealthcaremarketing.petelower.com/wp-content/uploads/2014/08/background-pink.jpg" ) . '" id="fsb_image"/>';
        }

        /*PARTNERS PAGE*/
        if( is_page( 38 ) ) {
            echo '<img src="' . esc_url( "http://stamatshealthcaremarketing.petelower.com/wp-content/uploads/2014/08/background-peach.jpg" ) . '" id="fsb_image"/>';
        }

        /*BLOG PAGE*/
        if( is_home() ) {
            echo '<img src="' . esc_url( "http://stamatshealthcaremarketing.petelower.com/wp-content/uploads/2014/08/background-blue.jpg" ) . '" id="fsb_image"/>';
        }

    }
}
add_action( 'wp_footer', 'lowermedia_fsb_display_image' );

/*
#
#   REGISTER JS
#
*/

function lowermedia_scripts() {
    wp_enqueue_script( 'background-image-responsive', get_stylesheet_directory_uri() . 'background-image-responsive.js', array(), '1.0.0', true );
    //     wp_enqueue_script(
    //     'map-data',
    //     get_stylesheet_directory_uri() . '/mapdata.js',
    //     array( 'jquery' )
    // );
}

add_action( 'wp_enqueue_scripts', 'lowermedia_scripts' );

function lowermedia_enqueue_parent_style() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'lowermedia_enqueue_parent_style' );

// function lowermedia_enqueue_child_style() {
//     wp_enqueue_style( 'child-style', get_stylesheet_uri() );
// }
//add_action( 'wp_enqueue_scripts', 'lowermedia_enqueue_child_style', 11 );



/*
#
#   Make Archives.php Include Custom Post Types
#   http://css-tricks.com/snippets/wordpress/make-archives-php-include-custom-post-types/
#
*/

function namespace_add_custom_types( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'products'
        ));
      return $query;
    }
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );

// Define what post types to search
function searchAll( $query ) {
    if ( $query->is_search ) {
        $query->set( 'post_type', array( 'post', 'page', 'feed', 'products', 'people'));
    }
    return $query;
}

// The hook needed to search ALL content
add_filter( 'the_search_query', 'searchAll' );

function format_phonenumber( $arg ) {
    $data = '+'.$arg;
    if(  preg_match( '/^\+\d(\d{3})(\d{3})(\d{4})$/', $data,  $matches ) )
    {
        $result = $matches[1] . '-' .$matches[2] . '-' . $matches[3];
        return $result;
    }

}

// Add [phonenumber] shortcode
function phonenumber_shortcode( $atts ){
    //retrieve phone number from database
    $lm_array = get_option('lowermedia_phone_number');

    //check if user is on mobile if so make the number a link
    if (wp_is_mobile())
    {
        return '<a href="tel:+'.$lm_array["id_number"].'">'.format_phonenumber($lm_array["id_number"]).'</a>';
    } else {
        return format_phonenumber($lm_array["id_number"]);
    }
}
add_shortcode( 'phonenumber', 'phonenumber_shortcode' );


class lowermedia_phonenumber_settings
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'Phone Number', 
            'manage_options', 
            'lowermedia-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'lowermedia_phone_number' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>Canna Delivery Hotline</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'lowermedia_phone_options' );   
                do_settings_sections( 'lowermedia-setting-admin' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'lowermedia_phone_options', // Option group
            'lowermedia_phone_number', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'My Custom Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'lowermedia-setting-admin' // Page
        );  

        add_settings_field(
            'id_number', // ID
            'ID Number', // Title 
            array( $this, 'id_number_callback' ), // Callback
            'lowermedia-setting-admin', // Page
            'setting_section_id' // Section           
        );      
   
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['id_number'] ) )
            $new_input['id_number'] = absint( $input['id_number'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function id_number_callback()
    {
        printf(
            '<input type="text" id="id_number" name="lowermedia_phone_number[id_number]" value="%s" />',
            isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
        );
    }

}

if( is_admin() )
    $lowermedia_phonenumber_settings = new lowermedia_phonenumber_settings();