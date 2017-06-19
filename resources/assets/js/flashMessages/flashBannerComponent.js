const template = require('./flashBanner.hbs');

class flashBanner {
    constructor(opts) {
        this.type = opts.type || 'default';

        this.message = opts.message || '';

        this.duration = typeof opts.duration === 'number' ?
            opts.duration : null;

        this.removeBannerFromManager = typeof opts.removeBannerFromManager === 'function' ?
            opts.removeBannerFromManager : () => {};

        this.el = this._createBannerElement();
    }

    _getTemplateData() {
        return {
            type: this.type,
            message: this.message,
        };
    }

    _createBannerElement() {
        var html = template(this._getTemplateData());
        var el = document.createElement('div');
        el.innerHTML = html;
        return el.firstChild;
    }

    show() {
        var closeIconEl = this.el.getElementsByClassName('flash-banner--close-icon')[0];

        document.body.appendChild(this.el);

        // Bind close button
        closeIconEl.addEventListener('click', this.remove.bind(this));

        if (this.duration) {
            setTimeout(this.remove.bind(this), this.duration);
        }
    }

    remove() {
        document.body.removeChild(this.el);
        this.removeBannerFromManager();
    }
}

export default flashBanner;
