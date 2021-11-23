import React from 'react'
import { ServicesType } from '../../ServicesList'
import Button from '@material-ui/core/Button'
import { Wrapper } from './CartService.style'

type Props = {
  service: ServicesType
  addToCart: (clicked: ServicesType) => void
  removeFromCart: (id: number) => void
  addValidity: (clicked: ServicesType) => void
  removeValidity: (id: number) => void
}

export const CartService: React.FC<Props> = ({
  service,
  addToCart,
  removeFromCart,
  addValidity,
  removeValidity
}) => {
  const duree = service.duree
  let price = (service.price_initial * 18) / 100
  let avertissement = ''
  if (service.dureeAmount < service.duree || service.validiteModify < service.validite) {
    price = (service.price_special * 18) / 100
    avertissement = `Vous venez d'activer le prix special`
  }
  return (
    <Wrapper>
      <div>
        <h3 className="text-center">
          {service.name}
          <input type="hidden" name="id[]" value={service.id} />
        </h3>
        <div className="information">
          <p>Prix: {Math.round(price)}</p>
          <p>
            Total: {Math.round(service.dureeAmount * price)}
            <input
              type="hidden"
              name="price[]"
              value={Math.round(service.dureeAmount * price)}
            />
          </p>
        </div>
        <div className="buttons_label">
          <p className="bold">Moins</p>
          <p className="bold">Duree par heure</p>
          <p className="bold">Plus</p>
        </div>
        <div className="buttons">
          <Button
            size="small"
            disableElevation
            variant="contained"
            onClick={() => removeFromCart(service.id)}
          >
            -
          </Button>
          <p>
            {service.dureeAmount}
            <input type="hidden" name="duree[]" value={service.dureeAmount} />
          </p>
          <Button
            size="small"
            disableElevation
            variant="contained"
            onClick={() => addToCart(service)}
          >
            +
          </Button>
        </div>
        <div className="buttons_label mt-4">
          <p className="bold"></p>
          <p className="bold">Jours</p>
          <p className="bold"></p>
        </div>
        <div className="buttons">
          <Button
            size="small"
            disableElevation
            variant="contained"
            onClick={() => removeValidity(service.id)}
          >
            -
          </Button>
          <p>
            {service.validiteModify}
            <input type="hidden" name="duree[]" value={service.validiteModify} />
          </p>
          <Button
            size="small"
            disableElevation
            variant="contained"
            onClick={() => addValidity(service)}
          >
            +
          </Button>
        </div>
        <div>
          <p className="text-center" style={{ color: 'red' }}>
            {avertissement}
          </p>
        </div>
      </div>
    </Wrapper>
  )
}
