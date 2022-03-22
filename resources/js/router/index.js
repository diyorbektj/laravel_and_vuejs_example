import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import About from '../pages/About';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';
import Test from '../components/Test';
import LiveSearch from '../components/LiveSearch';

import Books from '../components/Books';
import AddBook from '../components/AddBook';
import EditBook from '../components/EditBook';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'about',
        path: '/about',
        component: About
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'books',
        path: '/books',
        component: Books,
        meta: { transition: 'slide-left' },
    },
    {
        name: 'addbook',
        path: '/books/add',
        component: AddBook
    },
    {
        name: 'editbook',
        path: '/books/edit/:id',
        component: EditBook
    },
    {
        name: 'test',
        path: '/test',
        component: Test
    },
    {
        name: 'live-search',
        path: '/live-search',
        component: LiveSearch
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
