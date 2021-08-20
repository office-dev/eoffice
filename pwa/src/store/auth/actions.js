import * as auth from "./types";
import * as ui from "../ui/types";
import api from "../../utils/api";
import Token from "../../utils/token";

export const login = ({commit}, payload) => {
    commit(auth.AUTH_LOGIN_START);
    commit(auth.AUTH_LOGIN_ERROR, false);

    const url = api.generateUrl('login');
    return api.post(url, payload, {withCredentials: true})
        .then(() => {
            commit(auth.AUTH_LOGIN_END);
        })
        .catch(error => {
            commit(auth.AUTH_LOGIN_END);
            commit(auth.AUTH_LOGIN_ERROR, true, error.message);
        });
};

export const logout = ({commit}) => {
    commit(ui.UI_TOGGLE_LOADING);
    api.removeHeader();
    Token.removeToken();
    commit(ui.UI_TOGGLE_LOADING);
}