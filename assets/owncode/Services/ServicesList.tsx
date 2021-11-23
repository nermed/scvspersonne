import React, { useEffect, useState } from 'react';
import { useServiceUrl } from '../hooks/hooks';
import { Service } from './components/Service';
import { Cart } from './components/cart/Cart';
import Badge from '@material-ui/core/Badge';
import Drawer from '@material-ui/core/Drawer';
import LinearProgress from '@material-ui/core/LinearProgress';
import { StyledButton } from './ServicesList.style';
import AddShoppingCartIcon  from '@material-ui/icons/AddShoppingCart';

export type ServicesType = {
    id: number;
    name: string;
    description: string;
    duree: number;
    price_initial: number;
    price_special: number;
    dureeAmount: number;
    validite: number;
    validiteModify: number;
    amount: number;
}
export type CommandeType = {
    id: number
}

type Props = {
    userClient: number
}

export const ServicesList: React.FC<Props> = ({userClient}) => {
    // console.log(userClient)
    let disable = false;
    if(userClient == null) {
        disable = true;
    }else {
        disable = false;
    }
    const [cartOpen, setCartOpen] = useState(false);
    const [cartItems, setCartItems] = useState([] as ServicesType[]);
    const { items, load, hasMore, loading } = useServiceUrl('/api/services')
    useEffect(() => {
        load()
    }, [])

    console.log(items)

    const getTotalCart = (services: ServicesType[]): number => {
        return services.reduce((ack: number, item) => ack + item.amount, 0);
    }

    const handleAddCart = (clickedService: ServicesType) => {
        
        setCartItems(prev => {
            // 1. if item is already on cart
            const isServiceInCart = prev.find(item => item.id === clickedService.id)

            if(isServiceInCart) {
                return prev.map(item => 
                        item.id === clickedService.id ? 
                        {...item, dureeAmount: item.dureeAmount + 1} : item
                    )
            }
            // 2. if item is new
            return [...prev, {...clickedService, dureeAmount: clickedService.duree, validiteModify: clickedService.validite, amount: 1}]
        });
    };

    const handleRemoveFromCart = (id: number) => {
        setCartItems(prev => 
            prev.reduce((ack, item) => {
                if(item.id === id) {
                    if(item.dureeAmount === 1) return ack;
                    return [...ack, {...item, dureeAmount: item.dureeAmount - 1}]
                }else {
                    return [...ack, item]
                }
            }, [] as ServicesType[])
        );
    };

    const handleAddValidity = (clickedService: ServicesType) => {
        
        setCartItems(prev => {
            // 1. if item is already on cart
            const isServiceInCart = prev.find(item => item.id === clickedService.id)

            if(isServiceInCart) {
                return prev.map(item => 
                        item.id === clickedService.id ? 
                        {...item, validiteModify: item.validiteModify + 1} : item
                    )
            }
            // 2. if item is new
            // return [...prev, {...clickedService, validiteModify: clickedService.validite, amount: 1}]
        });
    };
    const handleRemoveValidity = (id: number) => {
        setCartItems(prev => 
            prev.reduce((ack, item) => {
                if(item.id === id) {
                    if(item.validiteModify === 1) return ack;
                    return [...ack, {...item, validiteModify: item.validiteModify - 1}]
                }else {
                    return [...ack, item]
                }
            }, [] as ServicesType[])
        );
    };
    // if(loading) return <LinearProgress />
    return (
        <div>
            <Drawer anchor='right' open={cartOpen} onClose={() => setCartOpen(false)}>
                <Cart cartServices={cartItems} 
                        userClient={userClient} 
                        addToCart={handleAddCart} 
                        removeFromCart={handleRemoveFromCart} 
                        addValidity={handleAddValidity}
                        removeValidity={handleRemoveValidity}  />
            </Drawer>
            <StyledButton onClick={() => setCartOpen(true)}>
                <Badge badgeContent={getTotalCart(cartItems)} color='error'>
                    <AddShoppingCartIcon />
                </Badge>
            </StyledButton>
            <div className="row">
                {items?.map(service => (
                    <Service key={service.id} disable={disable} service={service} handleAddCart={handleAddCart} />
                ))}
            </div>
            <div className="text-center">
                {hasMore && <button className="btn btn-info" onClick={() => load()}>Charger plus</button>}
            </div>
        </div>
    )
}