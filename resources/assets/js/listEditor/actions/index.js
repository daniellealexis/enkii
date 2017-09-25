import * as actions from '../constants/actionTypes';

export const fetchBootstrapData = () => dispatch => {
    const list = window.Eridu.get('list');
    const user = window.Eridu.get('user');

    return dispatch({
        type: actions.FETCHED_BOOTSTRAP_DATA,
        list,
        user,
    });
};
