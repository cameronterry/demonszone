<?php

function dz_customizer_register( $wp_customize ) {
  $wp_customize->add_section(
  	'demonszone',
  	array(
  		'title'       => 'DemonsZone Settings',
  		'priority'    => 100,
  		'capability'  => 'edit_theme_options',
  		'description' => '',
  	)
  );

  $wp_customize->add_setting( 'article_template_type' , array(
    'default'     => 'content-one',
    'transport'   => 'refresh',
  ) );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'article_template_type_control',
      array(
        'label' => 'Article Template',
        'section' => 'demonszone',
        'settings' => 'article_template_type',
        'type' => 'select',
        'choices' => array(
          'content-one' => 'Template One',
          'content-two' => 'Template Two',
          'content-two-admin' => 'Template Two (Admin Only)',
        )
      )
    )
  );
}
add_action( 'customize_register', 'dz_customizer_register' );
