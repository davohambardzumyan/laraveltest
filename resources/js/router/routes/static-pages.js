import Home from "../../views/static-pages/Home";

export default [
    {
        name: "Home",
        path: "/",
        meta: {
            title: process.env.APP_NAME
        },
        component: Home
    }
];
