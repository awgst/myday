// Form Validation
function _ajaxValidation(selector, validSubmit) {
    let valid = validSubmit;
    let method = selector.attr('method');
    let url = selector.attr('action');
    if (selector.find(`[name="_method"]`).length > 1) {
        method = selector.find(`[name="_method"]`).val();
    }
    $.ajax({
        type: method,
        url: url,
        data: selector.serialize(),
        async: false,
        success: function (response) {
            console.log(response);
        },
        error: function (response) {
            let errors = response.responseJSON.errors;
            if (errors) {
                valid = false;
                $(`.text-danger`).text('');
                for (const key in errors) {
                    if (Object.hasOwnProperty.call(errors, key)) {
                        const error = errors[key];
                        $(`[data-validation='${key}']`).text(error);
                    }
                }
            }
        }
    });

    if (!valid) {
        toastr["error"]("Oops! Something went wrong, please try again.");
    }

    return valid;
}

function _validate(keyCheck, validSubmit) {
    let valid = validSubmit;
    for (let key in keyCheck) {
        $(`[data-validation='${key}']`).text('');
    }
    
    for (let key in keyCheck) {
        if ($(`[name='${key}']`).val() == "") {
            valid = false;
            $(`[data-validation='${key}']`).text(keyCheck[key]);
        }
    }

    return valid;
}

function validate(selector, keyCheck, withAjax=false) {
    selector.on('submit', function (e) {
        let valid = true;
        if (withAjax) {
            valid = _ajaxValidation(selector, valid);
        } else {
            valid = _validate(keyCheck, valid);
        }

        if (valid) {
            $(this).find('[type=submit]').prop('disabled', true);
        }

        return valid;
    });
}