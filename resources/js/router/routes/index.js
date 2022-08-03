import auth from "./auth";
import other from "./other";
import profile from "./profile";
import httpCodesRoutes from "./http-codes-routes";
import ticket from "./ticket";

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
    other,
    httpCodesRoutes,
]);
