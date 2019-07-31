<?php

namespace Drupal\frontkom_test\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\node\Entity\NodeType;
use Symfony\Component\HttpFoundation\Response;

class MainController extends ControllerBase{

  public function test() {

    http_response_code(403);

    $node = Node::load(1);

    $block_manager = \Drupal::service('plugin.manager.block');

    $config = [
      'node' => $node
    ];

    $plugin_block = $block_manager->createInstance('authorized_editors', $config);
    $access_result = $plugin_block->access(\Drupal::currentUser());

    if (is_object($access_result) && $access_result->isForbidden() || is_bool($access_result) && !$access_result) {
      return [];
    }

    $render = $plugin_block->build();


    return $render;
  }
}