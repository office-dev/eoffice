import Vue from 'vue';
import Vuetify from 'vuetify/lib/framework';

Vue.use(Vuetify);

const opts = {
    theme: {
        primary: '#7957d5'
    },
    icons: {
        iconfont: 'mdi'
    }
};

export default new Vuetify(opts);
