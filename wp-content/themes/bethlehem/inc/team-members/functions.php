<?php
/**
 * General functions used to integrate this theme with Our Team.
 *
 * @package bethlehem
 */

if( ! function_exists( 'bethlehem_add_team_member_fields' ) ) {
    function bethlehem_add_team_member_fields( $fields ) {
        
        $fields['facebook'] = array(
            'name'            => __( 'Facebook Username', 'bethlehem' ),
            'description'     => __( 'Enter this team member\'s Facebook username (for example: woothemes).', 'bethlehem' ),
            'type'            => 'text',
            'default'         => '',
            'section'         => 'info'
        );
        
        $fields['skype'] = array(
            'name'            => __( 'Skype Username', 'bethlehem' ),
            'description'     => __( 'Enter this team member\'s Skype username (for example: woothemes).', 'bethlehem' ),
            'type'            => 'text',
            'default'         => '',
            'section'         => 'info'
        );

        return $fields;
    }
}

if( ! function_exists( 'bethlehem_add_team_member_excerpt_support' ) ) {
    function bethlehem_add_team_member_excerpt_support( $args ){
        $args['supports'] = array('title','author','editor','thumbnail','page-attributes','excerpt');
        return $args;
    }
}

if( ! function_exists( 'bethlehem_team_member_templates' ) ) {
    function bethlehem_team_member_templates( $template ) {
        $file = '';
        
        if ( is_single() && get_post_type() == 'team-member' ) {
            $file = locate_template('team-members/single-team-member.php');
        } elseif ( is_tax( get_object_taxonomies( 'team-member' ) ) ) {
            $file = locate_template('team-members/archive-team-member.php');
        } elseif ( is_post_type_archive( 'team-member' ) ) {
            $file = locate_template('team-members/archive-team-member.php');
        }
        
        if ( $file ) {
            $template = $file;
        }

        return $template;
    }
}