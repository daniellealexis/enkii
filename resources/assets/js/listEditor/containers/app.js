import React from 'react';
import PropTypes from 'prop-types';
import { bindActionCreators } from 'redux';
import { connect } from 'react-redux';
import ListEditor from '../components/ListEditor';
import * as actions from '../actions';

const App = (props) => (
  <ListEditor {...props} />
);

const mapStateToProps = state => Object.assign({}, state);

const mapDispatchToProps = dispatch => bindActionCreators(actions, dispatch);

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(App);
