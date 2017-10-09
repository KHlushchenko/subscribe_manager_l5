'use strict';

var SubscribeManager =
{
    lang_prefix: '',
    forms: [],
    active_form_name: '',

    rules: {
        'email'     : { required: true, email: true, maxlength: 255 },
        'entity_id' : { required: true }
    },
    messages: {
        'email'     : { required: '', email: '', maxlength: '' },
        'entity_id' : { required: '',}
    },
    
    setLangPrefix: function (langPrefix) {
        SubscribeManager.lang_prefix = langPrefix;
    },

    setForms: function (forms) {
        SubscribeManager.forms = forms;
    },

    setActiveForm: function (formName) {
        SubscribeManager.active_form_name = formName;
    },

    disableSubmitButton: function (form, value) {
        $(form).find('button[type="submit"]').attr('disabled', value);
    },

    resetForm: function (form) {
        form[0].reset();
        form.find(".btn_upload, .file_name_placeholder").show();
        form.find(".btn_delete, .file_name").hide();
        SubscribeManager.setActiveForm('');
    },

    successCallback: function(message){

    },

    failCallback: function(message){

    },

    submitActiveForm: function () {
        if(!SubscribeManager.active_form_name){
            return false
        }

        var $form = $('#' + SubscribeManager.active_form_name + '_form');
        var data = new FormData($form[0]);

        $.ajax({
            url: SubscribeManager.lang_prefix + '/subscribe/create',
            type: 'POST',
            dataType: 'json',
            cache: false,
            data: data,
            contentType: false,
            processData: false,
            success: function (response) {
                SubscribeManager.disableSubmitButton(SubscribeManager.active_form_name, true);
                if (response.status) {
                    SubscribeManager.resetForm($form);
                    SubscribeManager.successCallback(response.message);
                } else {
                    SubscribeManager.failCallback(response.message);
                }
            }
        });
    },

    initSubscribeForm: function()
    {
        $.each(SubscribeManager.forms, function (index, formName) {

            var $form = $('#' + formName + '_form');

            if (!$form.length) {
                return;
            }

            $form.validate({
                rules: SubscribeManager.rules,
                messages: SubscribeManager.messages,
                errorPlacement: function (error, element) {
                },
                submitHandler: function (form) {
                    SubscribeManager.disableSubmitButton(form, false);
                    SubscribeManager.setActiveForm(formName);
                    SubscribeManager.submitActiveForm();
                }
            });
        });
    },

    init: function()
    {
        SubscribeManager.initSubscribeForm();
    }

};