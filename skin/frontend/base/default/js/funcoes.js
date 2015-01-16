function buscarEndereco(base_url, cep, logradouro, numero, bairro, cidade, estado) {

    var numeroCep = cep.getValue().replace('-', '');
    var urlCep = base_url + 'easycheckoutbrasil/index/cep/numero/' + numeroCep;

    if (/\d{8}/.test(numeroCep)) {

        $j.ajax({
            url: urlCep,
            dataType: "json",
            timeout: 7000,
            beforeSend: function() {
                [logradouro, bairro, cidade].each(function(elemento) {
                    elemento.setValue('');
                    elemento.writeAttribute('readonly', 'readonly');
                    elemento.setStyle({
                        background: '#EFEFEF'
                    });
                });
                
                logradouro.setValue('buscando endereço...');
            }

        }).done(function(endereco){
            logradouro.setValue(endereco.logradouro);
            bairro.setValue(endereco.bairro);
            cidade.setValue(endereco.localidade);

            switch(endereco.uf) {
                case "AC": estado.setValue(485); break;
                case "AL": estado.setValue(486); break;
                case "AP": estado.setValue(487); break;
                case "AM": estado.setValue(488); break;
                case "BA": estado.setValue(489); break;
                case "CE": estado.setValue(490); break;
                case "ES": estado.setValue(491); break;
                case "GO": estado.setValue(492); break;
                case "MA": estado.setValue(493); break;
                case "MT": estado.setValue(494); break;
                case "MS": estado.setValue(495); break;
                case "MG": estado.setValue(496); break;
                case "PA": estado.setValue(497); break;
                case "PB": estado.setValue(498); break;
                case "PR": estado.setValue(499); break;
                case "PE": estado.setValue(500); break;
                case "PI": estado.setValue(501); break;
                case "RJ": estado.setValue(502); break;
                case "RN": estado.setValue(503); break;
                case "RS": estado.setValue(504); break;
                case "RO": estado.setValue(505); break;
                case "RR": estado.setValue(506); break;
                case "SC": estado.setValue(507); break;
                case "SP": estado.setValue(508); break;
                case "SE": estado.setValue(509); break;
                case "TO": estado.setValue(510); break;
                case "DF": estado.setValue(511); break;
            }

            numero.focus();

        }).fail(function() {
            numero.clear();
            logradouro.clear();
            logradouro.focus();

        }).always(function() {
            if (cep.id == 'billing:postcode' && $('shipping:same_as_billing') && $('shipping:same_as_billing').checked) {
                $('shipping:street1').clear();
            }

            [logradouro, bairro, cidade].each(function(elemento) {
                elemento.writeAttribute('readonly', false);
                elemento.setStyle({
                    background: '#FFFFFF'
                });
            });
        });
    }
}

Validation.add('cpf', 'Por favor preencha um CPF válido', function(value) {
    value = value.replace(/[-\.]/g, '');

    if (value.length != 11 || 
        value == "00000000000" || value == "11111111111" || 
        value == "22222222222" || value == "33333333333" || 
        value == "44444444444" || value == "55555555555" || 
        value == "66666666666" || value == "77777777777" || 
        value == "88888888888" ||value == "99999999999") {
            return false;
        }

    var dv = value.substr(9,2);
    var value = value.substr(0,9);
    var i;
    var d1 = 0;
    var v = false;
    for (i = 0; i < 9; i++){
        d1 += value.charAt(i)*(10-i);
    }
    if (d1 == 0) {
        return false;
    }
    d1 = 11 - (d1 % 11);
    if (d1 > 9) d1 = 0;
    if (dv.charAt(0) != d1){
        return false;
    }
    d1 *= 2;
    for (i = 0; i < 9; i++){
        d1 += value.charAt(i)*(11-i);
    }
    d1 = 11 - (d1 % 11);
    if (d1 > 9) d1 = 0;
    if (dv.charAt(1) != d1){
        return false;
    }
    if (!v) {
        return true;
    }

});

