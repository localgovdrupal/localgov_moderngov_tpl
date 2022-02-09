<?php

namespace Drupal\localgov_moderngov_tpl;

/**
 * Constants for this module.
 */
class Constants {

  /**
   * Twig template used for the ModernGov template page.
   */
  const PAGE_TPL_NAME = 'page__moderngov_template';

  /**
   * Class *attribute* for body tag of ModernGov template page.
   */
  const PAGE_BODY_CLASS = 'page--moderngov-template';

  /**
   * ModernGov template page's title.
   */
  const PAGE_TITLE = '{pagetitle}';

  /**
   * Key name used by the State API.
   */
  const PAGE_NID_STATE_API_KEY = 'localgov_moderngov_tpl.moderngov_template_page_nid';

}
