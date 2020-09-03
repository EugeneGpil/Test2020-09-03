export function initialize(store, router) {
    router.beforeEach((to, from, next) => {
        if (router.history.pending.name == 'login') {
            next();
        }
        if (!store.getters.me) {
            store.dispatch('getMe');
        }
    });
}