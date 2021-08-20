import {expect} from "chai";
import * as types from './types';
import mutations from "./mutations";
import {type} from "chai/lib/chai/utils";

describe('ui mutations', function () {
    it('should handle loading', () => {
        const state = {loading: false};

        mutations[types.UI_TOGGLE_LOADING](state);
        expect(state.loading).to.be.true;

        mutations[types.UI_TOGGLE_LOADING](state);
        expect(state.loading).to.be.false;
    });

    it('should handle snackbar', () => {
        const snackbar = {type: 'success', message: 'message'};
        const state = {snackbar};

        mutations[types.UI_SNACKBAR](state, null);
        expect(state.snackbar).to.be.null;

        mutations[types.UI_SNACKBAR](state, snackbar);
        expect(state.snackbar).to.be.eq(snackbar);
    });

    it('should handle drawer', () => {
        const drawer = false;
        const state = {drawer};

        mutations[types.UI_TOGGLE_DRAWER](state, true);
        expect(state.drawer).to.be.true;

        mutations[types.UI_TOGGLE_DRAWER](state, false);
        expect(state.drawer).to.be.false;
    });
});