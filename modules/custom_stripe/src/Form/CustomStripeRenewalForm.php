<?php

namespace Drupal\custom_stripe\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\stripe_api\StripeApiService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\user\Entity\User;

/**
 * Class CustomStripeRenewalForm.
 */
class CustomStripeRenewalForm extends FormBase {

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
    return 'custom_stripe_renewal_form';
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
    $user = User::load(\Drupal::currentUser()->id());
    $currentExpiry = date("F jS, Y", strtotime($user->get('field_membership_expiry')->value));
    $stripe_api = \Drupal::service("stripe_api.stripe_api");
  	$pubkey = $stripe_api->getPubKey();
    $cost = $this->calculateCost();
    
    $form['instructions'] = [
      '#type' => 'markup',
      '#markup' => '<p>'.t('Current membership expiry:').' '.$currentExpiry.'</p><p>'.t('Annual membership fee:').' $'.number_format($cost/100, 2).'</p>'
    ];
    
    $form['stripe_token'] = [
      '#type' => 'hidden'
    ];
    
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Renew Membership'),
    ];
    
    $form['#attached']['library'][] = "custom_stripe/renewal";
    $form['#attached']['drupalSettings']['custom_stripe']['stripe_pub_key'] = $pubkey;
    $form['#attached']['drupalSettings']['custom_stripe']['renewal_price'] = $cost;
    $form['#attached']['drupalSettings']['custom_stripe']['user_email'] = $user->getEmail();

    return $form;
  }
  
  protected function calculateCost() {
    //get the membership type and operating budget from the current user
    $user = User::load(\Drupal::currentUser()->id());
    $membershipType = (int)$user->get('field_membership_type')->getValue()[0]['target_id'];
    $budget = $user->get('field_operating_budget')->value;

  	$config = \Drupal::config("custom_stripe.settings");
  	switch($membershipType) {
  		case 12:
  			return (int)$config->get("price_single");
  		case 13:
  			return (int)$config->get("price_corporate");
  		case 14:
  			return (int)$config->get("price_associate_".$budget);
  		case 15: 
  			return (int)$config->get("price_full_".$budget);
  	}
  }
  
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $token = $form_state->getValue('stripe_token');
    $amount = $this->calculateCost();
    //attempt to charge the card
  	$stripe_api = \Drupal::service('stripe_api.stripe_api');
  	try {
  		$charge = \Stripe\Charge::create(array('amount'=>$amount,'currency'=>'cad','source'=>$token));
  		//payment succeeded
  		//validation is completed without error
  	} catch(Exception $e) {
  		//payment failed
  		$form_state->setErrorByName('', t('There was an error processing your payment.'));
  	}
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    //extend the expiry date for the current user
    $user = User::load(\Drupal::currentUser()->id());
    $oldExpiry = $user->get("field_membership_expiry")->value;
    date_default_timezone_set("UTC");
    $newExpiry = date("Y-m-d\TH:i:s", strtotime("+1 year", strtotime($oldExpiry)));
    $user->set('field_membership_expiry', $newExpiry);
    $user->save();
    
    //notify the user with a success message and redirect to user page
    drupal_set_message(t('Your membership has been renewed for 1 year.'), 'status', TRUE);
    $form_state->setRedirect('user.page');
  }

}
