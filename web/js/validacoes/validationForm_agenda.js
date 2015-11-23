
$(document).ready(function() {

    $('.form-horizontal').bootstrapValidator({
        excluded: [':disabled'],
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'serbinario_bundle_saudebundle_calendario[qtdTotalCalendario]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    }
                }
            },
            'serbinario_bundle_saudebundle_calendario[qtdReservaCalendario]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    }
                }
            },
            'serbinario_bundle_saudebundle_calendario[diaCalendario]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    }
                }
            },
            'serbinario_bundle_saudebundle_calendario[horarioCalendario][hour]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    }
                }
            },
            'serbinario_bundle_saudebundle_calendario[horarioCalendario][minute]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    }
                }
            },
            'serbinario_bundle_saudebundle_calendario[localidadeLocalidade]': {
                validators: {
                    notEmpty: {
                        message: "Este campo é obrigatório"
                    }
                }
            }
        }
    });
   
});
