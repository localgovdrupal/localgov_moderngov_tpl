<?php

declare(strict_types = 1);

namespace Drupal\localgov_moderngov_tpl;

use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\State\StateInterface;

/**
 * Determines if the current page is the ModernGov template page.
 */
class ModernGovPathPredicate {

  /**
   * Are we on the ModernGov template page?
   */
  public function isModernGovTplPage() {

    $is_moderngov_tpl_page = &drupal_static(__METHOD__);
    if (isset($is_moderngov_tpl_page)) {
      return $is_moderngov_tpl_page;
    }

    $current_nid = $this->currentRouteMatch->getRawParameter('node');
    $moderngov_page_nid = $this->state->get(Constants::TPL_NID_STATE);

    $is_moderngov_tpl_page = ((int) $current_nid === (int) $moderngov_page_nid);
    return $is_moderngov_tpl_page;
  }

  /**
   * Keeps track of dependencies.
   */
  public function __construct(StateInterface $state, RouteMatchInterface $route_match) {

    $this->state = $state;
    $this->currentRouteMatch = $route_match;
  }

  /**
   * The config factory object.
   *
   * @var \Drupal\Core\State\StateInterface
   */
  protected $state;

  /**
   * The route match object for the current page.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $currentRouteMatch;

}
