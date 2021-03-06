<?php
namespace Drupal\custom_page_titles\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    if ($route = $collection->get('user.register')) {
      $route->setDefault('_title_callback','Drupal\custom_page_titles\Controller\CustomUserController::userRegisterTitle');
    }
  }

}
