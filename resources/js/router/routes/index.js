import auth from "./auth";
import profile from "./profile";
import httpCodesRoutes from "./http-codes-routes";
import ticket from "./ticket";
import staticPages from "./static-pages";

function merge(routesList) {
    const allRoutes=[];

    for (let i = 0; i < routesList.length; i++) {
        allRoutes.push(...routesList[i])
    }

    return allRoutes;
}

export default merge([
    auth,
    profile,
    ticket,
    httpCodesRoutes,
    staticPages
]);
