<script>
    return_url = "{{ URL::to("admin/".$active) }}";

	$(document).ready(function() {
        {{-- Form validations --}}
        $('#formValidation').formValidation({
            locale: '{{ \App::getLocale() == 'es' ? 'es_ES' : 'en_US' }}',
            fields: {
                name: {
                    validators: {
                        notEmpty: {},
                        stringLength: {
                            min: 3,
                            max: 255
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {},
                        emailAddress: {},
                        regexp: {
                                regexp: /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/,
                                message: "{{ trans("validation.attributes.email_message") }}"
                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {},
                        stringLength: {
                            min: 10,
                            max: 15
                        },
                        numeric: {
                            message: "{{ trans("validation.attributes.phone_message") }}"
                        }
                    }
                },
                address: {
                    validators: {
                        notEmpty: {},
                        stringLength: {
                            min: 10,
                            max: 1000000
                        }
                    }
                }
            }
        });

        {{-- Add phone field --}}
        $("#add-phone").click(function(e){
            e.preventDefault();
            count = parseInt($("#phones_counter").val()) + 1;
            $("#phones_counter").val(count);

            html = `
                <div id="${count}" class="form-group row mb-3 ">
                    <label for="phone" class="col-sm-2 control-label">{{ trans('validation.attributes.phone') }} *</label>
                    <div class="col-sm-9">
                        <input id="phone_${count}" class="form-control" placeholder="{{ trans('validation.attributes.phone') }}" name="phones[${count}]" type="text">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-1 text-center">
                        <button onClick="removePhone(${count})" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            `;
            $("#phones-container").append(html);
            $("#phones-container").show(300);

            $('#formValidation').formValidation("addField", `phones[${count}]`, {
                validators: {
                    notEmpty: {},
                    stringLength: {
                        min: 10,
                        max: 15
                    },
                    numeric: {
                        message: "{{ trans("validation.attributes.phone_message") }}"
                    }
                }
            });
        });

        {{-- Toggle form visibility --}}
        $("#toggle-schedules-form").click(function(e){
            $("#create-container").slideToggle(400);
        });

        {{-- Click on ajax submit --}}
        $("#schedules-ajax").click(function(e){
            $this = $(this);
            original_text = "{{ trans("validation.attributes.save") }}";
            mod_text = `<i class="fa fa-spinner fa-spin"></i> {{ trans("validation.attributes.saving") }}`;
            form_data = new FormData($('#formValidation')[0]);
            validator = $('#formValidation').data('formValidation').validate();

            if (validator.isValid()) {
                $.ajax({
                    url: "{{ route("schedules.store") }}",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    processData: false,
                    contentType: false,
                    type: "POST",
                    dataType: "json",
                    data: form_data,
                    beforeSend: function() {
                        $this.empty().append(mod_text);
                        $this.prop("disabled", true);
                    },
                    success: function(resp) {
                        $this.empty().append(original_text);
                        $this.prop("disabled", false);

                        {{-- reset form and validations --}}
                        $('#formValidation').data('formValidation').resetForm($('#formValidation'));
                        $('#formValidation').trigger("reset")
                        $("#create-container").slideUp(400);
                        dt.ajax.reload();

                        if( resp.status=="success" ) {
                            $("#myModalAlertSuccessAjax").modal("show");
                            $("#myModalAlertSuccessAjax .modal-body .h4").empty().append(resp.message)
                        } else {
                            $("#myModalAlertErrorAjax").modal("show");
                            $("#myModalAlertErrorAjax .modal-body .h4").empty().append(resp.message)
                        }
                    },
                });
            }
        });
    });

    {{-- Remove phone function --}}
    function removePhone(target) {
        $("#phones-container").find(`[id=${target}]`).remove();
        $('#formValidation').formValidation("removeField", `phones[${target}]`);
    }
</script>
