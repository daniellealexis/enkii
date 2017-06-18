const template = require('./flashBanner.hbs');

class flashBanner {
    constructor(opts) {
        this.type = opts.type || 'default';
        this.message = opts.message || '';

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
    }

    hide() {
        document.body.removeChild(this.el);
    }

    remove() {
        this.hide();
        // destroy self
    }
}

export default flashBanner;
