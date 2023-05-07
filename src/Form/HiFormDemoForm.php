<?php

namespace Drupal\hi_form_demo\Form;

use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class HiFormDemoForm extends FormBase
{

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'hi_form_demo_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#required' => TRUE,
    ];
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
    ];
    $form['phone'] = [
      '#type' => 'tel',
      '#title' => $this->t('Phone'),
      '#required' => TRUE,
    ];
    $form['message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Message'),
      '#required' => TRUE,
    ];
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#button_type' => 'primary',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    if (strlen($form_state->getValue('phone')) < 10) {
      $form_state->setErrorByName('phone', $this->t('Phone number is too short.'));
    }
    if (strlen($form_state->getValue('phone')) > 10) {
      $form_state->setErrorByName('phone', $this->t('Phone number is too long.'));
    }
    if (!is_numeric($form_state->getValue('phone'))) {
      $form_state->setErrorByName('phone', $this->t('Phone number is not numeric.'));
    }
    if (!filter_var($form_state->getValue('email'), FILTER_VALIDATE_EMAIL)) {
      $form_state->setErrorByName('email', $this->t('Email is not valid.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {

    $name = $form_state->getValue('name');
    $email = $form_state->getValue('email');
    $phone = $form_state->getValue('phone');
    $message = $form_state->getValue('message');

    $db = Database::getConnection();

    $db->insert('hi_form_demo')
      ->fields([
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'message' => $message,
      ])
      ->execute();

    $this->messenger()->addMessage($this->t('Your form has been submitted successfully.'));
  }
}
