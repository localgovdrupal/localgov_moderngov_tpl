<?php

declare(strict_types = 1);

namespace Drupal\localgov_moderngov_tpl;

use Drupal\Core\File\FileUrlGeneratorInterface;
use Drupal\Core\Url;

/**
 * Rewrites relative path to absolute path.
 *
 * On the ModernGov template page, all URLs should be absolute.
 */
class FileUrlGeneratorDecorator implements FileUrlGeneratorInterface {

  /**
   * {@inheritdoc}
   *
   * When on the ModernGov tpl page, generates absolute URLs even for relative
   * URL generation requests.
   */
  public function generateString(string $uri) :string {

    if ($this->modernGovPathPredicate->isModernGovTplPage()) {
      return $this->fileUrlGenerator->generateAbsoluteString($uri);
    }
    else {
      return $this->fileUrlGenerator->generateString($uri);
    }
  }

  /**
   * {@inheritdoc}
   *
   * Pipes to decorated method.
   */
  public function generateAbsoluteString(string $uri) :string {
    return $this->fileUrlGenerator->generateAbsoluteString($uri);
  }

  /**
   * {@inheritdoc}
   *
   * Pipes to decorated method.
   */
  public function generate(string $uri) :Url {
    return $this->fileUrlGenerator->generator($uri);
  }

  /**
   * {@inheritdoc}
   *
   * Pipes to decorated method.
   */
  public function transformRelative(string $file_url, bool $root_relative = TRUE) :string {
    return $this->fileUrlGenerator->transformRelative($file_url, $root_relative);
  }

  /**
   * Keeps track of dependencies.
   */
  public function __construct(FileUrlGeneratorInterface $file_url_generator, ModernGovPathPredicate $moderngov_path_predicate) {

    $this->fileUrlGenerator = $file_url_generator;
    $this->modernGovPathPredicate = $moderngov_path_predicate;
  }

  /**
   * Original file_url_generator service.
   *
   * @var Drupal\Core\File\FileUrlGeneratorInterface
   */
  protected $fileUrlGenerator;

  /**
   * Service to determine if we are on the ModernGov path.
   *
   * @var Drupal\localgov_moderngov_tpl\ModernGovPathPredicate
   */
  protected $modernGovPathPredicate;

}
