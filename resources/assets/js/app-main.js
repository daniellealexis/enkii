
/**
 * First we will load all of this project's JavaScript dependencies
 **/

require('./bootstrap');

import {
    initializeOnWindow as initializeEridu,
} from './eridu';

document.addEventListener('DOMContentLoaded', function() {
    const eridu = initializeEridu();

    if (eridu.has('flash')) {
        // initialize flash manager
    }
});
