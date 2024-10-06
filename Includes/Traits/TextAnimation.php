<?php

namespace GpTheme\GptNewsCore\Traits;

use Elementor\Controls_Manager;

trait TextAnimation {

	/**
	 * Text Animation
	 *
	 * @param string $prefix
	 */
	public function textAnimation( $prefix ) {
		$this->add_control(
			$prefix . 'enable_animation', [
			'label'        => __( 'Enable Animation', 'gpt-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'gpt-core' ),
			'label_off'    => __( 'No', 'gpt-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		// Animation Style
		$this->add_control(
			$prefix . 'animation_style', [
			'label'     => __( 'Animation Style', 'gpt-core' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'one',
			'options'   => [
				'one'   => __( 'One', 'gpt-core' ),
				'two'   => __( 'Two', 'gpt-core' ),
				'three' => __( 'Three', 'gpt-core' ),
				'four'  => __( 'four', 'gpt-core' ),
				'five'  => __( 'five', 'gpt-core' ),
			],
			'condition' => [
				$prefix . 'enable_animation' => 'yes',
			],
		] );

		// perspective Switcher
		$this->add_control(
			$prefix . 'perspective', [
			'label'     => __( 'Perspective', 'gpt-core' ),
			'type'      => Controls_Manager::SWITCHER,
			'label_on'  => __( 'Yes', 'gpt-core' ),
			'label_off' => __( 'No', 'gpt-core' ),
			'default'   => 'yes',
			'condition' => [
				$prefix .'animation_style' => 'two',
			],
		] );

		// Animation Duration
		$this->add_control(
			$prefix . 'animation_duration', [
			'label'     => __( 'Animation Duration', 'gpt-core' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => 2,
			'step'      => 0.1,
			'min'       => 0.1,
			'condition' => [
				$prefix.'enable_animation' => 'yes',
			],
		] );

		// Animation Delay
		$this->add_control(
			$prefix . 'animation_delay', [
			'label'     => __( 'Animation Delay', 'gpt-core' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => 0.1,
			'step'      => 0.1,
			'min'       => 0.1,
			'condition' => [
				$prefix . 'enable_animation' => 'yes',
			],
		] );
	}

}