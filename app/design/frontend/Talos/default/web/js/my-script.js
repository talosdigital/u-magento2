define([
    'jquery',
    'underscore',
    'Magento_Checkout/js/model/step-navigator',
    'imagerotator'
],function($, _, stepNavigator, imagerotator) {
    'use strict';

    if  (typeof $.ajax !== 'undefined') {
        console.log('jQuery loaded');
    }

    if (typeof _.bind !== 'undefined') {
        console.log('Underscore loaded');
    }

    if (typeof stepNavigator.registerStep !== 'undefined') {
        console.log('StepNavigator loaded');
    }

    if(typeof imagerotator === 'undefined') {
        console.log('imagerotator is never going to be assigned');
    }
    if (typeof _imageRotator.rotate !== 'undefined') {
        console.log('_imageRotator loaded'); // in PRODUCTION(with bundle) works because view.xml exclude.');
    }

});

