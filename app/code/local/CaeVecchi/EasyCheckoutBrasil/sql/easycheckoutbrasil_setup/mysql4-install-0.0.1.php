<?php

$installer = $this;
$installer->startSetup(); //inicia a instalacao

$tabela = $this->getTable('directory/country_region'); //pega o nome da tabela que cont�m os estados no magento

/*==============================================================================
 *
 *
 *  Adiciona os estados brasileiros
 *
 *
 * =============================================================================
 */

$sqlTeste = "SELECT * FROM {$tabela} WHERE code = 'AC' and country_id = 'BR'"; //faz uma busca pelo id do priemiro estado brasileiro que foi cadastrado no passo anterior
$connectionTeste = Mage::getSingleton('core/resource')->getConnection('core_read');
$estadoTeste = $connectionTeste->fetchAll($sqlTeste);


/*==============================================================================
 *  Antes de inserir os estados, testa para ver se existe o estado AC para n�o inserir o cadastro dos estados 2x
 * =============================================================================
 */
if(  @$estadoTeste[0]['code'] != "AC"  ){

        /*==============================================================================
         *  Adiciona os estados na tabela com os nomes dos estados
         * =============================================================================
         */
        $installer->run("
        INSERT INTO `{$tabela}` (`country_id`, `code`, `default_name`) VALUES
        ('BR', 'AC', 'Acre'),
        ('BR', 'AL', 'Alagoas'),
        ('BR', 'AP', 'Amapa'),
        ('BR', 'AM', 'Amazonas'),
        ('BR', 'BA', 'Bahia'),
        ('BR', 'CE', 'Ceara'),
        ('BR', 'ES', 'Espirito Santo'),
        ('BR', 'GO', 'Goias'),
        ('BR', 'MA', 'Maranhao'),
        ('BR', 'MT', 'Mato Grosso'),
        ('BR', 'MS', 'Mato Grosso do Sul'),
        ('BR', 'MG', 'Minas Gerais'),
        ('BR', 'PA', 'Para'),
        ('BR', 'PB', 'Paraiba'),
        ('BR', 'PR', 'Parana'),
        ('BR', 'PE', 'Pernambuco'),
        ('BR', 'PI', 'Piaui'),
        ('BR', 'RJ', 'Rio de Janeiro'),
        ('BR', 'RN', 'Rio Grande do Norte'),
        ('BR', 'RS', 'Rio Grande do Sul'),
        ('BR', 'RO', 'Rondonia'),
        ('BR', 'RR', 'Roraima'),
        ('BR', 'SC', 'Santa Catarina'),
        ('BR', 'SP', 'Sao Paulo'),
        ('BR', 'SE', 'Sergipe'),
        ('BR', 'TO', 'Tocantins'),
        ('BR', 'DF', 'Distrito Federal');
        ");
        /*==============================================================================
         *  Busca o id do primeiro estado brasileiro
         * =============================================================================
         */
        $sql = "SELECT region_id, code FROM {$tabela} WHERE code = 'AC' and country_id = 'BR'"; //faz uma busca pelo id do priemiro estado brasileiro que foi cadastrado no passo anterior
        $connection = Mage::getSingleton('core/resource')->getConnection('core_read');
        $estado = $connection->fetchAll($sql);
        $id_acre = $estado[0]['region_id']; //priemiro id dos estados

        $tabela_nome = $this->getTable('directory/country_region_name'); //pega o nome da tabela que cont�m os nomes dos estados no magento. Essa tabela pode conter tradu��es dos nomes dos estados

        $comando =  "INSERT INTO `{$tabela_nome}` (`locale`, `region_id`, `name`) VALUES
        ('pt_BR', '". $id_acre ."', 'Acre'),
        ('pt_BR', '". ($id_acre+1) ."', 'Alagoas'),
        ('pt_BR', '". ($id_acre+2) ."', 'Amapa'),
        ('pt_BR', '". ($id_acre+3) ."', 'Amazonas'),
        ('pt_BR', '". ($id_acre+4) ."', 'Bahia'),
        ('pt_BR', '". ($id_acre+5) ."', 'Ceara'),
        ('pt_BR', '". ($id_acre+6) ."', 'Espirito Santo'),
        ('pt_BR', '". ($id_acre+7) ."', 'Goias'),
        ('pt_BR', '". ($id_acre+8) ."', 'Maranhao'),
        ('pt_BR', '". ($id_acre+9) ."', 'Mato Grosso'),
        ('pt_BR', '". ($id_acre+10) ."', 'Mato Grosso do Sul'),
        ('pt_BR', '". ($id_acre+11) ."', 'Minas Gerais'),
        ('pt_BR', '". ($id_acre+12) ."', 'Para'),
        ('pt_BR', '". ($id_acre+13) ."', 'Paraiba'),
        ('pt_BR', '". ($id_acre+14) ."', 'Parana'),
        ('pt_BR', '". ($id_acre+15) ."', 'Pernambuco'),
        ('pt_BR', '". ($id_acre+16) ."', 'Piaui'),
        ('pt_BR', '". ($id_acre+17) ."', 'Rio de Janeiro'),
        ('pt_BR', '". ($id_acre+18) ."', 'Rio Grande do Norte'),
        ('pt_BR', '". ($id_acre+19) ."', 'Rio Grande do Sul'),
        ('pt_BR', '". ($id_acre+20) ."', 'Rondonia'),
        ('pt_BR', '". ($id_acre+21) ."', 'Roraima'),
        ('pt_BR', '". ($id_acre+22) ."', 'Santa Catarina'),
        ('pt_BR', '". ($id_acre+23) ."', 'Sao Paulo'),
        ('pt_BR', '". ($id_acre+24) ."', 'Sergipe'),
        ('pt_BR', '". ($id_acre+25) ."', 'Tocantins'),
        ('pt_BR', '". ($id_acre+26) ."', 'Distrito Federal');";

        //adiciona os estados
        $installer->run($comando);
};

/*==============================================================================
 *
 *  Adiciona os campos RG, CPF, Celular
 *
 * =============================================================================
 */

$tabela2 = $this->getTable('eav/attribute'); //pega o nome da tabela que cont�m os atributos no
//Tabela onde � adionado os campos eav_attribute

/*==============================================================================
 *  Testa par ver se o atributo rg ja existe no sistema
 * =============================================================================
 */
$sqlTeste2 = "SELECT * FROM {$tabela2} WHERE attribute_code = 'rg'";
$connectionTeste2 = Mage::getSingleton('core/resource')->getConnection('core_read');
$estadoTeste2 = $connectionTeste2->fetchAll($sqlTeste2);

if(  @$estadoTeste2[0]['attribute_code'] != "rg"  ){

        /*==============================================================================
         *  Adiciona o campo rg no billing e shipping
         * =============================================================================
         */
         $this->addAttribute('customer_address', 'rg', array(
              'type' => 'varchar',
              'input' => 'text',
              'label' => 'Identidade',
              'global' => 1,
              'visible' => 1,
              'required' => 0,
              'user_defined' => 1,
              'visible_on_front' => 1
          ));
          Mage::getSingleton('eav/config')
              ->getAttribute('customer_address', 'rg')
              ->setData('used_in_forms', array('customer_register_address','customer_address_edit','adminhtml_customer_address'))
              ->save();

        $tablequoteRG = $this->getTable('sales/order_address');
        Mage::log("TABELA IE ".$tablequoteRG);
        $installer->run("
        ALTER TABLE  $tablequoteRG ADD `rg` VARCHAR(25) NULL
        ");
        /*==============================================================================
         *  Adiciona o campo rg no cadastro do usuario
         * =============================================================================
         */
        $this->addAttribute('customer', 'rg', array(
        	'type' => 'varchar',
        	'input' => 'text',
        	'label' => 'Identidade',
        	'global' => 1,
        	'visible' => 1,
        	'required' => 0,
        	'user_defined' => 1,
        	'default' => '',
        	'visible_on_front' => 1
        ));

        if (version_compare(Mage::getVersion(), '1.4.2', '>='))
        {
        	Mage::getSingleton('eav/config')
        	->getAttribute('customer', 'rg')
        	->setData('used_in_forms', array('adminhtml_customer','customer_account_create','customer_account_edit','checkout_register','adminhtml_customer_address','customer_address_edit','customer_register_address'))
        	->save();
        };

        $tablequoteRG2 = $this->getTable('sales/quote');
        Mage::log("TABELA IE ".$tablequoteRG2);
        $installer->run("
        ALTER TABLE  $tablequoteRG2 ADD `customer_rg` VARCHAR(25) NULL
        ");
};

/*==============================================================================
 *  Testa par ver se o atributo celular ja existe no sistema
 * =============================================================================
 */
$sqlTeste2 = "SELECT * FROM {$tabela2} WHERE attribute_code = 'celular'";
$connectionTeste2 = Mage::getSingleton('core/resource')->getConnection('core_read');
$estadoTeste2 = $connectionTeste2->fetchAll($sqlTeste2);

if(  @$estadoTeste2[0]['attribute_code'] != "celular"  ){

        /*==============================================================================
         *  Adiciona o campo celular no billing e shipping
         * =============================================================================
         */
         $this->addAttribute('customer_address', 'celular', array(
              'type' => 'varchar',
              'input' => 'text',
              'label' => 'Celular',
              'global' => 1,
              'visible' => 1,
              'required' => 0,
              'user_defined' => 1,
              'visible_on_front' => 1
          ));
          Mage::getSingleton('eav/config')
              ->getAttribute('customer_address', 'celular')
              ->setData('used_in_forms', array('customer_register_address','customer_address_edit','adminhtml_customer_address'))
              ->save();

        $tablequoteCelular = $this->getTable('sales/order_address');
        Mage::log("TABELA IE ".$tablequoteCelular);
        $installer->run("
        ALTER TABLE  $tablequoteCelular ADD `celular` VARCHAR(25) NULL
        ");
        /*==============================================================================
         *  Adiciona o campo celular no cadastro do usuario
         * =============================================================================
         */
        $this->addAttribute('customer', 'celular', array(
        	'type' => 'varchar',
        	'input' => 'text',
        	'label' => 'Celular',
        	'global' => 1,
        	'visible' => 1,
        	'required' => 0,
        	'user_defined' => 1,
        	'default' => '',
        	'visible_on_front' => 1
        ));

        if (version_compare(Mage::getVersion(), '1.4.2', '>='))
        {
            Mage::getSingleton('eav/config')
        	->getAttribute('customer', 'celular')
        	->setData('used_in_forms', array('adminhtml_customer','customer_account_create','customer_account_edit','checkout_register','adminhtml_customer_address','customer_address_edit','customer_register_address'))
        	->save();
        };

        $tablequoteCelular = $this->getTable('sales/quote');
        Mage::log("TABELA celular ".$tablequoteCelular);
        $installer->run("
        ALTER TABLE  $tablequoteCelular ADD `customer_celular` VARCHAR(30) NULL
        ");
};

// Taxvat obrigatório p/ salvar CPF no cadastro
$installer->run("UPDATE " . Mage::getConfig()->getTablePrefix() . "core_config_data SET value = 'req' WHERE path = 'customer/address/taxvat_show'");


$installer->endSetup();
