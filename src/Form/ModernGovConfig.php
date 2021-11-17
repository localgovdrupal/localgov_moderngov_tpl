<?php

declare (strict_types = 1);

namespace Drupal\localgov_moderngov_tpl\Form;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\State\StateInterface;
use Drupal\localgov_moderngov_tpl\Constants;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Configuration settings for the ModernGov template.
 */
class ModernGovConfig extends ConfigFormBase implements ContainerInjectionInterface {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'moderngov_config';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $tpl_nid = $this->state->get(Constants::TPL_NID_STATE);

    $form['moderngov_template_page_nid'] = [
      '#type' => 'number',
      '#title' => $this->t('Node id:'),
      '#description' => $this->t('ModernGov template page node id.'),
      '#default_value' => $tpl_nid,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $this->state
      ->set(Constants::TPL_NID_STATE, $form_state->getValue('moderngov_template_page_nid'));

    parent::submitForm($form, $form_state);
  }

  /**
   * Keeps track of the state service.
   */
  public function __construct(StateInterface $state) {

    $this->state = $state;
  }

  /**
   * Factory method.
   */
  public static function create(ContainerInterface $container) {

    return new static($container->get('state'));
  }

  /**
   * State service.
   *
   * @var Drupal\Core\State\StateInterface
   */
  protected $state;

}
