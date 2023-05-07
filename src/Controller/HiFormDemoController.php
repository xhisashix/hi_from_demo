<?php

namespace Drupal\hi_form_demo\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class HiFormDemoController.
 */
class HiFormDemoController extends ControllerBase
{

  /**
   * Index.
   *
   * @return array
   *  Return Hello string.
   */
  public function index()
  {
    $form = \Drupal::formBuilder()->getForm('Drupal\hi_form_demo\Form\HiFormDemoForm');
    return $form;
  }
}
