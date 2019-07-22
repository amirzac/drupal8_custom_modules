<?php

namespace Drupal\sandwich\Annotation;

use Drupal\Component\Annotation\Plugin;
use Drupal\Core\Annotation\Translation;

/**
 * Defines a Sandwich plugin item annotation object.
 *
 * @see \Drupal\sandwich\Plugin\SandwichPluginManager
 * @see plugin_api
 *
 * @Annotation
 */
class SandwichPlugin extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

    /**
     * A human readable description
     * @var Translation
     *
     * @ingroup plugin_translatable
     */
  public $description;

    /**
     * The number of calories per serving of this sandwich
     *
     * @var float
     */
  public $calories;
}
