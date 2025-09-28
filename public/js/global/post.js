
function routePost(toRoute,formId){

    console.log('formId')
    console.log(formId)
    let data = new FormData($("#" + formId)[0]);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post({
        url: toRoute, //route to post
        data: data, //data to sent
        processData: false,
        contentType: false,
        success: function (data) {
            // window.location.href = reloadRoute;
            // window.addEventListener('loadeddata', success);
            success(data);
        },

        error: function (data) {
            console.log('error')
            console.log(data)
            const res = JSON.parse(data.responseText);
            /** extracts each error message and passes it to an error() function. */
            Object.keys(res).forEach(function (key) {
                error(res[key][0]);
            });
        },

    });
}
