<?php

declare(strict_types = 1);

namespace Drupal\Tests\localgov_moderngov_tpl\Functional;

use Drupal\Tests\BrowserTestBase;
use Drupal\Tests\node\Traits\NodeCreationTrait;
use Drupal\Tests\Traits\Core\PathAliasTestTrait;
use Drupal\localgov_moderngov_tpl\Constants;

/**
 * ModernGov template page examination.
 */
class PageTest extends BrowserTestBase {

  use NodeCreationTrait;
  use PathAliasTestTrait;

  /**
   * Validate a ModernGov template page.
   *
   * Things we are validating:
   * - Presence of the {content} and {breadcrumb} tokens.  We are skipping the
   *   {sidebar} token as the Stark theme has no sidebar.
   * - Absolute asset URLs.
   */
  public function testModernGovPage() {

    $this->drupalGet("modern-gov-template");
    $this->assertSession()->statusCodeEquals(200);

    // Validate presence of ModernGov tokens.
    $this->assertSession()->pageTextContains('{content}');
    $this->assertSession()->pageTextContains('{breadcrumb}');

    // Validate absolute asset URLs.  We are sampling the Favicon URL only.
    $favicon_link_element_list = $this->cssSelect('link[rel="shortcut icon"]');
    $favicon_link_element = current($favicon_link_element_list);

    $favicon_url = $favicon_link_element->getAttribute('href');
    $this->assertNotNull($favicon_url);

    $favicon_url_parts = parse_url($favicon_url);
    $favicon_url_has_hostname = array_key_exists('host', $favicon_url_parts);
    $favicon_url_is_absolute  = $favicon_url_has_hostname;
    $this->assertTrue($favicon_url_is_absolute);
  }

  /**
   * Sets up a node as the ModernGov template page.
   *
   * Path alias for ModernGov template page: /modern-gov-template .
   */
  protected function setUp() :void {

    parent::setUp();
    $this->createContentType(['type' => 'foo']);

    $a_new_node = $this->createNode(['type' => 'foo']);
    $new_nid    = $a_new_node->id();

    $this->createPathAlias("/node/$new_nid", '/modern-gov-template');

    // @see Drupal\localgov_moderngov_tpl\Form\ModernGovConfig::submitForm().
    \Drupal::service('state')->set(Constants::TPL_NID_STATE, $new_nid);
  }

  /**
   * Theme used during testing.
   *
   * @var string
   */
  protected $defaultTheme = 'stark';

  /**
   * Modules to enable.
   *
   * @var array
   */
  protected static $modules = [
    'node',
    'localgov_moderngov_tpl',
  ];

}
