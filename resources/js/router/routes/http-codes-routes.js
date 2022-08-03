import NotFoundComponent from "../../views/static-pages/404";
import NotAllowedComponent from "../../views/static-pages/403";
import ServerError from "../../views/static-pages/500";

export default [
    {
        name: "403",
        path: "/403",
        meta: {
            title: "Forbidden"
        },
        component: NotAllowedComponent
    },
    {
        name: "500",
        path: "/500",
        meta: {
            title: "Server Error"
        },
        component: ServerError
    },
    {
        name: "404",
        path: "*",
        component: NotFoundComponent,
        meta: {
            title: "Not Found"
        }
    }
];
