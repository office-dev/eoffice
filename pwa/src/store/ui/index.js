import * as actions from "./actions";
import * as getters from "./getters";
import mutations from "./mutations";

const initialState = () => ({
    loading: false,
    snackbar: {},
    drawer: null,
});

export default {
    namespaced: true,
    state: initialState(),
    actions,
    mutations,
    getters
};