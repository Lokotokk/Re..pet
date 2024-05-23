let form = document.querySelector("#cat-form");
// form.addEventListener('submit', function(event) {
//     event.preventDefault();

//     let formData = new FormData(form);
//     let request = new XMLHttpRequest();

//     request.addEventListener('load', function() {
//         document.getElementById("info").innerHTML = request.response;
//     });

//     request.open('POST', '/ajax_form_cat.php', true);
//     request.send(formData);
// });

function sendForm(selector, url, id) {
    let form = document.querySelector(selector);
    form.addEventListener('submit', function(event) {
        event.preventDefault();
    
        let formData = new FormData(form);
        let request = new XMLHttpRequest();
    
        request.addEventListener('load', function() {
            document.getElementById(id).innerHTML = request.response;
        });
    
        request.open('POST', url, true);
        request.send(formData);
    });
}

sendForm("#cat-form", '/ajax_form_cat.php', "info");
sendForm("#dog-form", '/ajax_form_dog.php', "info_dog");
sendForm("#other-form", '/ajax_form_other.php', "info_other");

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