import axios from 'axios';

const api = {
    generateUrl(url, params = false){
        const path = process.env.VUE_APP_ENTRYPOINT;
        url = `${path}/${url}`;
        if(params){
            url = `${url}?${params.join('&')}`
        }
        url = url.replace(/\/+/gm,'/');
        return url;
    },
    post(resource, data, options = {}){
        return axios.post(resource, data, options);
    },
    setHeader(){

    },
    removeHeader(){

    }
}
export default api;