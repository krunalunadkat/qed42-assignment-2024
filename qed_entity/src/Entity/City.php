<?php
namespace Drupal\qed_entity\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;
use Drupal\Core\Entity\EntityChangedTrait;

/**
 * Defines the City entity.
 *
 * @ingroup qed_entity
 *
 * @ContentEntityType(
 *   id = "qed_entity_city",
 *   label = @Translation("City Data"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\qed_entity\Controller\CityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\qed_entity\Form\CityForm",
 *       "edit" = "Drupal\qed_entity\Form\CityForm",
 *       "delete" = "Drupal\qed_entity\Form\CityDeleteForm",
 *     },
 *     "access" = "Drupal\qed_entity\Controller\CityAccessControlHandler",
 *   },
 *   list_cache_contexts = { "user" },
 *   base_table = "city",
 *   admin_permission = "administer qed_entity entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/qed-entity-city/{qed_entity_city}",
 *     "edit-form" = "/qed-entity-city/{qed_entity_city}/edit",
 *     "delete-form" = "/qed-entity-city/{qed_entity_city}/delete",
 *     "collection" = "/qed-entity-city/list"
 *   },
 *   field_ui_base_route = "qed_entity.city_settings",
 * )
 */
class City extends ContentEntityBase {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    // The ID field (standard integer field).
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('City ID'))
      ->setDescription(t('The ID of the City entity.'))
      ->setReadOnly(TRUE)
      ->setRequired(TRUE);

    // UUID field (standard UUID field for uniqueness).
    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the City entity.'))
      ->setReadOnly(TRUE)
      ->setRequired(TRUE);

    // City Name field.
    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('City Name'))
      ->setDescription(t('The name of the City.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue(NULL)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -6,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -6,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    // State field (location's state).
    $fields['state'] = BaseFieldDefinition::create('string')
      ->setLabel(t('State'))
      ->setDescription(t('State of the city.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue(NULL)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    // Location field (latitude/longitude).
    $fields['loc'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Location'))
      ->setDescription(t('Longitude and Latitude of the city.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue(NULL)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    // Population field.
    $fields['pop'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Population'))
      ->setDescription(t('Population of the city.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue(NULL)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'integer',
        'weight' => -3,
      ])
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => -3,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['cityid'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('City ID'))
      ->setDescription(t('The City ID details.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      // Set no default value.
      ->setDefaultValue(NULL)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'integer',
        'weight' => -7,
      ])
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => -7,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  
    // Created field (timestamp of creation).
    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    // Changed field (timestamp of last change).
    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }
}
