
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// import Bootstrap vue
import BootstrapVue from 'bootstrap-vue'
//Importing sweetalert
import VueSweetalert2 from 'vue-sweetalert2';

// Import form
import { Form, HasError, AlertError } from 'vform';


window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.use(BootstrapVue);

Vue.use(VueSweetalert2);

window.froala= require('froala-editor');
// Require Jquery
require('jquery');

//Install Simple Mde
window.markdown  = require('simplemde');

// Install select2
require('select2');


//install Datatable
require('datatables.net');

//install sweetalert2
window.swal = require('sweetalert2');
//Quill editor
window.Quill = require('quill');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */







//VUe
require('bootstrap-datepicker');
Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    data: {
        comment: [],
        check: false,
        likes: [],
        checkContents: false

    },
    methods: {
        showAlert(id) {
            swal({
                title: 'Are you sure?',
                text: 'You will not be able to recover this imaginary file!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.value) {
                    swal(
                        'Deleted!',
                        'Your imaginary file has been deleted.',
                        'success'
                    );
                    document.getElementById("delete-form-" + id).submit();
                } else if (result.dismiss === swal.DismissReason.cancel) {
                    swal(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })
        },

        showAlertForAnchor() {
            swal({
                title: 'Are you sure?',
                text: "It will permanently deleted !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function() {
                swal(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                );
            })
        },

        getComment($id) {
            axios.get("/api/comment/" + $id)
                .then(({data}) => (this.comment = data));

            console.log(comment.body);
        },
        getSubmit(){
            this.check = true;
        },
        getLikers(id){
            axios.get("/api/likers/" + id)
                .then(({data}) => (this.likes = data));

        },
        checkContent(){
            this.checkContents = true;
        }

    }
});


$(document).ready(function () {
    $(".js-example-basic-multiple").select2({
        theme: "classic"
    });
    $(".js-example-tokenizer").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });

    $('.datepicker').datepicker({format: 'yy-mm-dd'});

    $( "#a" ).click(function() {
        $('#myModal').modal('show');
    });
    $( "#a1" ).click(function() {
        $('#myModal').modal('show');
    });

    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

});
window.$('#table_id').DataTable();

var simplemde = new window.markdown({
    element: document.getElementById("content"),
    preview: true
});
// var editor = new Quill('#content');  // First matching element will be used
// var container = document.getElementById('content');
// var editor = new Quill(container);

// var quill = new Quill('#editor-container', {
//     modules: {
//         toolbar: [
//             [{ header: [1, 2, false] }],
//             ['bold', 'italic', 'underline'],
//             ['image', 'code-block']
//         ]
//     },
//     placeholder: 'Compose an epic...',
//     theme: 'snow'  // or 'bubble'
// });
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);

        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});
