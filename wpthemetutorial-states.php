<?php
/*
Plugin Name: WP Theme Tutorial - US States
Plugin URI: http://wpthemetutorial.com @todo put in the proper url
Description: Adds a taxonomy for US States and prepopulates it with the states
Version: 1.0
Author: WP Theme Tutorial, Curis McHale
Author URI: http://wpthemetutorial.com
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/**
 * Registers our custom taxonomies.
 *
 * @uses    register_taxonomy
 *
 * @since   1.0
 * @author  WP Theme Tutorial, Curtis McHale
 */
function theme_t_wp_custom_taxonomies() {

  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => _x( 'State', 'taxonomy general name' ),
    'singular_name'     => _x( 'States', 'taxonomy singular name' ),
    'search_items'      =>  __( 'Search State' ),
    'all_items'         => __( 'All States' ),
    'parent_item'       => __( 'Parent State' ),
    'parent_item_colon' => __( 'Parent State:' ),
    'edit_item'         => __( 'Edit State' ),
    'update_item'       => __( 'Update State' ),
    'add_new_item'      => __( 'Add New State' ),
    'new_item_name'     => __( 'New State Name' ),
    'menu_name'         => __( 'State' ),
  );

  register_taxonomy( 'theme_t_wp_us_state', array( 'post' ), array(
    'hierarchical' => true,
    'labels'       => $labels,
    'show_ui'      => true,
    'query_var'    => true,
    'rewrite'      => array( 'slug' => 'state' ),
  ));


}
add_action( 'init', 'theme_t_wp_custom_taxonomies');

/**
 * Setting the default terms for the custom taxonomies
 *
 * @uses    get_terms
 * @uses    wp_insert_term
 * @uses   	theme_t_wp_get_us_states
 * @uses   	term_exists
 *
 * @since   1.0
 * @author  WP Theme Tutorial, Curtis McHale
 */
function theme_t_wp_default_terms(){

		// see if we already have populated any terms
    $state = get_terms( 'theme_t_wp_us_state', array( 'hide_empty' => false ) );

    // if no terms then lets add our terms
    if( empty( $state ) ){
        $states = theme_t_wp_get_us_states();
        foreach( $states as $state ){
            if( !term_exists( $state['name'], 'theme_t_wp_us_state' ) ){
                wp_insert_term( $state['name'], 'theme_t_wp_us_state', array( 'slug' => $state['short'] ) );
            }
        }
    }

}
add_action( 'init', 'theme_t_wp_default_terms' );


/**
 * Returns an array of US states with name and proper short form
 *
 * @return 	array
 *
 * @since   1.0
 * @author 	WP Theme Tutorial, Curtis McHale
 */
function theme_t_wp_get_us_states(){

    $states = array(
        '0' => array( 'name' => 'Alaska', 'short' => 'AK' ),
        '1' => array( 'name' => 'American Samoa', 'short' => 'AS' ),
        '2' => array( 'name' => 'Arizona', 'short' => 'AZ' ),
        '3' => array( 'name' => 'Arkansas', 'short' => 'AR' ),
        '4' => array( 'name' => 'California', 'short' => 'CA' ),
        '5' => array( 'name' => 'Colorado', 'short' => 'CO' ),
        '6' => array( 'name' => 'Conneticut', 'short' => 'CT' ),
        '7' => array( 'name' => 'Delaware', 'short' => 'DE' ),
        '8' => array( 'name' => 'District of Columbia', 'short' => 'DC' ),
        '9' => array( 'name' => 'Federated States of Micronesia', 'short' => 'FM' ),
        '10' => array( 'name' => 'Florida', 'short' => 'FL' ),
        '11' => array( 'name' => 'Georgia', 'short' => 'GA' ),
        '12' => array( 'name' => 'Guam', 'short' => 'GU' ),
        '13' => array( 'name' => 'Hawaii', 'short' => 'HI' ),
        '14' => array( 'name' => 'Idaho', 'short' => 'ID' ),
        '15' => array( 'name' => 'Illinois', 'short' => 'IL' ),
        '16' => array( 'name' => 'Indiana', 'short' => 'IN' ),
        '17' => array( 'name' => 'Iowa', 'short' => 'IA' ),
        '18' => array( 'name' => 'Kansas', 'short' => 'KS' ),
        '19' => array( 'name' => 'Kentucky', 'short' => 'KY' ),
        '20' => array( 'name' => 'Louisiana', 'short' => 'LA' ),
        '21' => array( 'name' => 'Maine', 'short' => 'ME' ),
        '22' => array( 'name' => 'Marshall Islands', 'short' => 'MH' ),
        '23' => array( 'name' => 'Maryland', 'short' => 'MD' ),
        '24' => array( 'name' => 'Massachusetts', 'short' => 'MA' ),
        '25' => array( 'name' => 'Michigan', 'short' => 'MI' ),
        '26' => array( 'name' => 'Minnesota', 'short' => 'MN' ),
        '27' => array( 'name' => 'Mississippi', 'short' => 'MS' ),
        '28' => array( 'name' => 'Missouri', 'short' => 'MO' ),
        '29' => array( 'name' => 'Montana', 'short' => 'MT' ),
        '30' => array( 'name' => 'Nebraska', 'short' => 'NE' ),
        '31' => array( 'name' => 'Nevada', 'short' => 'NV' ),
        '32' => array( 'name' => 'New Hampshire', 'short' => 'NH' ),
        '33' => array( 'name' => 'New Jersey', 'short' => 'NJ' ),
        '34' => array( 'name' => 'New Mexico', 'short' => 'NM' ),
        '35' => array( 'name' => 'New York', 'short' => 'NY' ),
        '36' => array( 'name' => 'North Carolina', 'short' => 'NC' ),
        '37' => array( 'name' => 'North Dakota', 'short' => 'ND' ),
        '38' => array( 'name' => 'Northern Mariana Islands', 'short' => 'MP' ),
        '39' => array( 'name' => 'Ohio', 'short' => 'OH' ),
        '40' => array( 'name' => 'Oklahoma', 'short' => 'OK' ),
        '41' => array( 'name' => 'Oregon', 'short' => 'OR' ),
        '42' => array( 'name' => 'Palau', 'short' => 'PW' ),
        '43' => array( 'name' => 'Pennsylvania', 'short' => 'PA' ),
        '44' => array( 'name' => 'Puerto Rico', 'short' => 'PR' ),
        '45' => array( 'name' => 'Rhode Island', 'short' => 'RI' ),
        '46' => array( 'name' => 'South Carolina', 'short' => 'SC' ),
        '47' => array( 'name' => 'South Dakota', 'short' => 'SD' ),
        '48' => array( 'name' => 'Tennessee', 'short' => 'TN' ),
        '49' => array( 'name' => 'Texas', 'short' => 'TX' ),
        '50' => array( 'name' => 'Utah', 'short' => 'UT' ),
        '51' => array( 'name' => 'Vermont', 'short' => 'VT' ),
        '52' => array( 'name' => 'Virgin Islands', 'short' => 'VI' ),
        '53' => array( 'name' => 'Virginia', 'short' => 'VA' ),
        '54' => array( 'name' => 'Washington', 'short' => 'WA' ),
        '55' => array( 'name' => 'West Virginia', 'short' => 'WV' ),
        '56' => array( 'name' => 'Wisconsin', 'short' => 'WI' ),
        '57' => array( 'name' => 'Wyoming', 'short' => 'WY' ),
    );

    return $states;
}
