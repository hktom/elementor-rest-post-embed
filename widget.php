<?php
namespace Elementor_Rest_Post_Embed;

use Elementor\Repeater;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

include plugin_dir_path( __FILE__ ) . '/grid/post_listing.php';

class Elementor_Rest_Post_Embed extends Widget_Base {

	public static $slug = "elementor_rest_post_embed";

	public function get_name() { return self::$slug; }

	public function get_title() { return __('Elementor Rest Post Embed', self::$slug); }

	public function get_icon() { return 'fas fa-grip-horizontal'; }

	public function get_categories() { return [ 'general' ]; }

	protected function _register_controls() {

		$this->start_controls_section(
			'api',
			[
				'label' => __( 'Api configuration', self::$slug ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'site_url_fr',
			[
				'label' => __( 'API Url FR', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'placeholder' => __( "website site api url", 'self::$slug' ),
			]
		);
		
		$this->add_control(
			'site_url_en',
			[
				'label' => __( 'API Url EN', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'placeholder' => __( "website site api url", 'self::$slug' ),
			]
        );
        
        $this->add_control(
			'total_post',
			[
				'label' => __( 'Total Post', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
			]
        );
        
        $this->add_control(
			'per_ligne',
			[
				'label' => __( 'Per Ligne', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
				'max' => 12,
				'step' => 1,
				'default' => 3,
			]
		);

        $this->end_controls_section();

        // Start typography
        $this->start_controls_section(
			'font',
			[
				'label' => __( 'Font', self::$slug ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_font',
				'label' => __( 'Title Typography', 'self::$slug' ),
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .post-title-font',
			]
        );
        
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_font',
				'label' => __( 'Descritpion Typography', 'self::$slug' ),
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .post-description-font',
			]
        );
        
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'meta_font',
				'label' => __( 'Meta Typography', 'self::$slug' ),
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .post-meta-font',
			]
        );
        
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'buton_font',
				'label' => __( 'Buton Typography', 'self::$slug' ),
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .post-button-font',
			]
		);
        
        $this->end_controls_section();

        // Color style
        
        $this->start_controls_section(
			'style',
			[
				'label' => __( 'Color', self::$slug ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'text',
                'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .post-bg-color' => 'background-color: {{VALUE}}',
				],
			]
        );


        $this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'text',
                'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .post-title-color' => 'color: {{VALUE}}',
				],
			]
        );

        $this->add_control(
			'description_color',
			[
				'label' => __( 'Description Color', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'text',
                'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .post-description-color' => 'color: {{VALUE}}',
				],
			]
        );

        $this->add_control(
			'metat_color',
			[
				'label' => __( 'Meta Color', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'text',
                'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .post-meta-color' => 'color: {{VALUE}}',
				],
			]
            );

            $this->add_control(
                'buton_back_color',
                [
                    'label' => __( 'Button Color', 'self::$slug' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'input_type' => 'text',
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .post-button-bg-color' => 'color: {{VALUE}}',
                    ],
                ]
                );

                $this->add_control(
                    'buton_text_color',
                    [
                        'label' => __( 'Button Text Color', 'self::$slug' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'input_type' => 'text',
                        'scheme' => [
                            'type' => \Elementor\Scheme_Color::get_type(),
                            'value' => \Elementor\Scheme_Color::COLOR_1,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .post-button-color' => 'color: {{VALUE}}',
                        ],
                    ]
                    );
        
        $this->end_controls_section();

        // Image Style
        $this->start_controls_section(
			'style_image',
			[
				'label' => __( 'Image', self::$slug ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'image_width',
			[
				'label' => __( 'Width', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .post-img-width' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
        );
        

        $this->add_control(
			'image_height',
			[
				'label' => __( 'Height', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .post-img-height' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
        );
        
        $this->add_control(
			'object_fit',
			[
				'label' => __( 'Object Fit', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'cover'  => __( 'Cover', 'self::$slug' ),
					'contain' => __( 'Contain', 'self::$slug' ),
					'fill' => __( 'Fill', 'self::$slug' ),
					'none' => __( 'None', 'self::$slug' ),
					
				],
			]
        );
        
        $this->add_control(
			'object_fit_position',
			[
				'label' => __( 'Object Fit Position', 'self::$slug' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'inherit',
				'options' => [
					'top' => __( 'Top', 'self::$slug' ),
					'bottom' => __( 'Bottom', 'self::$slug' ),
					'center'  => __( 'Center', 'self::$slug' ),
					'left' => __( 'Left', 'self::$slug' ),
					'rigth' => __( 'Right', 'self::$slug' ),
					'inherit' => __( 'Inherit', 'self::$slug' ),
					'initial' => __( 'Initial', 'self::$slug' ),
					'unset' => __( 'Unset', 'self::$slug' ),
					
				],
			]
		);

        $this->end_controls_section();
	
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        postListapi($settings);
	}
}