<?php
namespace Drupal\qed_city_migration\Plugin\migrate\process;

use Drupal\migrate\Plugin\MigrateProcessInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Row;

/**
 * Converts an array or separate doubles into a comma-separated string.
 *
 * @MigrateProcessPlugin(
 *   id = "array_to_string"
 * )
 */
class ArrayToString extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {

    // Fetch the "loc" field from the source.
    $location = $row->getSourceProperty('loc');

    // Validate if the value is an array and contains exactly two elements.
     if (is_array($location) && count($location) === 2) {
      // Convert the array to a comma-separated string.
      return implode(', ', $location);
    }
     // Log a warning if the value is not as expected.
    \Drupal::logger('qed_city_migration')->warning(
      'Invalid location value: @value. Expected an array with two elements.',
      ['@value' => print_r($location, TRUE)]
    );
    
    return NULL;
  }
}
