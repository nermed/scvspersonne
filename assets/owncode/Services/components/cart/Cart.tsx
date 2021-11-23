import React, { useCallback, useEffect, useRef, useState } from 'react'
import { ServicesType } from '../../ServicesList'
import { CardStyle } from './CardStyle'
import { CartService } from '../CartService/CartService'
import { useFetchUrl } from '../../../hooks/hooks'
import Box from '@material-ui/core/Box'
import Modal from '@material-ui/core/Modal'
import Grid from '@material-ui/core/Grid'
import { LinearProgress } from '@material-ui/core'

type Props = {
  cartServices: ServicesType[]
  addToCart: (clicked: ServicesType) => void
  removeFromCart: (id: number) => void
  addValidity: (clicked: ServicesType) => void
  removeValidity: (id: number) => void
  userClient: number
}

export const Cart: React.FC<Props> = ({
  cartServices,
  addToCart,
  removeFromCart,
  addValidity,
  removeValidity,
  userClient,
}) => {

  const calculateTotal = (services: ServicesType[]) => {
    let price = 0
    for (let i = 0; i < services.length; i++) {
      if (services[i].dureeAmount < services[i].duree) {
        price = (services[i].price_special * 18) / 100
      } else {
        price = (services[i].price_initial * 18) / 100
      }
    }
    return services.reduce(
      (ack: number, service) => ack + service.dureeAmount * price,
      0,
    )
  }

  const { load, errors, loading } = useFetchUrl('/api/commande_details', 'POST')
  const { load: loadP, item:paiment, errors: errosP, loading: loadingP } = useFetchUrl('/api/paiments', 'POST');
  const {
    load: loadCommande,
    item: commande,
    errors: errorsCommande,
    loading: loadingCommande,
  } = useFetchUrl('/api/commandes', 'POST')

  const onSubmit = useCallback(
    (e) => {
      e.preventDefault();
      loadCommande({})
      const detail = setInterval(() => {
        cartServices.map((service) => {
          const duree = service.duree
          let price = (service.price_initial * 18) / 100
          if (service.dureeAmount < service.duree || service.validiteModify < service.validite) {
            price = (service.price_special * 18) / 100
          }
          load({
            services: '/api/services/' + service.id,
            hours: service.dureeAmount,
            validite: service.validiteModify,
            price: Math.round(price)
          })
        });
        clearInterval(detail)
      }, 5000)
      const reloadFx = setInterval(() => {
        window.location.assign('/commande/detail/')
        clearInterval(reloadFx);
      }, 8000)
    },
    [load, loadCommande, userClient, cartServices]
  )

  return (
    <CardStyle>
      <h4 className="text-center bold">Votre boutique</h4>
      {cartServices.length === 0 ? <p>Aucun service choisi</p> : null}
      {/* <form onSubmit={onSubmit}> */}
      {cartServices.map((service) => (
        <CartService
          key={service.id}
          service={service}
          addToCart={addToCart}
          removeFromCart={removeFromCart}
          addValidity={addValidity}
          removeValidity={removeValidity}
        />
      ))}
      <h2 className="text-center">
        Total: {Math.round(calculateTotal(cartServices))}
      </h2>
      {loadingCommande ? <LinearProgress /> : ''}
      <div className="text-center">
        <button onClick={onSubmit} disabled={loadingCommande} className="btn btn-primary mb-4">
          Commande
        </button>
      </div>
      {/* </form> */}
    </CardStyle>
  )
}

type PropModal = {
  cartServices: ServicesType[]
  userClient: number
  calculateTotal: (services: ServicesType[]) => number
}

const style = {
  position: 'absolute',
  top: '50%',
  left: '50%',
  transform: 'translate(-50%, -50%)',
  width: 400,
  bgcolor: 'background.paper',
  border: '1px solid #000',
  boxShadow: 24,
  p: 2,
}

/*const ModalOpen: React.FC<PropModal> = ({cartServices, userClient, calculateTotal }) => {
  const [open, setOpen] = React.useState(false);
  const handleOpen = () => setOpen(true);
  const handleClose = () => setOpen(false);
  const [inputRef, setInputRef] = useState('');
  const [selectRef, setSelectRef] = useState({select: ''});
  const { load, errors, loading } = useFetchUrl('/api/commande_details', 'POST')
  const { load: loadP, item:paiment, errors: errosP, loading: loadingP } = useFetchUrl('/api/paiments', 'POST');
  const {
    load: loadCommande,
    item: commande,
    errors: errorsCommande,
    loading: loadingCommande,
  } = useFetchUrl('/api/commandes', 'POST')
  const total = Math.round(calculateTotal(cartServices))
  const select = useRef<HTMLSelectElement>(null);
  const ref = useRef<HTMLInputElement>(null);
  useEffect(()=> {
    if(ref && ref.current) {
      setInputRef(ref.current.value)
    }
  })
  const onSubmit = useCallback(
    (e) => {
      e.preventDefault();
      // if(ref && ref.current) {
        // loadP({
        //   code: ref.current.value,
        //   totalPaie: total,
        //   branch: selectRef.select
        // })
      // }
      loadCommande({
        // paiment: '/api/paiments/' + paiment
      })
      console.log(commande)
      cartServices.map((service) => {
        const duree = service.duree
        let price = (service.price_initial * 18) / 100
        if (service.dureeAmount < service.duree) {
          price = (service.price_special * 18) / 100
        }
        load({
          services: '/api/services/' + service.id,
          hours: service.dureeAmount,
          price: Math.round(price)
        })
      });
    },
    [load, loadCommande, loadP, userClient, cartServices]
  )
  // console.log(ref)
  return (
    <div>
      <button onClick={onSubmit} className="btn btn-primary mb-4">
        Commande
      </button>
      <Modal
        open={open}
        onClose={handleClose}
        aria-labelledby="modal-modal-title"
        aria-describedby="modal-modal-description"
      >
        <Box sx={style}>
          <div className="container">
            <h3 className="text-center">Paiment</h3>
            <div className="row informationPaie">
              <div className="col-md-4 col-sm 4">Pour Lumicash, sur ce numero 68321456</div>
              <div className="col-md-4 col-sm 4">Pour EcoCash, sur ce numero 76853965</div>
              <div className="col-md-4 col-sm 4">Pour Smart Pesa, sur ce numero 75963125</div>
            </div>
            <div className="paimentData">
              <div className="form-group">
                <label htmlFor="code">Code de Paiment</label>
                <input type="text" ref={ref} name="code" id="code" className="form-control" />
              </div>
              <div className="form-group">
                <label htmlFor="branch">Systeme a Payer</label>
                <select name="branch" id="branch" className="form-control" ref={select}>
                  <option value="">Choisis le service</option>
                  <option value="Lumitel">LumiCash</option>
                  <option value="EconetLeo">EcoCash</option>
                  <option value="Smart">Smart Pesa</option>
                </select>
              </div>
            </div>
            <div className="line_buttons">
              <div className="row pull-right">
                <div className="col-md-4">
                  <button className="btn btn-warning" onClick={handleClose}>Annuler</button>
                </div>
                <div className="col-md-4">
                  <button className="btn btn-primary" onClick={onSubmit}>Paiment</button>
                </div>
                <div className="col-md-4">
                  <button className="btn btn-primary" onClick={onSubmit}>Payer plus tard</button>
                </div>
              </div>
            </div>
          </div>
        </Box>
      </Modal>
    </div>
  )
}

*/