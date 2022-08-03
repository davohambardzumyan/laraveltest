import auth from "../guards/auth";
import {authorizeAdmin, authorizeUser} from "../guards/authorize";
import List from "../../views/tickets/List";

export default [
    {
        name: 'Tickets',
        path: '/tickets',
        component: List,
        meta: {
            title: 'Tickets',
            middleware: [
                auth
            ]
        }

    }
]
