<?php

namespace Drupal\commerce_example1\Form;

use Drupal\commerce_order\Form\OrderItemInlineForm;

/**
 * Defines the inline form for order items.
 */
class CommerceExample1OrderItemInlineForm extends OrderItemInlineForm {

  /**
   * {@inheritdoc}
   */
  public function getTableFields($bundles) {
    $fields = parent::getTableFields($bundles);

    $fields['sku'] = [
      'type' => 'callback',
      'callback' => 'Drupal\commerce_example1\Form\CommerceExample1OrderItemInlineForm::getOrderItemSku',
      'label' => t('SKU'),
      'weight' => 2,
    ];

    $fields['unit_price']['weight'] = 3;
    $fields['quantity']['weight'] = 4;

    return $fields;
  }

  /**
   * Returns the SKU for the product referenced by an order item.
   */
  public function getOrderItemSku($entity, $variables) {
    // Extract the purchased entity from the order item.
    $purchased_entity = $entity->getPurchasedEntity();

    // If the purchased entity couldn't be loaded or doesn't have a SKU...
    if (!$purchased_entity || !$purchased_entity->hasField('sku')) {
      // Return a placeholder string.
      return '-';
    }
    else {
      // Otherwise, return the SKU itself.
      return $purchased_entity->getSku();
    }
  }
}
