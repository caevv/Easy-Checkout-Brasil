<?php
class CaeVecchi_EasyCheckoutBrasil_Block_Links extends Mage_Checkout_Block_Links
{
    public function addCheckoutLink()
    {
		if ($this->helper('easycheckoutbrasil')->isEasyCheckoutBrasilEnabled()) 
        {
        	$parent = $this->getParentBlock();
			if ($parent)
            	$parent->addLink($this->helper('checkout')->__('Checkout'), 'easycheckoutbrasil', $this->helper('checkout')->__('Checkout'), true, array('_secure'=> true), 60, null, 'class="top-link-checkout"');

			return $this;
        }
        else
            return parent::addCheckoutLink();
    }
}
