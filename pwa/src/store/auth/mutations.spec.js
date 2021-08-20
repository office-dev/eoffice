import {expect} from "chai";
import * as types from "./types";
import mutations from "./mutations";

describe('auth mutations', () => {
    it('handle login start', () => {
        const state = {loggingIn: false};

        mutations[types.AUTH_LOGIN_START](state);
        expect(state.loggingIn).to.be.true;
    });

    it('handle login end', () => {
        const state = {loggingIn: true};

        mutations[types.AUTH_LOGIN_END](state);
        expect(state.loggingIn).to.be.false;
    });

    it('handle login error', () => {
        const state = {};

        mutations[types.AUTH_LOGIN_ERROR](state, true);
        expect(state.loginError).to.be.true;
    });

    it('handle login reset', () => {
        const state = {loggingIn: true, loginError: true};

        mutations[types.AUTH_LOGIN_RESET](state);
        expect(state.loggingIn).to.be.false;
        expect(state.loginError).to.be.false;
    });
});