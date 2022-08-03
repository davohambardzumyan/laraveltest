import Login from "../../views/auth/Login";
import guest from "../guards/guest";
import Registration from "../../views/auth/Registration";
import ResetPassword from "../../views/auth/ResetPassword";
import ForgotPassword from "../../views/auth/ForgotPassword";
import {default as resetPasswordGuard} from "../guards/resetPassword"

export default [
    {
        name: 'Login',
        path: '/login',
        component: Login,
        meta: {
            title: 'Login',
            middleware: [
                guest
            ]
        }

    },
    {
        name: 'ForgotPassword',
        path: '/forgot-password',
        component: ForgotPassword,
        meta: {
            title: 'Forgot password',
            middleware: [
                guest,
            ]
        }

    },
    {
        name: 'ResetPassword',
        path: '/reset-password',
        component: ResetPassword,
        meta: {
            title: 'Reset password',
            middleware: [
                guest,
                resetPasswordGuard
            ]
        }

    },
    {
        name: 'Registration',
        path: '/registration',
        component: Registration,
        meta: {
            title: 'Registration',
            middleware: [
                guest
            ]
        }

    }
]
