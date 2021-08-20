import jwt from 'jsonwebtoken';
import Cookies from 'js-cookie';

const Token = {
    getToken() {
        return Cookies.get('jwt_hp') + '.' + Cookies.get('jwt_s');
    },

    getCredentials() {
        return jwt.decode(this.getToken());
    },

    removeToken(){
        Cookies.remove('jwt_hp');
        Cookies.remove('jwt_s');
    },

    hasExpired(){
        const token = this.getCredentials();
        const unixTime = Date.now()/1000|0;
        return unixTime > token.exp;
    }
}

export default Token;