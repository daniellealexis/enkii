import { combineReducers } from 'redux';

import {
    FETCHED_BOOTSTRAP_DATA,
} from '../constants/actionTypes';

const listId = (state = null, action) => {
    switch (action.type) {
        case FETCHED_BOOTSTRAP_DATA:
            return action.list.id;
        default:
            return state;
    }
}

const listTitle = (state = '', action) => {
    switch (action.type) {
        case FETCHED_BOOTSTRAP_DATA:
            return action.list.title;
        default:
            return state;
    }
};

const listDescription = (state = '', action) => {
    switch (action.type) {
        case FETCHED_BOOTSTRAP_DATA:
            return action.list.description;
        default:
            return state;
    }
};

const listType = (state = 'ul', action) => {
    switch (action.type) {
        case FETCHED_BOOTSTRAP_DATA:
            return action.list.type;
        default:
            return state;
    }
};

const listItems = (state = [], action) => {
    switch (action.type) {
        case FETCHED_BOOTSTRAP_DATA:
            return action.list.list_items;
        default:
            return state;
    }
};

const rootReducer = combineReducers({
    listId,
    listTitle,
    listDescription,
    listType,
    listItems,
});

export default rootReducer;
