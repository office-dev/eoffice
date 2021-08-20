import {expect} from "chai";
import * as getters from "./getters";

describe("auth getters", () => {
    it('should handle loggingIn', () => {
        let state = { loggingIn: false};

        expect(getters.loggingIn(state)).to.be.false;

        state = {loggingIn: true};
        expect(getters.loggingIn(state)).to.be.true;
    });

    it('should handle loginError', () => {
        const loginError = {message: "error"};
        const state = {loginError};

        expect(getters.loginError(state)).to.be.deep.equal(loginError);
    });
});