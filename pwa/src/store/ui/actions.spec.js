import * as types from './types';
import {expect} from "chai";
import sinon from "sinon";
import * as actions from './actions';

describe('auth actions', () => {
    it('should toggle loading status', () => {
        const commit= sinon.spy();

        actions.toggleLoading({commit});

        expect(commit.args).to.deep.equal([[
            types.UI_TOGGLE_LOADING
        ]])
    });

    it('should handle toggle drawer', () => {
        const commit = sinon.spy();
        const payload = {};

        actions.toggleDrawer({commit}, payload);

        expect(commit.args).to.deep.equal([
            [types.UI_TOGGLE_DRAWER, payload],
        ]);
    });

    it('should handle snackbar success', () => {
        const commit = sinon.spy();
        const message = 'some message';

        actions.snackbarSuccess({commit}, message);

        expect(commit.args).to.deep.equal([
            [types.UI_SNACKBAR, {'type': 'success', message}],
        ]);
    });

    it('should handle snackbar error', () => {
        const commit = sinon.spy();
        const message = 'some message';

        actions.snackbarError({commit}, message);

        expect(commit.args).to.deep.equal([
            [types.UI_SNACKBAR, {'type': 'error', message}],
        ]);
    });
});