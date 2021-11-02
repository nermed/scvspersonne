// const $ = require('jquery');
import $ from 'jquery'

$(function () {
    $(document).on('click', '#suivant_button', function () {
        if($('#address_form').attr('hidden', true)) {
            $('#address_form').removeAttr('hidden')
            $('#suivant_button').attr('id', 'suivant_button2')
        }
    })
    $(document).on('click', '#suivant_button2', function () {
        if($('#other_potential_form').attr('hidden', true)) {
            $('#other_potential_form').removeAttr('hidden')
            $('#suivant_element').detach();
            $('#submit_element').removeAttr('hidden')
        }
    })
})
