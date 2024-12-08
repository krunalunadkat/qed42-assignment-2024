<?php
namespace Drupal\qed_entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Render\Markup;

/**
 * Provides a list controller for the city entity.
 *
 * @ingroup qed_entity
 */
class CityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function render() {

    // Attach the custom CSS library.
    $build['#attached']['library'][] = 'qed_entity/qed_entity_styles';

    // Description at the top of the table.

    $build['description'] = [
    '#markup' => '<div class="city-table-description">' . $this->t('Below is the list of migrated cities. You can add, edit, or delete city data.') . '</div>',
  ];
    $build['table'] = parent::render();
     // Wrap the table in a custom wrapper
     $build['table']['#prefix'] = '<div class="city-table">';
     $build['table']['#suffix'] = '</div>';
    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    return [
      'cityid' => $this->t('City ID'),
      'name' => $this->t('City Name'),
      'state' => $this->t('State'),
      'loc' => $this->t('Location'),
      'pop' => $this->t('Population'),
    ] + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
public function buildRow(EntityInterface $entity) {

  // Generate the view URL for the city entity.
  $view_url = $entity->toUrl('canonical', ['absolute' => TRUE])->toString();
  // Construct the row, with city name as a clickable link
  $row['cityid'] = $entity->cityid->value;
  //$row['name'] = $entity->name->value;
    $row['name'] = Markup::create('<a href="' . $view_url . '">' . $entity->name->value . '</a>');

  $row['state'] = $entity->state->value;
  $row['loc'] = $entity->loc->value;
  $row['pop'] = $entity->pop->value;

  return $row + parent::buildRow($entity);
}

}
