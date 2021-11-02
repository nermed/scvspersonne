import { useState, useCallback } from "react";
import { ServicesType } from '../Services/ServicesList'

export function useServiceUrl(url: any) {
    const [loading, setLoading] = useState(false)
    const [items, setItems] = useState<ServicesType[] | []>([])
    const [next, setNext] = useState(null)
    const load = useCallback(async ()=>{
        setLoading(true)
        const response = await fetch(next || url, {
            headers: {
                'Accept' : 'application/ld+json'
            }
        })
        const responseData = await response.json()
        if(response.ok){
            setItems(items => [...items, ...responseData['hydra:member']])
            if(responseData['hydra:view'] && responseData['hydra:view']['hydra:next']){
                setNext(responseData['hydra:view']['hydra:next'])
            }else{
                setNext(null)
            }
        }else{
            console.error(responseData)
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