(function ($) {
    'use strict';

    var form = $('.contact_form'),
        message = $('.contact_msg'),
        form_data;

    // Success function
    function done_func(response) {
        message.fadeIn().removeClass('nosuccess').addClass('success');
        message.text(response);
        setTimeout(function () {
            message.fadeOut();
        }, 4000);
        form.find('input:not([type="submit"]), textarea').val('');
    }

    // fail function
    function fail_func(data) {
        message.fadeIn().removeClass('success').addClass('success');
        message.text(data.responseText);
        setTimeout(function () {
            message.fadeOut();
        }, 4000);
    }
    
 //   $(".formbtn").click(function() {
 //       $(".contact_msg").css("opacity", "0.5");
//      });


    form.submit(function (e) {
        e.preventDefault();
        form_data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form_data
        })
        .done(done_func)
        .fail(fail_func);
    });
    
})(jQuery);


function InvalidMsg(textbox) {
    
    if (textbox.value == '') {
        textbox.setCustomValidity('Required email address');
    }
    else if(textbox.validity.typeMismatch){
        textbox.setCustomValidity('please enter a valid email address');
    }
    else {
        textbox.setCustomValidity('');
    }
    return true;
}
