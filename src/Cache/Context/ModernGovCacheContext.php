<?php

declare(strict_types = 1);

namespace Drupal\localgov_moderngov_tpl\Cache\Context;

use Drupal\Core\Cache\Context\CacheContextInterface;
use Drupal\localgov_moderngov_tpl\ModernGovPathPredicate;

/**
 * Defines the ModernGov path cache context.
 *
 * The cache context value is dependent on whether the current page is the
 * ModernGov template page or not.
 *
 * Cache context Id: is_moderngov_path
 * Cache context value: yes|no
 */
class ModernGovCacheContext implements CacheContextInterface {

  /**
   * {@inheritdoc}
   */
  public static function getLabel() {
    return t('ModernGov path');
  }

  /**
   * {@inheritdoc}
   */
  public function getContext() {

    return $this->modernGovPathPredicate->isModernGovTplPage() ? 'yes' : 'no';
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheableMetadata() {
    return new CacheableMetadata();
  }

  /**
   * Keeps track of dependencies.
   */
  public function __construct(ModernGovPathPredicate $moderngov_path_predicate) {

    $this->modernGovPathPredicate = $moderngov_path_predicate;
  }

  /**
   * Service to determine if we are on the ModernGov path.
   *
   * @var Drupal\localgov_moderngov_tpl\ModernGovPathPredicate
   */
  protected $modernGovPathPredicate;

}
