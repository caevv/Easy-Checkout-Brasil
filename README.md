## Easy Checkout Brasil

Esse projeto nasceu como um fork do módulo One Step Checkout Brasil (https://github.com/deivisonarthur/OSC-Magento-Brasil-4-Pro).

### Motivações

O módulo que serviu de base possui muitos parâmetros (pouco utilizados na maioria dos casos) e código com pouca legibilidade, o que tende a gerar/manter muitos bugs e dificultar a manutenção. Essa é a principal motivação para o surgimento do Easy Checkout Brasil.

Outro ponto a ser considerado é que atualmente existem 2 repositórios ativos, o que confunde a maioria dos usuários:

- https://github.com/deivisonarthur/OSC-Magento-Brasil-4-Pro
- https://github.com/deivisonarthur/OSC-Magento-Brasil

### Características

Esse módulo será versionado adequadamente, com numeração incremental e tags, o que não vem ocorrendo no projeto em que foi baseado. Isso facilitará a correção de bugs e a evolução contínua e organizada. Além disso, também conta com as seguintes correções e recursos:

- Salva o CPF pelo campo taxvat;
- Carrinho é esvaziado após a conclusão do pedido;
- Janela modal para login e recuperação de senha na tela do pedido;
- Máscara para telefone / celular adaptada para o nono dígito;
- Separação clara de endereço de compra e entrega;
- Busca de CEP objetiva, sem a utilização de biblioteca extra (PHPQuery);

### Comparativo

Para ter uma idéia (aproximada), somando as linhas de código em arquivos (php, phtml, css, js, xml e csv) com o utilitário wc no pré lançamento:

- **OSC Brasil:** 23.584 linhas
- **OSC Simplificado:** 2.522 linhas

### Referências

- https://github.com/deivisonarthur/OSC-Magento-Brasil-4-Pro
- http://www.interiorwebdesign.com/magento/magento-one-step-checkout-module.html




