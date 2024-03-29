<?php

class Enterpay_LaskuYritykselle_Block_Adminhtml_Sales_Totals
    extends Mage_Adminhtml_Block_Sales_Totals
{

    /**
     *   Initialize order totals array
     * @return Mage_Sales_Block_Order_Totals
     */

    protected function _initTotals() {

        parent::_initTotals();

        $source = $this->getSource();

        /**
         *   Add payment charge to totals.
         */

        $totals = $this->_totals;
        $newTotals = array();

        if (count($totals) > 0) {

            foreach ($totals as $index => $arr) {

                if ($index == "grand_total") {

                    if (((float)$source->getPaymentCharge()) != 0) {
                        $newTotals['payment_charge'] = new Varien_Object(array(
                                'code' => 'payment_charge',
                                'field' => 'payment_charge',
                                'value' => $source->getPaymentCharge(),
                                'label' => $this->__('Payment Charge')
                            )
                        );
                    }

                }

                $newTotals[$index] = $arr;

            }

            $this->_totals = $newTotals;

        }

        return $this;

    }

}
