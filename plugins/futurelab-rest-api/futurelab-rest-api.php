<?php
/**
 * Plugin Name: FutureLab Rest Api Plugin
 *
 */

add_action('rest_api_init', function ()
{
    	//route for all centres
	register_rest_route('labtests/v1', '/centres/', ['methods' => 'GET', 'callback' => 'get_centres', 'permission_callback' => '__return_true']);
	
	//route by slug
    	register_rest_route('labtests/v1', '/centres/(?P<slug>[a-zA-Z0-9-]+)', ['methods' => 'GET', 'callback' => 'get_centres', 'permission_callback' => '__return_true']);

});

function get_centres()
{
    $args = ['post_type' => 'centres'];
    $posts = get_posts($args);

    $data = [];
    $i = 0;

    foreach ($posts as $post)
    {
        $data[$i]['id'] = $post->ID;
        $data[$i]['title'] = $post->post_title;
        $data[$i]['slug'] = $post->post_name;
        $data[$i] = get_post_meta($post->ID);
	$i++;
    }
    return $data;
}

?>
