import * as types from './types';

export const toggleLoading = ({commit}) => {
    commit(types.UI_TOGGLE_LOADING);
};

export const toggleDrawer = ({commit}, payload) => {
    commit(types.UI_TOGGLE_DRAWER, payload);
}

export const snackbarSuccess = ({commit}, message) => {
    if(!message){
        message = 'Perubahan data berhasil disimpan!';
    }

    let payload = {
        type: 'success',
        message
    };

    commit(types.UI_SNACKBAR, payload);
};

export const snackbarError  = ({commit}, message) => {

    if(!message){
        message = 'Gagal menyimpan perubahan data!';
    }
    let payload = {
        type: 'error',
        message
    };

    commit(types.UI_SNACKBAR, payload );
};