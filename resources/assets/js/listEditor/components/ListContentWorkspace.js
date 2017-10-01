import React, { Component } from 'react';
import PropTypes from 'prop-types';

export default class ListContentWorkspace extends Component {
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
            <section className={baseClassName}>
                <h1>{listTitle}</h1>
                <p>{listDescription}</p>
            </section>
        );
    }
};
