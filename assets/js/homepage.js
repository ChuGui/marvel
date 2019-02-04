/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
import '../css/homepage.scss';

import $ from 'jquery';

$('#myVideo').on('ended click', function(){
    $(this).hide('slow');
    $('.start-btn-container').show();
});



