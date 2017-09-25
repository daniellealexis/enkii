import React, { Component } from 'react';
import PropTypes from 'prop-types';

export default class ListEditor extends Component {
    static propTypes = {
        listTitle: PropTypes.string,
        listDescription: PropTypes.string,
    };

    render() {
        const {
            listTitle,
            listDescription,
        } = this.props;

        return (
            <div>
                <h1>{listTitle}</h1>
                <p>{listDescription}</p>
            </div>
        );
    }
};
