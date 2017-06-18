import flashBanner from './flashBannerComponent';

function flashManager(opts) {
    const Eridu = opts.Eridu || window.Eridu;
    var activeBanner;

    function _createFlashBanner(type, message, duration) {
        let newBanner = new flashBanner({ type, message });
        activeBanner = newBanner;
        newBanner.show();
    }

    /**
     * Create a banner from the flash object
     * @param  {object} opts
     *             type [string]
     *             message [string]
     */
    function createBanner(opts) {
        var type = opts.type || 'default';
        var message = opts.message || '';

        _createFlashBanner(type, message);
    }

    /**
     * Short cut for making a banner of 'error' type
     * @param  {string} message
     * @param  {number} duration
     */
    function error(message, duration) {
        _createFlashBanner('error', message);
    }

    /**
     * Short cut for making a banner of 'success' type
     * @param  {string} message
     * @param  {number} duration
     */
    function success(message, duration) {
        _createFlashBanner('success', message);
    }

    function removeBanner() {
        if (activeBanner) {
            activeBanner.remove();
        }
    }

    function getActiveBanner() {
        return activeBanner;
    }

    return {
        error,
        success,
        createBanner,
        removeBanner,
        getActiveBanner,
    };
};

var _instance;

function getInstance(opts) {
    if (!_instance) {
        return createInstance(opts);
    } else {
        return _instance;
    }
}

function createInstance(opts) {
    if (!_instance) {
        return flashManager(opts);
    } else {
        return _instance;
    }
}

export {
    getInstance,
    createInstance,
};
