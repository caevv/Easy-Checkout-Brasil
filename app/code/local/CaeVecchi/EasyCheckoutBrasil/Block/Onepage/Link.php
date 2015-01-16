<?php

class CaeVecchi_EasyCheckoutBrasil_Block_Onepage_Link extends Mage_Core_Block_Template
{
    public function isOnepageCheckoutAllowed()
    {
        return $this->helper('easycheckoutbrasil')->isEasyCheckoutBrasilEnabled();
    }

    public function checkEnable()
    {
        return Mage::getSingleton('checkout/session')->getQuote()->validateMinimumAmount();
    }

    public function getOnepageCheckoutUrl()
    {
    	$url	= $this->getUrl('easycheckoutbrasil', array('_secure' => true));
        return $url;
    }
}
