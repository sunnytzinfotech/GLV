$(function() {

    // pincode
    var _pincode = [];
    var id = $("#user_id").val();
    // var popup_id = $("#popup_id").val();
    // var insert_id = $("#insert_id").val();
    _req = null;

    // main form
    var $form = $('#form');

    // pincode group
    var $group = $form.find('.form__pincode');

    // all input fields
    var $inputs = $group.find('input[type="tel"]');

    // input fields
    var $first = $form.find('[name=pincode-1]')
        , $second = $form.find('[name=pincode-2]')
        , $third = $form.find('[name=pincode-3]')
        , $fourth = $form.find('[name=pincode-4]')
        , $fifth = $form.find('[name=pincode-5]')
        , $sixth = $form.find('[name=pincode-6]');

    // submit button
    var $button = $form.find('#check_btn');

    // all fields
    $inputs
        .on('keyup', function(event) {
            var code = event.keyCode || event.which;

            if (code === 9 && ! event.shiftKey) {
                // prevent default event
                event.preventDefault();

                // focus to submit button
                $('.button--primary').focus();
            }
        })
        .inputmask({
            mask: '9',
            placeholder: '',
            showMaskOnHover: false,
            showMaskOnFocus: false,
            clearIncomplete: true,
            onincomplete: function() {

            },
            oncleared: function() {
                var index = $inputs.index(this)
                    , prev = index - 1
                    , next = index + 1;

                if (prev >= 0) {
                    // clear field
                    $inputs.eq(prev).val('');

                    // focus field
                    $inputs.eq(prev).focus();

                    // remove last nubmer
                    _pincode.splice(-1, 1)
                } else {
                    return false;
                }


            },
            onKeyValidation: function(key, result) {
                var index = $inputs.index(this)
                    , prev = index - 1
                    , next = index + 1;

                // focus to next field
                if (prev < 6) {
                    $inputs.eq(next).focus();
                }


            },
            onBeforePaste: function (data, opts) {
                $.each(data.split(''), function(index, value) {
                    // set value
                    $inputs.eq(index).val(value);
                });

                return false;
            }
        });

    // first field
    $('[name=pincode-1]')
        .on('focus', function(event) {
        })
        .inputmask({
            oncomplete: function() {
                // add first character
                _pincode.push($(this).val());

                // focus to second field
                $('[name=pincode-2]').focus();
            }
        });

    // second field
    $('[name=pincode-2]')
        .on('focus', function(event) {
            if ( ! ($first.val().trim() !== '')) {
                // prevent default
                event.preventDefault();

                // reset pincode
                _pincode = [];

                // handle each field
                $inputs
                    .each(function() {
                        // clear each field
                        $(this).val('');
                    });

                // focus to first field
                $first.focus();
            }
        })
        .inputmask({
            oncomplete: function() {
                // add second character
                _pincode.push($(this).val());

                // focus to third field
                $('[name=pincode-3]').focus();
            }
        });

    // third field
    $('[name=pincode-3]')
        .on('focus', function(event) {
            if ( ! ($first.val().trim() !== '' &&
                $second.val().trim() !== '')) {
                // prevent default
                event.preventDefault();

                // reset pincode
                _pincode = [];

                // handle each field
                $inputs
                    .each(function() {
                        // clear each field
                        $(this).val('');
                    });

                // focus to first field
                $first.focus();
            }
        })
        .inputmask({
            oncomplete: function() {
                // add third character
                _pincode.push($(this).val());

                // focus to fourth field
                $('[name=pincode-4]').focus();
            }
        });

    // fourth field
    $('[name=pincode-4]')
        .on('focus', function(event) {
            if ( ! ($first.val().trim() !== '' &&
                $second.val().trim() !== '' &&
                $third.val().trim() !== '')) {
                // prevent default
                event.preventDefault();

                // reset pincode
                _pincode = [];

                // handle each field
                $inputs
                    .each(function() {
                        // clear each field
                        $(this).val('');
                    });

                // focus to first field
                $first.focus();
            }
        })
        .inputmask({
            oncomplete: function() {
                // add fo fourth character
                _pincode.push($(this).val());

                // focus to fifth field
                $('[name=pincode-5]').focus();
            }
        });

    // fifth field
    $('[name=pincode-5]')
        .on('focus', function(event) {
            if ( ! ($first.val().trim() !== '' &&
                $second.val().trim() !== '' &&
                $third.val().trim() !== '' &&
                $fourth.val().trim() !== '')) {
                // prevent default
                event.preventDefault();

                // reset pincode
                _pincode = [];

                // handle each field
                $inputs
                    .each(function() {
                        // clear each field
                        $(this).val('');
                    });

                // focus to first field
                $first.focus();
            }
        })
        .inputmask({
            oncomplete: function() {
                // add fifth character
                _pincode.push($(this).val());

                // focus to sixth field
                $('[name=pincode-6]').focus();
            }
        });

    // sixth field
    $('[name=pincode-6]')
        .on('focus', function(event) {
            if ( ! ($first.val().trim() !== '' &&
                $second.val().trim() !== '' &&
                $third.val().trim() !== '' &&
                $fourth.val().trim() !== '' &&
                $fifth.val().trim() !== '')) {
                // prevent default
                event.preventDefault();

                // reset pincode
                _pincode = [];

                // handle each field
                $inputs
                    .each(function() {
                        // clear each field
                        $(this).val('');
                    });

                // focus to first field
                $first.focus();
            }

        })
        .inputmask({
            oncomplete: function() {
                // add sixth character
                _pincode.push($(this).val());

                // pin length not equal to six characters
                if (_pincode.length !== 6) {
                    // reset pin
                    _pincode = [];

                    // handle each field
                    $inputs
                        .each(function() {
                            // clear each field
                            $(this).val('');
                        });

                    // focus to first field
                    $('[name=pincode-1]').focus();
                } else {
                    // handle each field
                    $inputs.each(function() {
                        // disable field
                        $(this).prop('disabled', true);
                    });

                    var tokenData = $('meta[name="csrf-token"]').attr('content');
                    var origin   = "api/tfa";

                    // send request
                    _req = $.ajax({
                        type: 'POST',
                        url: origin,
                        data: {
                            'code': _pincode.join(''),
                            // 'popup_id': popup_id,
                            '_token': tokenData
                        }
                    })
                        .done(function(data, textStatus, jqXHR) {

                            try {
                                if (data['ok'] === 'true') {
                                    // alert(data['code']);
                                    $group.addClass('form__group--success');

                                    $('#message_display').html('<span style="color: green;">'+data["message"]+'</span>');
                                    $('#code').val(data['code']);
                                    $('#url').val(data['url']);
                                    // $button.attr("href",data["url"]);

                                    // if(data['target']){
                                    //     $button.attr("target",'_blank');
                                    // }

                                    $button.removeAttr('disabled');
                                }
                                if (data['ok'] === 'false') {

                                    $group.addClass('form__group--error');

                                    $('#message_display').html('<span style="color: red;">'+data["message"]+'</span>');

                                    $button.attr("href",data["url"]);

                                    _pincode = [];

                                    setTimeout(function() {
                                        // handle each field
                                        $inputs.each(function() {
                                            // clear all fields
                                            $(this).val('');

                                            // enable all fields
                                            $(this).prop('disabled', false);
                                        });

                                        // remove response status class
                                        $group.addClass('form__group--error');

                                        // disable submit button
                                        $button.attr('disabled', true);

                                        // focus to first field
                                        $first.focus();
                                    }, 2000);
                                }
                            } catch (err) {

                            }
                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                            $group.removeClass('form__group--error');
                        });
                }
            }
        });
});
