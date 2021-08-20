import * as actions from "./actions";
import mutations from "./mutations";
import * as getters from "./getters";

const initialState = () => ({
    token: null,
    loggingIn: false,
    loginError: false
});

export default {
    namespaced: true,
    state: initialState(),
    actions,
    mutations,
    getters
}