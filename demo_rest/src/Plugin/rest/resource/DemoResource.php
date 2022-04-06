<?php

namespace Drupal\demo_rest\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;


/**
 * @RestResource(
 *  id="demo_rest",
 *  label=@Translation("Demo Resource for REST"),
 *  uri_paths={
 *      "canonical"="/demo_rest/get_resource"
 *  }
 * )
 */
class DemoResource extends ResourceBase{

/**
   * Responds to entity GET requests.
   * @return \Drupal\rest\ResourceResponse
   */
    public function get(){
        $response = ["message"=>"Hello world its a get"];
        return new ResourceResponse($response);
    }

    public function post(){
        $response = "Hello world its a post";
        return new ResourceResponse($response);
    }

}