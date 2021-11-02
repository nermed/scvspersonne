import React, { useEffect } from 'react';
import { useServiceUrl } from '../hooks/hooks';
import { Service } from './components/Service'

export type ServicesType = {
    id: string;
    name: string;
    description: string;
    duree: string;
    price_initial: number;
    price_special: number;
    loading: boolean;
    amount: number;
}

export function ServicesList() {
    const { items, load, hasMore } = useServiceUrl('/api/services')
    useEffect(() => {
        load()
    }, [])

    console.log(items)

    const getTotalCart = () => {

    }

    const handleAddCart = (clickedService: ServicesType) => {

    };

    const handleRemoveFromCart = () => {

    };

    return (
        <div>
            <div className="row">
                {items?.map(service => (
                    <Service key={service.id} service={service} handleAddCart={handleAddCart} />
                ))}
            </div>
            {hasMore && <button className="btn btn-info" onClick={() => load()}>Charger plus</button>}
        </div>
    )
}