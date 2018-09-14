<?php

namespace Drupal\swisstopo\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'field_swisstopo' field type.
 *
 * @FieldType(
 *   id = "field_swisstopo",
 *   label = @Translation("Swisstopo Geofield"),
 *   module = "swisstopo",
 *   description = @Translation("Create the geofield for swisstopo based on swiss coordinates"),
 *   default_widget = "swisstopo_widget",
 *   default_formatter = "swisstopo_formatter"
 * )
 */
class SwisstopoItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $columns = [];

    $columns['x'] = [
      'type' => 'numeric',
      'size' => 'normal',
      'length' => 7,
    ];

    $columns['y'] = [
      'type' => 'numeric',
      'size' => 'normal',
      'length' => 7,
    ];

    $columns['zoom'] = [
      'type' => 'float',
    ];

    return [
      'columns' => $columns,
      'indexes' => [],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $lat = $this->get('x')->getValue();
    $lon = $this->get('y')->getValue();
    return $lat === NULL || $lat === '' || $lon === NULL || $lon === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['x'] = DataDefinition::create('integer')
      ->setLabel(t('Swiss Coordinates X'));

    $properties['y'] = DataDefinition::create('integer')
      ->setLabel(t('Swiss Coordinates Y'));

    $properties['zoom'] = DataDefinition::create('float')
      ->setLabel(t('Zoom Level'));

    return $properties;
  }

}
