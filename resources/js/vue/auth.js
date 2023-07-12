import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import _Master from './Auth/_Master.vue';
import Login from './Auth/Login.vue';
import Register from './Auth/Register.vue';
import Password from './Auth/Password.vue';

const routes = [
    {
        path: '/login',
        name: 'auth.login',
        component: Login,
    },
    {
        path: '/register',
        name: 'auth.register',
        component: Register,
    },
    {
        path: '/password',
        name: 'auth.password',
        component: Password,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
    linkActiveClass: 'active',
    linkExactActiveClass: 'active',
});

const pages = {
    'auth.login': 'ورود به حساب کاربری',
    'auth.register': 'ثبت نام',
    'auth.password': 'بازنشانی رمز عبور',
};

router.afterEach((to,from) => {
    document.title = pages[to.name];
});

const app = createApp(_Master);
app.use(router);
app.mount('#vueApp');
