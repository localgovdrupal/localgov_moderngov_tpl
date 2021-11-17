<?php

declare(strict_types = 1);

namespace Drupal\localgov_moderngov_tpl\EventSubscriber;

use Drupal\localgov_moderngov_tpl\ModernGovPathPredicate;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Kernel request event processor.
 *
 * - Ensures absolute asset URLs on the ModernGov template page.
 */
class KernelRequestSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {

    return [
      // Runs before DynamicPageCacheSubscriber.
      KernelEvents::REQUEST => ['onRequest', 28],
    ];
  }

  /**
   * Ensures absolute asset URLs on the ModernGov template page.
   */
  public function onRequest(RequestEvent $event) {

    $is_moderngov_tpl_page = $this->modernGovPathPredicate->isModernGovTplPage();
    if ($is_moderngov_tpl_page) {
      static::nullifyFileUrlTransformRelative();
    }
  }

  /**
   * Deactivates file_url_transform_relative().
   *
   * Tells file_url_transform_relative() not to produce relative URLs.  This
   * happens when Symfony\Component\HttpFoundation\Request->getHost() is
   * different from $GLOBALS['base_url'].  To introduce this difference, we
   * insert an "@" sumbol before the hostname in all URLs.  This way,
   * "https://example.net/foo/bar.css" becomes
   * "https://@example.net/foo/bar.css".  This has the same effect but a
   * different base URL.
   *
   * Useful for generating absolute asset URLs in the ModernGov template page.
   *
   * @see file_url_transform_relative()
   * @see file_create_url()
   * @see Drupal\Core\StreamWrapper\baseUrl()
   */
  public static function nullifyFileUrlTransformRelative() {

    $base_url_with_at_sign = str_replace(
      ['https://', 'http://'],
      ['https://@', 'http://@'],
      $GLOBALS['base_url']);

    $GLOBALS['base_url'] = $base_url_with_at_sign;
  }

  /**
   * Keeps track of dependencies.
   */
  public function __construct(ModernGovPathPredicate $moderngov_path_predicate) {

    $this->modernGovPathPredicate = $moderngov_path_predicate;
  }

  /**
   * Are we on the ModernGov template page?
   *
   * @var Drupal\localgov_moderngov_tpl\ModernGovPathPredicate
   */
  protected $modernGovPathPredicate;

}
