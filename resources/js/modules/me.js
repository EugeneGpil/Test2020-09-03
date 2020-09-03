import router from '../routes.js';

export const me = {
    state: {
        me: null
    },
    actions: {
        getMe(context) {
            axios.get('/api/me').then(resp => {
                if (resp.status == 200) {
                    context.commit('setMe', resp.data);
                } else {
                    if (router.history.current.path != '/login') {
                        router.go({name: 'login'});
                    }
                }
            }).catch(() => {
                if (router.history.current.path != '/login') {
                    router.go({name: 'login'});
                }
            });
        },
    },
    mutations: {
        setMe(state, payload) {
            state.me = payload;
        }
    },
    getters: {
        me(state) {
            return state.me;
        },
    },
};