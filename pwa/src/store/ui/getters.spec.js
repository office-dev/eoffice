import {expect} from "chai";
import * as getters from "./getters";


describe('ui getters', function () {
    it('loading', () => {
        let state = { loading: false }
        expect(getters.loading(state)).to.be.false;

        state = { loading: true }
        expect(getters.loading(state)).to.be.true;
    });

    it('snackbar', () => {
        const snackbar = {message: 'message', type: 'error'};
        const state = { snackbar};

        expect(getters.snackbar(state)).to.be.eq(snackbar);
    });

    it('should handle drawer state', () => {
        const drawer = {drawer: 'some'};
        const state = {drawer};
        expect(getters.drawer(state)).to.be.deep.eq(drawer);
    });
});