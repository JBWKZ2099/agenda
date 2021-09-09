$('#rootwizard').bootstrapWizard({
    'tabClass': 'nav nav-pills',
    'onNext': function(tab, navigation, index) {
        numTabs    = $('#formValidation').find('.tab-pane').length,
            isValidTab = validateTab(index - 1);
        if (!isValidTab) {
            return false;
        }

        return true;

        // $validator = $('#formValidation').data('formValidation').validate();
        // return $validator.isValid();
    },
    onTabClick: function(tab, navigation, index) {
        return false;
    },
    onTabShow: function(tab, navigation, index) {
        total = navigation.find('li').length;
        current = index + 1;

        // If it's the last tab then hide the last button and show the finish instead
        if (current >= total) {
            $('#rootwizard').find('.pager .next').hide();
            $('#rootwizard').find('.pager .finish').show();
            $('#rootwizard').find('.pager .finish').removeClass('disabled');
        } else {
            $('#rootwizard').find('.pager .next').show();
            $('#rootwizard').find('.pager .finish').hide();
        }
    }
});

$('#rootwizard .finish').click(function () {
    $this = $(this);
    form_data = new FormData($('#formValidation')[0]);
    validator = $('#formValidation').data('formValidation').validate();
    spinner = `<i class="fa fa-spinner fa-spin me-2 ajax-spinner"></i>`;

    if (validator.isValid()) {
        form_url = $("#formValidation").attr("action");

        $.ajax({
            url: form_url,
            headers: {
                "X-CSRF-TOKEN": $(`[name="_token"]`).val()
            },
            processData: false,
            contentType: false,
            type: "POST",
            dataType: "json",
            data: form_data,
            beforeSend: function() {
                $this.prepend(spinner);
                $this.prop("disabled", true);
            },
            success: function(resp) {
                $(document).find(".ajax-spinner").remove();
                $this.prop("disabled", false);

                if( resp.status=="success" )
                    window.location.href = return_url;
                else {
                    $("#myModalAlertErrorAjax").modal("show");
                    $("#myModalAlertErrorAjax .modal-body .h4").empty().append(resp.message)
                }
            },
        });
        /*document.getElementById("formValidation").submit();*/
    }
});

function validateTab(index) {
    fv   = $('#formValidation').data('formValidation'), // FormValidation instance
        // The current tab
        tab = $('#formValidation').find('.tab-pane').eq(index);

    // Validate the container
    fv.validateContainer(tab);

    isValidStep = fv.isValidContainer(tab);
    if (isValidStep === false || isValidStep === null) {
        // Do not jump to the target tab
        return false;
    }

    return true;
}