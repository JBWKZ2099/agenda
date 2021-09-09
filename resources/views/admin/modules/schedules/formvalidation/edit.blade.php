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

        {{-- Add each phone to form validation --}}
        @foreach( $phones as $phone )
            $('#formValidation').formValidation("addField", "phones[{{ (($loop->index)+1) }}]", {
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
        @endforeach

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
    });

    {{-- Remove phone function --}}
    function removePhone(target) {
        $("#phones-container").find(`[id=${target}]`).remove();
        $('#formValidation').formValidation("removeField", `phones[${target}]`);
    }
</script>
