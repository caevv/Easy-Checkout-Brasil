<?php
class CaeVecchi_EasyCheckoutBrasil_Block_Widget_Taxvat extends Mage_Customer_Block_Widget_Taxvat
{
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('easycheckoutbrasil/widget/taxvat.phtml');
    }
}
