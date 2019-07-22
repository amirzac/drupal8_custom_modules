<?php

namespace Drupal\sandwich\Plugin;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Provides the Sandwich plugin plugin manager.
 */
class SandwichPluginManager extends DefaultPluginManager {


  /**
   * Constructs a new SandwichPluginManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/SandwichPlugin', $namespaces, $module_handler, 'Drupal\sandwich\Plugin\SandwichPluginInterface', 'Drupal\sandwich\Annotation\SandwichPlugin');

    $this->alterInfo('sandwich_sandwich_plugin_info');
    $this->setCacheBackend($cache_backend, 'sandwich_sandwich_plugin_plugins');
  }

}
