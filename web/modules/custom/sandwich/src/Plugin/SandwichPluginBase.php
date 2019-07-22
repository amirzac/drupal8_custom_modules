<?php

namespace Drupal\sandwich\Plugin;

use Drupal\Component\Plugin\PluginBase;

/**
 * Base class for Sandwich plugin plugins.
 */
abstract class SandwichPluginBase extends PluginBase implements SandwichPluginInterface {


  public function getDescription()
  {
      return $this->pluginDefinition['description'];
  }

  public function getCalories()
  {
      return (float) $this->pluginDefinition['calories'];
  }

  abstract public function order(array $extras);
}
