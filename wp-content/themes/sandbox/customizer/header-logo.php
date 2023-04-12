<?php 

// Fonction pour ajouter une section "Header Logo" dans le customizer
function ajout_customizer_section( $wp_customize ) {
  $wp_customize->add_section( 'header_logo_section' , array(
     'title'       => __( 'Header Logo', 'sandbox' ),
     'priority'    => 30,
     'description' => 'Ajouter le logo dans le header'
  ) );
}
add_action( 'customize_register', 'ajout_customizer_section' );

// Fonction pour ajouter les champs "Header Logo" dans le customizer
function ajout_customizer_champ( $wp_customize ) {
  $wp_customize->add_setting( 'header_logo' );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_logo', array(
     'label'    => __( 'Header Logo', 'sandbox' ),
     'section'  => 'header_logo_section',
     'settings' => 'header_logo',
  ) ) );
}
add_action( 'customize_register', 'ajout_customizer_champ' );