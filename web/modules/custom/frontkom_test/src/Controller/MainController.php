<?php

namespace Drupal\frontkom_test\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityType;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\node\Entity\Node;
use Drupal\node\Entity\NodeType;

class MainController extends ControllerBase{

  public function test() {


    $pageNodeType = NodeType::load('page');


//    $pageNodeType->setThirdPartySetting()
    dd($pageNodeType);


  }
}