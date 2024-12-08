<?php

namespace Drupal\qed_entity\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Access controller for the city entity.
 */
class CityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   *
   * This method is called when determining the access for the operations.
   * Operations such as 'view', 'update', 'delete', etc., are linked to the
   * permissions defined in the routing file or other relevant configuration.
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    // Check if the current user has the admin permissions for this entity type.
    $admin_permission = $this->entityType->getAdminPermission();

    if ($account->hasPermission($admin_permission)) {
      // If the user has admin permissions, grant access.
      return AccessResult::allowed();
    }

    // Handle access control based on the operation being performed.
   switch ($operation) {
      case 'view':
        // Allow access if the user has the 'view city entity' permission.
        return AccessResult::allowedIfHasPermission($account, 'view city entity');

      case 'update':
        // Allow access if the user has the 'edit city entity' permission.
        return AccessResult::allowedIfHasPermission($account, 'edit city entity');

      case 'delete':
        // Allow access if the user has the 'delete city entity' permission.
        return AccessResult::allowedIfHasPermission($account, 'delete city entity');
    }

    // Return neutral access result if no conditions are met.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   *
   * Check create access for the entity. This is used when the entity is being
   * created but has not yet been saved.
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    // Check if the user has the admin permissions for creating this entity.
    $admin_permission = $this->entityType->getAdminPermission();

    if ($account->hasPermission($admin_permission)) {
      // Allow access if the user has the admin permissions.
      return AccessResult::allowed();
    }

    // Check if the user has permission to add the city entity.
    return AccessResult::allowedIfHasPermission($account, 'add city entity');
  }

}
