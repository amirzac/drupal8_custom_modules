<?php

namespace Drupal\frontkom_test\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\block\Entity\Block;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\node\NodeInterface;

/**
 * Provides a 'EditorsBlock' block.
 *
 * @Block(
 *  id = "authorized_editors",
 *  admin_label = @Translation("Authorized editors"),
 * )
 */
class EditorsBlock extends BlockBase implements BlockPluginInterface {

  /**
   * @var NodeInterface
   */
  private $node;

  /**
   * @var array
   */
  private $allowedNodeTypes = [
    'page'
  ];

  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->initializeNode();
  }

  /**
   *
   * {@inheritdoc}
   */
  public function build() {

    $build['content'] = [
      '#theme' => 'editors-block',
      '#editors' => $this->node->field_editors->referencedEntities() ?? [],
    ];
    return $build;
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIf($account->isAuthenticated() && !is_null($this->node));
  }

  private function initializeNode():bool
  {
    $config = $this->getConfiguration();

//    dd($config['node']);

    if(isset($config['node']) && !empty($config['node'])) {
      $this->node = $config['node'];

      return TRUE;
    }

    $tempNode = \Drupal::routeMatch()->getParameter('node');

    try {
      if($this->nodeIsValid($tempNode)) {
        $this->node = $tempNode;

        return TRUE;
      }

      return FALSE;
    } catch (\Exception | \TypeError $e) {
      return FALSE;
    }
  }

  private function nodeIsValid(NodeInterface $node):bool {
    return in_array($node->getType(), $this->allowedNodeTypes);
  }
}
