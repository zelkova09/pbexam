import Vue from 'vue';
import Router from 'vue-router';
import Home from './views/Home.vue';
import * as auth from './services/auth_service';

Vue.use(Router);

const routes = [{
        path: '/home',

        component: Home,
        children: [{
                path: '',
                name: 'dashboard',
                component: () =>
                    import ('./views/Dashboard.vue')
            },
            {
                path: 'Expenses',
                name: 'expenses',
                component: () =>
                    import ('./views/Expenses.vue')

            }
        ],
        beforeEnter(to, from, next) {
            if (!auth.isLoggedIn()) {
                next('/login');
            } else {
                next();
            }
        }
    },

    {
        path: '/Register',
        name: 'register',
        component: () =>
            import ('./authentication/Register.vue')

    },
    {
        path: '/forgot-password',
        name: 'forgotpassword',
        component: () =>
            import ('./authentication/forgotpw.vue')
    },

    {
        path: '/login',
        name: 'login',
        component: () =>
            import ('./authentication/login.vue'),
        beforeEnter(to, from, next) {
            if (!auth.isLoggedIn()) {
                next();
            } else {
                next('/home');
            }
        }
    }

];

const router = new Router({
    mode: 'history',
    routes: routes,
    linkActiveClass: 'active'
});

export default router;