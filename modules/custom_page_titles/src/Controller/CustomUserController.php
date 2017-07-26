<?php

namespace Drupal\custom_page_titles\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller routines for user routes.
 */
class CustomUserController extends ControllerBase {

  public function userRegisterTitle() {
    return array( '#type' => 'markup', '#markup' => t('New Member Form'), );
  }

}

