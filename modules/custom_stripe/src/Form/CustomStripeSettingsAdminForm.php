<?php

namespace Drupal\custom_stripe\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Url;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\stripe_api\StripeApiService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class CustomStripeSettingsAdminForm.
 */
class CustomStripeSettingsAdminForm extends ConfigFormBase {

  /**
   * Constructs a \Drupal\system\ConfigFormBase object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The factory for configuration objects.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {

    parent::__construct($config_factory);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'custom_stripe_settings_admin_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'custom_stripe.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('custom_stripe.settings');
    
    $form['instructions'] = [
      '#type' => 'markup',
      '#markup' => '<p><strong>IMPORTANT:</strong> Enter a whole number for the number of cents. eg. enter 5000 for $50.00</p>'
    ];
    
    $form['single'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Single Membership')
    ];
    $form['single']['price_single'] = [
      '#type' => 'number',
      '#title' => $this->t('Single Membership Price'),
      '#default_value' => $config->get('price_single'),
    ];
    
    $form['corporate'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Corporate Membership')
    ];
    $form['corporate']['price_corporate'] = [
      '#type' => 'number',
      '#title' => $this->t('Corporate Membership Price'),
      '#default_value' => $config->get('price_corporate'),
    ];
    
    $form['associate'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Associate Membership')
    ];
    $form['associate']['price_associate_lt100'] = [
      '#type' => 'number',
      '#title' => $this->t('Associate ($100k or less) Membership Price'),
      '#default_value' => $config->get('price_associate_lt100'),
    ];
    $form['associate']['price_associate_lt250'] = [
      '#type' => 'number',
      '#title' => $this->t('Associate ($101k to $250k) Membership Price'),
      '#default_value' => $config->get('price_associate_lt250'),
    ];
    $form['associate']['price_associate_lt500'] = [
      '#type' => 'number',
      '#title' => $this->t('Associate ($251k to $500k) Membership Price'),
      '#default_value' => $config->get('price_associate_lt500'),
    ];
    $form['associate']['price_associate_lt1m'] = [
      '#type' => 'number',
      '#title' => $this->t('Associate ($501k to $1M) Membership Price'),
      '#default_value' => $config->get('price_associate_lt1m'),
    ];
    $form['associate']['price_associate_gt1m'] = [
      '#type' => 'number',
      '#title' => $this->t('Associate (Over $1M) Membership Price'),
      '#default_value' => $config->get('price_associate_gt1m'),
    ];
    
    $form['full'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Full Membership')
    ];
    $form['full']['price_full_lt100'] = [
      '#type' => 'number',
      '#title' => $this->t('Full Member ($100k or less) Membership Price'),
      '#default_value' => $config->get('price_full_lt100'),
    ];
    $form['full']['price_full_lt250'] = [
      '#type' => 'number',
      '#title' => $this->t('Full Member ($101k to $250k) Membership Price'),
      '#default_value' => $config->get('price_full_lt250'),
    ];
    $form['full']['price_full_lt500'] = [
      '#type' => 'number',
      '#title' => $this->t('Full Member ($251k to $500k) Membership Price'),
      '#default_value' => $config->get('price_full_lt500'),
    ];
    $form['full']['price_full_lt1m'] = [
      '#type' => 'number',
      '#title' => $this->t('Full Member ($501k to $1M) Membership Price'),
      '#default_value' => $config->get('price_full_lt1m'),
    ];
    $form['full']['price_full_gt1m'] = [
      '#type' => 'number',
      '#title' => $this->t('Full Member (Over $1M) Membership Price'),
      '#default_value' => $config->get('price_full_gt1m'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('custom_stripe.settings')
      ->set('price_single', $form_state->getValue('price_single'))
      ->set('price_corporate', $form_state->getValue('price_corporate'))
      ->set('price_associate_lt100', $form_state->getValue('price_associate_lt100'))
      ->set('price_associate_lt250', $form_state->getValue('price_associate_lt250'))
      ->set('price_associate_lt500', $form_state->getValue('price_associate_lt500'))
      ->set('price_associate_lt1m', $form_state->getValue('price_associate_lt1m'))
      ->set('price_associate_gt1m', $form_state->getValue('price_associate_gt1m'))
      ->set('price_full_lt100', $form_state->getValue('price_full_lt100'))
      ->set('price_full_lt250', $form_state->getValue('price_full_lt250'))
      ->set('price_full_lt500', $form_state->getValue('price_full_lt500'))
      ->set('price_full_lt1m', $form_state->getValue('price_full_lt1m'))
      ->set('price_full_gt1m', $form_state->getValue('price_full_gt1m'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
