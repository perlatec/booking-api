import type { AxiosInstance } from 'axios'
import { TokenHandler } from '../tokenHandler'

/**
 * init
 * @param api
 * @returns
 */
function init({ api, tokenHandler }: InitUsersProps) {

    const baseUrl = '/users'
    const { setToken } = tokenHandler

    return {
        login: async (params: UserLogin) => {
            const resp = await api.post<AuthResponse>(`${baseUrl}/login`, params)
            setToken(resp.data.auth_token)
            return resp
        },
        // register: (params: UserRegister) => api.post<AuthResponse>(`${baseUrl}/register`, params),
    }
}

export default init

/**
 * -----------------------------------------
 *	Types
 * -----------------------------------------
 */

export interface InitUsersProps {
    api: AxiosInstance
    tokenHandler: TokenHandler
}

/**
 * User
 */
export interface User {
    id: number;
    name: string;
    email: string;
}

/**
 * UserLogin
 */
export interface UserLogin {
    email: string
    password: string
}

/**
 * UserRegister
 */
export interface UserRegister {
    name: string
    email: string
    password: string
    password_confirmed: string
}

/**
 * AuthResponse
 */
export interface AuthResponse {
    auth_token: string
    user: User
}
