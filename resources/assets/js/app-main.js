
/**
 * First we will load all of this project's JavaScript dependencies
 **/

require('./bootstrap');

import {
    //getInstance as getEridu,
    initializeOnWindow as initializeEridu,
} from './eridu';

document.addEventListener("DOMContentLoaded", function() {
    initializeEridu();
});
