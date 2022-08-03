import auth from "../guards/auth";
import Profile from "../../views/Profile";

export default [
    {
        name: 'Profile',
        path: '/profile',
        component: Profile,
        meta: {
            title: 'Profile',
            middleware: [
                auth
            ]
        }

    }
]
