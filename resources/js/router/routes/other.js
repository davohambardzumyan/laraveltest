import Home from "../../views/Home";
import Page1 from "../../views/Page1";
import Page2 from "../../views/Page2";
import auth from "../guards/auth";
import Dashboard from "../../views/Dashboard";

const other = [
    {
        name: 'Home',
        path: '/',
        component: Home,
        meta: {
            title: 'Home'
        }
    },
    {
        name: 'Dashboard',
        path: '/dashboard',
        component: Dashboard,
        meta: {
            title: 'Dashboard',
            middleware: [
                auth
            ]
        }
    },
    {
        name: 'Page1',
        path: '/page-1',
        component: Page1,
        meta: {
            title: 'Page 1',
            middleware: [
                auth
            ]
        }
    },
    {
        name: 'Page2',
        path: '/page-2',
        component: Page2,
        meta: {
            title: 'Page 2',
            middleware: [
                auth
            ]
        }
    }
];

export default other;
