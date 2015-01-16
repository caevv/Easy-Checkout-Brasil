<?php
class CaeVecchi_EasyCheckoutBrasil_Block_Widget_Name extends Mage_Customer_Block_Widget_Name
{
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('easycheckoutbrasil/widget/name.phtml');
    }
}
