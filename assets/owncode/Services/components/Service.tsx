import React from 'react';
import { ServicesType } from '../ServicesList';

type Props = {
    service: ServicesType;
    disable: boolean;
    handleAddCart: (clickedService: ServicesType)=> void;
}

export const Service:React.FC<Props> = React.memo(({service, handleAddCart, disable}) => {
    // console.log(disable)
    return (
    <div className="col-md-6">
        <div className="card" style={{'height': '15rem'}}>
            <div className="card-header">
                {service.name}
            </div>
            <div className="card-body">
                <div className="row">
                    <div className="col-md-6">
                        <ul>
                            <li>Prix initial: {service.price_initial}</li>
                            <li>Prix special: {service.price_special}</li>
                        </ul>
                    </div>
                    <div className="col-md-6">
                        <ul>
                            <li>Duree: {service.duree} heures</li>
                            <li>Validite: {service.validite} jours</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div className="card-footer text-muted">
                {service.description}
            </div>
            { disable ? <a href="/login" className="btn btn-primary" >Ajouter dans le panier</a> : <button className="btn btn-primary"  onClick= {() => handleAddCart(service)}>Ajouter dans le panier</button>}
        </div>
    </div>
)})