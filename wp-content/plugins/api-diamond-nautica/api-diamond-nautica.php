<?php
/**
 * Plugin Name: Cria rotas API
 * Plugin URI: https://diamondnautica.com.br
 * Description: Plugin com composer para gerar rotas API
 * Version: 1.0.0
 * Author: Alexandre Campos Gonçalves
 * Author URI: https://www.linkedin.com/in/alexandrecgoncalves/
 * License: GPL2
 * Text Domain: rotas.api
 */

 /**
 * This is our callback function that embeds our phrase in a WP_REST_Response
 */
function respond_message() {
	// rest_ensure_response() wraps the data we want to return into a WP_REST_Response, and ensures it will be properly returned.
  // $args = array(
  //   'author' => 1
  // );
    
  $args = array(
    'post_type'  => 'product',
    'orderby'    => 'rand',
    'meta_key'           => '_regular_price',
    'meta_value'         => ''
  );

  $find_products = get_posts($args);

  $baseURL = "https://diamondnautica.com.br/wp-json/wc/v3/products/?";
  $ck = "consumer_key=ck_d159e00be043ff8e03be19ff100e8e8805f4e360";
  $cs = "&consumer_secret=cs_0ffdecbb53ff66eb19779089cb3850546739a14d";

  $data = $baseURL.$ck.$cs;
  
  $ch = curl_init($data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $data = json_decode(curl_exec($ch));

  // var_dump($data);

  // $data = [];
  // $i = 0;
  // $simple_price = 0;

  // foreach ( $find_products as $simple_product ) {

  //   $data[$i]['id']                           = $simple_product->ID;
  //   $data[$i]['title']                        = $simple_product->post_title;
  //   // $data[$i]['content']                      = $simple_product->post_content;
  //   // $data[$i]['slug']                         = $simple_product->post_name;
  //   $data[$i]['featured_image']['thumbnail']  = get_the_post_thumbnail_url ( $simple_product->ID, 'thumbnail');

  //   foreach ( $simple_product as $simple_price ) {
  //   }
    
  //   $data[$i]['price']                = $simple_product->meta_value;

  //   $i++;
  // }

  if (empty($data)) {
    return new WP_Error( 'Empty_Category', 'There are no posts to display', array('status' => 404) );
  }

  return $data;

	// return rest_ensure_response( 'Iniciando testes com API! Diamond Náutica!' );
}

/**
* This function is where we register our routes for our example endpoint.
*/
function prefix_register_respond_message() {
	// register_rest_route() handles more arguments but we are going to stick to the basics for now.
	register_rest_route( 'api-diamond-nautica/v1', '/respond-message', array(
			// By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
			'methods'  => WP_REST_Server::READABLE,
			// Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
			'callback' => 'respond_message',
	) );
}

add_action( 'rest_api_init', 'prefix_register_respond_message' );