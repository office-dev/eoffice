import * as types from './types';

export default {
    [types.UI_TOGGLE_LOADING](state){
        Object.assign(state, {loading: !state.loading})
    },
    [types.UI_SNACKBAR](state, snackbar){
        Object.assign(state, {snackbar})
    },
    [types.UI_TOGGLE_DRAWER](state, drawer){
        Object.assign(state, {drawer});
    }
}