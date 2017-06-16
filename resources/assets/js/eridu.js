import extend from 'lodash';

var Eridu = (function() {
    var store = {};

    function set(key, value) {
        if (typeof key === 'string') {
            store[key] = value;
        } else if (typeof key === 'undefined') {
            // If undefined, don't set anything
        } else if (key !== null && key === Object(key) ) {
            // If object, extend on store
            _.extend(store, key);
        } else {
            throw new Error('Eridu Error: Only string keys or objects allowed in set');
        }
    };

    function get(dataKey = '') {
        typeof dataKey === 'string' || (dataKey = '');
        return store[dataKey];
    };

    function has(dataKey = '') {
        var data = get(dataKey);
        return !!data;
    };

    return {
        get,
        has,
        set,
    };
})();

function getInstance() {
    return Eridu;
}

function initializeOnWindow() {
    var eridu = getInstance();

    // Set data on the window to instance
    eridu.set(window.eridu);

    // Set instance on window
    window.Eridu = eridu;

    // Remove data from backend from window
    delete window.eridu;

    // Return instance
    return eridu;
}

export {
    getInstance,
    initializeOnWindow,
};
