<?php

namespace Drupal\frontkom_test\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\block\Entity\Block;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\node\NodeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Provides a 'EditorsBlock' block.
 *
 * @Block(
 *  id = "authorized_editors",
 *  admin_label = @Translation("Authorized editors"),
 * )
 */
class EditorsBlock extends BlockBase implements BlockPluginInterface, ContainerFactoryPluginInterface {

  /**
   * @var NodeInterface
   */
  private $node;

  /**
   * @var RequestStack
   */
  private $requestStack;

  /**
   * @var array
   */
  private $allowedNodeTypes = [
    'page'
  ];

  public function __construct(array $configuration, $plugin_id, $plugin_definition, RequestStack $request) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->requestStack = $request;
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
    $tempNode = $this->requestStack->getCurrentRequest()->get('node');

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

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('request_stack')
    );
  }
}
