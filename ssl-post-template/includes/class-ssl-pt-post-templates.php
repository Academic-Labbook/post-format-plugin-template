<?php

/**
 * Editor templates.
 *
 * @since      1.0.0
 *
 * @package    ssl-post-template
 * @subpackage ssl-post-template/includes
 */

/**
 * Post type templates.
 *
 * @package    ssl-post-template
 * @subpackage ssl-post-template/includes
 * @author     Sean Leavey <wordpress@attackllama.com>
 */
class Ssl_Post_Template_Post_Templates {
	/**
	 * The loader.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Ssl_Post_Template_Loader    $loader    The hook loader.
	 */
    protected $loader;
    
	/**
	 * Initialize post templates.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $loader ) {
        $this->loader = $loader;
	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function register_hooks() {
        $this->loader->add_action( 'init', $this, 'add_inventory_item_post_template', 9999 );
    }
    
    /**
     * Add inventory item post template.
     * 
     * @since    1.0.0
     */
    public function add_inventory_item_post_template() {
        $post_type_object = get_post_type_object( 'ssl-alp-inventory' );

        if ( is_null( $post_type_object ) ) {
            // Post type not registered.
            return;
        }

        // Add template.
        $post_type_object->template = array(
            array(
                'core/heading',
                array(
                    'level'   => 2,
                    'content' => 'Documentation',
                ),
            ),
            array(
                'core/heading',
                array(
                    'level'   => 3,
                    'content' => 'Schematic',
                ),
            ),
            array(
                'core/file',
                array(),
            ),
            array(
                'core/heading',
                array(
                    'level'   => 3,
                    'content' => 'Inputs and outputs',
                ),
            ),
            array(
                'core/paragraph',
                array(
                    'placeholder' => 'Describe the item\'s inputs and outputs. Useful information to include could be for example signal type (single ended, differential, floating, etc.), input or output impedance (zero, 50Ω, infinite, etc.), maximum input/output voltage, etc.',
                ),
            ),
            array(
                'core/heading',
                array(
                    'level'   => 2,
                    'content' => 'Location',
                ),
            ),
            array(
                'core/paragraph',
                array(
                    'placeholder' => 'Describe the item\'s location.',
                ),
            ),
            array(
                'core/heading',
                array(
                    'level'   => 2,
                    'content' => 'Notes',
                ),
            ),
            array(
                'core/paragraph',
                array(
                    'placeholder' => 'Add any other pertinent information such as links to relevant posts, observations of strange behaviour, etc.',
                ),
            ),
        );
    }
}
