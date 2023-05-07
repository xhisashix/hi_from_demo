<?php

namespace Drupal\hi_form_demo\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'HiFromDemoBlock' block.
 *
 * @Block(
 *  id = "hi_from_demo_block",
 *  admin_label = @Translation("Hi from demo block"),
 * )
 */

class HiFromDemoBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\hi_form_demo\Form\HiFormDemoForm');

    return $form;
  }

}
