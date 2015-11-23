$(document).ready(function() {

    //função para mascara de telefone
    var maskBehavior = function(val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
            options = {onKeyPress: function(val, e, field, options) {
                    field.mask(maskBehavior.apply({}, arguments), options);
                }
            };
    
    var mask = "HH:MM",
    pattern = {
        'translation': {
            'H': {
                pattern: /[0-23]/
            },
            'M': {
                pattern: /[0-59]/
            }
        }
    };

    
    
    //mascaras genéricas
    //$('.mask_letras').mask('SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS');
   // $('.mask_letras').mask('***********');
    $('.mask_cep').mask('00000-000');
    $('.mask_cnpj').mask('00.000.000/0000-00');
    $('.mask_numero').mask('00000000000000000000000');
    $('.mask_telefone').mask(maskBehavior, options);
    $('.mask_horario').mask(mask, pattern);
    $(document).on('focus', ".telefoneCollection", function() {
        $('.telefoneCollection').mask(maskBehavior, options);
    });
    $(document).on('focus', ".cpfCollection", function() {
        $('.cpfCollection').mask('000.000.000-00');
    });
    $('.mask_cpf').mask('000.000.000-00');
});


