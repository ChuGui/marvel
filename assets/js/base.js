/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
import '../css/base.scss';
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');
// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
import $ from 'jquery';
import Barba from 'barba.js';

$('.haveLoader').on('click', function(){
    $(this).replaceWith('<div class="loader" id="loader-6">\n' +
        '          <span></span>\n' +
        '          <span></span>\n' +
        '          <span></span>\n' +
        '          <span></span>\n' +
        '        </div>');
});

/*=======TRANSITION=========*/
/*======USING BARBA.JS======*/
/*
$('document').ready(function(){
    let transEffect = Barba.BaseTransition.extend({
        start: function(){
            this.newContainerLoading.then(val => this.fadeInNewcontent($(this.newContainer)));
        },
        fadeInNewcontent : function(nc){
            nc.hide();
            let _this = this;
            $(this.oldContainer).fadeOut(1000).promise().done(() => {
                nc.css('visibility', 'visible');
                nc.fadeIn(500,function(){
                    _this.done();
                })

            });
        }
    });
    Barba.Pjax.getTransition = function() {
        return transEffect;
    };
    Barba.Pjax.start();
});*/
