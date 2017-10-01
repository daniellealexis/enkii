import {
    extend,
    isPlainObject,
    isArray,
    get as _get,
    has as _has,
    set as _set,
} from 'lodash';

const Eridu = (function() {
    const store = {};

    function get(dataKey = '', defaultValue) {
        return _get(store, dataKey, defaultValue);
    };

    function has(dataKey = '') {
        return _has(store, dataKey);
    };

    function set(key, value) {
        if (typeof key === 'string' || isArray(key)) {
            _set(store, key, value);
        } else if (typeof key === 'undefined') {
            // If undefined, don't set anything
        } else if (isPlainObject(key)) {
            // If object, extend on store
            extend(store, key);
        } else {
            throw new Error('Eridu Error: Only string keys, arrays, or objects allowed in set');
        }
    };

    return {
        get,
        has,
        set,
        store,
    };
})();

function getInstance() {
    return Eridu;
}

function initializeOnWindow() {
    var eridu = getInstance();


    if (window.eridu) {
        // Set data on the window to instance
        eridu.set(window.eridu);

        // Remove data from backend from window
        delete window.eridu;
    }

    // Set instance on window
    window.Eridu = eridu;

    // Return instance
    return eridu;
}

// remove JavaScript facade script from window? [.js-vars]

export {
    getInstance,
    initializeOnWindow,
};
