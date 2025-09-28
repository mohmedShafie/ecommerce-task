/**
 *  messages alert
 * @param msg message to be shown
 */

function error(msg) {
    //error message
    Lobibox.notify('error', {
        pauseDelayOnHover: true,
        continueDelayOnInactiveTab: false,
        position: 'right button',
        showClass: 'rollIn',
        hideClass: 'rollOut',
        icon: 'bx bx-x-circle', //
        size: 'mini',
        sound: false,
        msg: msg
    });
}

function success(msg) {
    //success message
    Lobibox.notify('success', {
        pauseDelayOnHover: true,
        continueDelayOnInactiveTab: false,
        position: 'right button',
        showClass: 'rollIn',
        hideClass: 'rollOut',
        icon:  'bx bx-check-circle',
        size: 'mini',
        sound: false,
        msg: msg
    });
}

// toastr.mySuccess = function (msg) {
//     //success message
//     Lobibox.notify('success', {
//         pauseDelayOnHover: true,
//         continueDelayOnInactiveTab: false,
//         position: 'right button',
//         showClass: 'rollIn',
//         hideClass: 'rollOut',
//         icon:  'bx bx-check-circle',
//         size: 'mini',
//         sound: false,
//         msg: msg
//     });
// }

function info(msg) {
    // warning message
    Lobibox.notify('info', {
        pauseDelayOnHover: true,
        continueDelayOnInactiveTab: false,
        position: 'right button',
        showClass: 'rollIn',
        hideClass: 'rollOut',
        icon: 'bx bx-info-circle',
        size: 'mini',
        sound: false,
        msg: msg
    });
}

function defaults(msg) {
    Lobibox.notify('default', {
        pauseDelayOnHover: true,
        continueDelayOnInactiveTab: false,
        position: 'right button',
        showClass: 'rollIn',
        hideClass: 'rollOut',
        size: 'mini',
        sound: false,
        msg: msg
    });
}


