<?php

declare(strict_types = 1);

namespace Drupal\localgov_moderngov_tpl\PathProcessor;

use Drupal\Core\PathProcessor\OutboundPathProcessorInterface;
use Drupal\Core\Render\BubbleableMetadata;
use Symfony\Component\HttpFoundation\Request;
use Drupal\localgov_moderngov_tpl\ModernGovPathPredicate;

/**
 * Rewrites relative path to absolute path.
 *
 * On the ModernGov template page, all URLs should be absolute.
 */
class ModernGovAbsolutePathProcessor implements OutboundPathProcessorInterface {

  /**
   * {@inheritdoc}
   *
   * Opt for absolute path.
   */
  public function processOutbound($path, &$options = [], Request $request = NULL, BubbleableMetadata $bubbleable_metadata = NULL) {

    if ($this->modernGovPathPredicate->isModernGovTplPage()) {
      $options['absolute'] = TRUE;
    }

    return $path;
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
