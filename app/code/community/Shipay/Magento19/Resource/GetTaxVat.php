<?php

class Shipay_Magento19_Resource_GetTaxVat {

  /**
   * Function to get tax vat
   * @param array $data
   * @param string $customerId
   * @return string 
   */
  public function getTaxVat($data, $customerId): string {
    $storeId = Mage::app()->getStore()->getStoreId();
    $taxDocument = Mage::getStoreConfig('payment/shipay_payments/capture_tax', $storeId);
    if ($taxDocument) {
      $document = $data['client_document'];
      return $this->normalizeDocument($document);
    } else {
      $customer = Mage::getModel('customer/customer')->load($customerId);
      $document = $customer->getData('taxvat');
      return $this->normalizeDocument($document);
    }
  }

  /**
   * Function to normalize document
   * @param string $document
   * @return string
   */
  protected function normalizeDocument($document): string {
    return strtoupper(preg_replace('/[^A-Z0-9]/i', '', $document));
  }
}
