import * as types from "./types";

export default {
    [types.AUTH_LOGIN_START](state){
        Object.assign(state, {loggingIn: true});
    },
    [types.AUTH_LOGIN_END](state){
        Object.assign(state, {loggingIn: false});
    },
    [types.AUTH_LOGIN_ERROR](state, loginError){
        Object.assign(state, {loginError});
    },
    [types.AUTH_LOGIN_RESET](state){
        Object.assign(state, {
            loggingIn: false,
            loginError: false,
        });
    }
}