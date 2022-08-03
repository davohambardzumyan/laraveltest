import store from "../../store";
import { default as authRepository } from "../../repository/auth";
import {urlParams} from "../../helpers/_url";
import {abort} from "../../helpers/_global";

export default async function auth({next}) {
    store.commit('startLoader')

    await authRepository.resetPassword({
        email: urlParams.email,
        token: urlParams.token,
        password: 'null'
    }).catch((error) => {
        if (error.response.data.errors?.email) {
            abort(404)
        }
    }).finally(() => {
        store.commit('stopLoader')
    })
    return next();
}
