import auth from "../guards/auth";
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
