import type { AxiosInstance } from 'axios';
import { generateCrud } from '../crud';
import type { PaginatedData } from '../types';

export default function init(api: AxiosInstance) {
    const baseUrl = '/booking'

    const offers = generateCrud<BookingOffer>({ api, baseUrl: `${baseUrl}/offers` })
    const providers = generateCrud<BookingProvider>({ api, baseUrl: `${baseUrl}/providers` })

    return {
        // Booking providers
        offers: {
            ...offers,
            filter: (params: Partial<BookingOffer>) => api.get<PaginatedData<BookingOffer>>(`${baseUrl}/offers/filter`, { params })
        },
        providers
    }
}


/**
 * -----------------------------------------
 *	Types
 * -----------------------------------------
 */

export interface BookingProvider {
    id: number
    name: string
    description: string
}


export interface BookingOffer {
    id: number
    name: string
    description: string
    type: string
    max_adults: number
    max_childs: number
    price_adult: number
    price_child: number
}
