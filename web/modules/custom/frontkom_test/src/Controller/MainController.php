<?php

namespace Drupal\frontkom_test\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MainController
 *
 * @package Drupal\frontkom_test\Controller
 */
class MainController extends ControllerBase{

  public function test() {
    return new Response('frontkom test');
  }

  public function authorizedEditors()
  {
    http_response_code(403);

    $block_manager = \Drupal::service('plugin.manager.block');
    $plugin_block = $block_manager->createInstance('authorized_editors');

    return $plugin_block->build();
  }
}