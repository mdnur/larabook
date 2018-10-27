
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
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
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
    })
 

});

window.$('#table_id').DataTable();

var simplemde = new window.markdown({
    element: document.getElementById("content"),
    preview: true
});


