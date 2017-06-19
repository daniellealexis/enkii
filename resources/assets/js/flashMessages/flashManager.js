import flashBanner from './flashBannerComponent';

function flashManager(opts) {
    const Eridu = opts.Eridu || window.Eridu;
    var activeBanner;

    function _createFlashBanner(opts = {}) {
        var newBanner;

        opts.removeBannerFromManager = _unsetActiveBanner.bind(this);

        newBanner = new flashBanner(opts);

        if (activeBanner) {
            activeBanner.removeBanner();
        }

        activeBanner = newBanner;
        newBanner.show();
    }

    function _unsetActiveBanner() {
        activeBanner = null;
    }

    /**
     * Create a banner from the flash object
     * @param  {object} opts
     *             type [string]
     *             message [string]
     */
    function createBanner(opts = {}) {
        _createFlashBanner(opts);
    }

    /**
     * Short cut for making a banner of 'error' type
     * @param  {string} message
     * @param  {number} duration
     */
    function error(message, duration) {
        _createFlashBanner({
            type: 'error',
            message,
            duration
        });
    }

    /**
     * Short cut for making a banner of 'success' type
     * @param  {string} message
     * @param  {number} duration
     */
    function success(message, duration = 5000) {
        _createFlashBanner({
            type: 'success',
            message,
            duration
        });
    }

    function removeBanner() {
        if (activeBanner) {
            activeBanner.remove();
            _unsetActiveBanner();
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


// Export singleton functions

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
