<?php
class CaeVecchi_EasyCheckoutBrasil_Helper_Url extends Mage_Checkout_Helper_Url
{
    public function getCheckoutUrl()
    {
        return $this->_getUrl('easycheckoutbrasil', array('_secure'=>true));
    }
}
