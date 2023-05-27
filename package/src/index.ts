import axios, { AxiosRequestHeaders } from 'axios'
import booking, { BookingOffer, BookingProvider } from './services/booking'
import user, { AuthResponse, User, UserLogin, UserRegister } from './services/user'
import { defaultTokenHandler, TokenHandler } from './tokenHandler'

/**
 * setupServices
 * @param param0 SetupServicesProps
 * @returns
 */
function setupServices({ apiHost, tokenHandler }: SetupServicesProps) {

    const api = axios.create({
        baseURL: apiHost,
        withCredentials: true
    })

    const { getToken } = tokenHandler

    api.interceptors.request.use((_request) => {

        /* Append content type header if its not present */
        if (!(_request.headers as AxiosRequestHeaders)['Content-Type']) {
            (_request.headers as AxiosRequestHeaders)['Content-Type'] =
                'application/json';
        }
        if (getToken) {
            const token = getToken();
            /* Check if authorization is set */
            if (!(_request.headers as AxiosRequestHeaders)['Authorization']) {
                /* Check if the user is authenticated to send Bearer token */
                if (token && token.length > 0) {
                    (_request.headers as AxiosRequestHeaders).Authorization =
                        'Bearer ' + token;
                }
            }
        }
        return _request;
    })

    return {
        api,
        booking: booking(api),
        user: user({ api, tokenHandler })
    }
}

export default setupServices

export {
    defaultTokenHandler
}

export type {
    // Booking
    BookingOffer,
    BookingProvider,
    // User
    AuthResponse,
    User,
    UserLogin,
    UserRegister,
    // Token
    TokenHandler
}

/**
 * -----------------------------------------
 *	Types
 * -----------------------------------------
 */

interface SetupServicesProps {
    apiHost: string
    tokenHandler: TokenHandler
}
