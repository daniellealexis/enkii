import React, { Component } from 'react';
import PropTypes from 'prop-types';

export default class ListOverviewSidebar extends Component {
    static propTypes = {
        listTitle: PropTypes.string,
    };

    render() {
        const baseClassName = this.constructor.name;
        const {
            listTitle,
        } = this.props;

        return (
            <aside className={baseClassName}>
                <h1>{listTitle}</h1>
            </aside>
        );
    }
};
