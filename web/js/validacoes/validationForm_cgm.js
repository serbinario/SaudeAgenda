
$(document).ready(function() {

    $('.form-horizontal').bootstrapValidator({
        excluded: [':disabled'],
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'escolabundle_cgm[nome]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    }
                }
            },
            'escolabundle_cgm[sexoSexo]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    }
                }
            },
            'escolabundle_cgm[dataNascimento]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    },
                    date: {
                        format: 'DD/MM/YYYY',
                        message: 'A data não está no formato correto'
                    }
                }
            },
            'escolabundle_cgm[dataExpedicao]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    },
                    date: {
                        format: 'DD/MM/YYYY',
                        message: 'A data não está no formato correto'
                    }
                }
            },
            'escolabundle_cgm[nacionalidade]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    }
                }
            },
            'escolabundle_cgm[CGMMunicipio]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    }
                }
            },
            'escolabundle_cgm[estadoCivil]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    }
                }
            },
            'escolabundle_cgm[escolaridade]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    }
                }
            },
            'escolabundle_cgm[email]': {
                validators: {
                    emailAddress: {
                        message: 'O e-mail informado não é válido'
                    }
                }
            },
            'escolabundle_cgm[endereco][logradouro]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    }
                }
            },
            'escolabundle_cgm[CpfCnpj]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    },
//                    regexp: {
//                        regexp: /^(d{3}.d{3}.d{3}-d{2})|(d{11})$/,
//                        message: 'Dados inválidos'
//                    }
                }
            },
            'escolabundle_cgm[orgaoEmissor]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    }
                }
            },
            'escolabundle_cgm[rg]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    }
                }
            },
            'escolabundle_cgm[endereco][numero]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    },
                    stringLength: {
                        max: 20,
                        message: 'é permitido no máximo 20 caracteres'
                    }
                }
            },
            'escolabundle_cgm[endereco][cep]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    }
                }
            },
            'escolabundle_cgm[endereco][bairro]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    }
                }
            },
            'escolabundle_cgm[endereco][cidade]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    }
                }
            }
        }
    });
});
