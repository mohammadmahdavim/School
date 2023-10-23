verify_mobile = function () {
    var code = $('#input_1').val();

    if (code.length < 5) {
        toastr.warning("کد را به درستی وارد نمایید.");
        removeInput();
        enableInput();
        $("#input_1").focus();
        return false;
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: '/password/forgot/verify',
        type: 'POST',
        data: {code: code},
        success: function (response, textStatus, xhr) {
            setTimeout(function () {
                window.location.replace('/password/resets/?rc=' + response.token);
            }, 100);
        },
        error: function (xhr, textStatus) {
            removeInput();
            enableInput();
            $("#input_1").focus();
            toastr.error(xhr.responseJSON.error);
        }
    });


};

// $('input#input_1').keyup( function() {
//     if( this.value.length === 5 ) {
//         disableInput();
//         verify_mobile();
//     }
// });

call_check =function(){
    disableInput();
    verify_mobile();
};

trysms = function () {
    $('#trysmsmessage').hide();
    $.ajax({
        url: '/password/forgot/again',
        type: 'GET',
        success: function (response, textStatus, xhr) {
            toastr.success("پیام مجدد ارسال گردید.");
            timer(180);
        },
        error: function (xhr, textStatus) {
            toastr.error(xhr.responseJSON.error);
        }
    });
};

let timerOn = true;

function timer(remaining) {
    $('#timershow').show();
    var m = Math.floor(remaining / 60);
    var s = remaining % 60;

    m = m < 10 ? '0' + m : m;
    s = s < 10 ? '0' + s : s;
    document.getElementById('timer').innerHTML = m + ':' + s;
    remaining -= 1;

    if (remaining >= 0 && timerOn) {
        setTimeout(function () {
            timer(remaining);
        }, 1000);
        return;
    }

    if (!timerOn) {
        // Do validate stuff here
        return;
    }

    // Do timeout stuff here
    $('#timershow').hide();
    $('#trysmsmessage').show();
}

timer(180);

function moveOnMax(field,nextFieldID){
    if(field.value.length >= field.maxLength){
        document.getElementById(nextFieldID).focus();
    }
}

function enableInput() {
    document.getElementById('input_1').disabled = false;
}

function disableInput() {
    document.getElementById('input_1').disabled = true;
}

function removeInput() {
    document.getElementById('input_1').value = '';
}