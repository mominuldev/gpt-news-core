<?php

namespace PixelPath\PPSPassportCore\Traits;

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
			'label'        => __( 'Enable Animation', 'pps-passport-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'pps-passport-core' ),
			'label_off'    => __( 'No', 'pps-passport-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		// Animation Style
		$this->add_control(
			$prefix . 'animation_style', [
			'label'     => __( 'Animation Style', 'pps-passport-core' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'one',
			'options'   => [
				'one'   => __( 'One', 'pps-passport-core' ),
				'two'   => __( 'Two', 'pps-passport-core' ),
				'three' => __( 'Three', 'pps-passport-core' ),
				'four'  => __( 'four', 'pps-passport-core' ),
				'five'  => __( 'five', 'pps-passport-core' ),
			],
			'condition' => [
				$prefix . 'enable_animation' => 'yes',
			],
		] );

		// perspective Switcher
		$this->add_control(
			$prefix . 'perspective', [
			'label'     => __( 'Perspective', 'pps-passport-core' ),
			'type'      => Controls_Manager::SWITCHER,
			'label_on'  => __( 'Yes', 'pps-passport-core' ),
			'label_off' => __( 'No', 'pps-passport-core' ),
			'default'   => 'yes',
			'condition' => [
				$prefix .'animation_style' => 'two',
			],
		] );

		// Animation Duration
		$this->add_control(
			$prefix . 'animation_duration', [
			'label'     => __( 'Animation Duration', 'pps-passport-core' ),
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
			'label'     => __( 'Animation Delay', 'pps-passport-core' ),
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