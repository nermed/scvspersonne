import React from 'react';
import { ServicesType } from '../ServicesList';

type Props = {
    service: ServicesType;
    handleAddCart: (clickedService: ServicesType)=> void;
}

export const Service:React.FC<Props> = ({service, handleAddCart}) => (
    <div className="col-md-6">
        <div className="card" style={{'height': '15rem'}}>
            <div className="card-header">
                {service.name}
            </div>
            <div className="card-body">
                <ul>
                    <li>{service.price_initial}</li>
                    <li>{service.price_special}</li>
                    <li>{service.duree}</li>
                </ul>
            </div>
            <div className="card-footer text-muted">
                {service.description}
            </div>
            <button className="btn btn-primary" onClick= {() => handleAddCart(service)}>Ajouter sur le panier</button>
        </div>
    </div>
)