<?php

namespace Drupal\sandwich\Plugin;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Defines an interface for Sandwich plugin plugins.
 */
interface SandwichPluginInterface extends PluginInspectionInterface {

  public function getDescription();

  public function getCalories();

  public function order(array $extras);
}
