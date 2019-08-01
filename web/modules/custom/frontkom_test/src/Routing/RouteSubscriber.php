<?php

namespace Drupal\frontkom_test\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class RouteSubscriber
 *
 * @package Drupal\frontkom_test\Routing
 */
class RouteSubscriber extends RouteSubscriberBase{

  /**
   * {@inheritdoc}
   */
  public function alterRoutes(RouteCollection $collection) {
    if ($route = $collection->get('entity.node.edit_form')) {

      //check permission
      $route->setRequirement('_custom_access', 'frontkom_test.access_edit_page_checker::access');

      //show 'Authorized Editors' block
      $route->setDefault('_controller', '\Drupal\frontkom_test\Controller\MainController::authorizedEditors');
    }
  }
}