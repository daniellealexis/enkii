import React from 'react';
import { render } from 'react-dom';
import { createStore, applyMiddleware } from 'redux';
import { Provider } from 'react-redux';
import thunk from 'redux-thunk';
import reducer from './reducers';
import { fetchBootstrapData } from './actions';
import App from './containers/app';
import { initializeOnWindow } from '../eridu';

// Initialize Eridu
initializeOnWindow();

const middleware = [thunk];

const store = createStore(
  reducer,
  applyMiddleware(...middleware)
);

store.dispatch(fetchBootstrapData());

render(
  <Provider store={store}>
    <App />
  </Provider>,
  document.getElementById('root')
);
