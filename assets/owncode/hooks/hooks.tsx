import { useState, useCallback } from "react";
import { ServicesType, CommandeType } from '../Services/ServicesList'

async function jsonFetch(url: any, method = 'GET', data: any = null) {
    const params = {
        method: method,
        headers: {
            'Accept' : 'application/ld+json',
            'Content-Type': 'application/json'
        }
    }
    if(data) {
        params['body'] = JSON.stringify(data)
    }
    const response = await fetch(url, params)

    if(response.status == 204) {
        return null;
    }

    const responseData = await response.json()

    if(response.ok) {
        return responseData;
    }else{
        throw responseData;
    }
}

export function useServiceUrl(url: any) {
    const [loading, setLoading] = useState(false)
    const [items, setItems] = useState<ServicesType[] | []>([])
    const [next, setNext] = useState(null)
    const load = useCallback(async ()=>{
        setLoading(true)
        const response = await jsonFetch(next || url)
        try {
            setItems(items => [...items, ...response['hydra:member']])
            if(response['hydra:view'] && response['hydra:view']['hydra:next']){
                setNext(response['hydra:view']['hydra:next'])
            }else{
                setNext(null)
            }
        }catch(error){
            console.error(error)
        }
        setLoading(false)
    }, [url, next])
    return {
        items,
        load,
        hasMore: next != null,
        loading
    }
}

export function useFetchUrl(url:any, method: string, callback: any = null) {
    const [errors, setErrors] = useState({});
    const [item, setItem] = useState(0)
    const [loading, setLoading] = useState(false);
    const load = useCallback(async(data) => {
        setLoading(true)
        try {
            const response = await jsonFetch(url, method, data)
            if(callback) {
                callback(response)
            }
            setItem(response.id)
        } catch (error) {
            setErrors(error)
        }
        setLoading(false)
    }, [url, method, callback])
    // console.log(item)
    return {
        item, loading, load, errors
    }
}
