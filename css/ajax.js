let form = document.querySelector("#cat-form");
form.addEventListener('submit', function(event) {
    event.preventDefault();

    let formData = new FormData(form);
    let request = new XMLHttpRequest();

    request.addEventListener('load', function() {
        document.getElementById("info").innerHTML = request.response;
    });

    request.open('POST', '/ajax.php', true);
    request.send(formData);
});

// $(document).ready(function() {

//     $('#cat-form').submit(function(event) {

//         $.ajax({
//             type: $(this).attr('method'),
//             url: $(this).attr('action'),
//             data: new FormData(this),
//             contentType: false,
//             cache: false,
//             processData: false,
//             success: function(result) {
//                 alert('OK');
//             },
//         });
//     });
// });