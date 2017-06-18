
/**
 * First we will load all of this project's JavaScript dependencies
 **/

require('./bootstrap');

import { initializeOnWindow as initializeEridu } from './eridu';
import { createInstance as createFlashManager } from './flashMessages/flashManager';


document.addEventListener('DOMContentLoaded', function() {
    const Eridu = initializeEridu();

    initializeFlashManager(Eridu);
});


function initializeFlashManager(Eridu) {
    const flashManager = createFlashManager({ Eridu });

    window.flashManager = flashManager;

    if (Eridu.has('flash')) {
        flashManager.createBanner(Eridu.get('flash'));
    }
}
