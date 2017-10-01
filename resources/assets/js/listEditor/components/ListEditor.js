import React, { Component } from 'react';
import PropTypes from 'prop-types';

import ListOverviewSidebar from './ListOverviewSidebar';
import ListContentWorkspace from './ListContentWorkspace';

export default class ListEditor extends Component {
    static propTypes = {
        listTitle: PropTypes.string,
        listDescription: PropTypes.string,
    };

    render() {
        const baseClassName = this.constructor.name;
        const {
            listTitle,
            listDescription,
        } = this.props;

        return (
            <div className={baseClassName}>
                <ListOverviewSidebar listTitle={listTitle} />
                <ListContentWorkspace {...this.props} />
            </div>
        );
    }
};
