<?php

namespace Drupal\frontkom_test\Access;

use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\node\Entity\Node;

class EditPageAccessCheck implements AccessInterface{

  public function access(AccountInterface $account, Node $node) {

    if($node->getType() !== 'page') {
      return AccessResult::allowed();
    }

    $registeredEditorsId = [$node->getOwnerId()];

    foreach ($node->field_editors->getValue() as $itemReference) {
      if(isset($itemReference['target_id']) && !in_array($itemReference['target_id'], $registeredEditorsId)) {
        array_push($registeredEditorsId, $itemReference['target_id']);
      }
    }

    if(!in_array($account->id(), $registeredEditorsId)) {
      return AccessResult::forbidden('Idi v zopu');
    }

    return AccessResult::allowed();
  }
}