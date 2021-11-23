import { render } from 'react-dom'
import React, { useCallback, useRef } from 'react'
import {useFetchUrl} from '../hooks/hooks'

type PropsForm = {
  userClient: number,
  commandId: number
}

export const PaimentForm: React.FC<PropsForm> = ({ userClient, commandId }) => {
  const input = useRef<HTMLInputElement>(null)
  const branch = useRef<HTMLInputElement>(null)
  const {load, loading} = useFetchUrl('/api/commandes_paies', 'POST')
  const onSubmit = useCallback(
    (e) => {
      e.preventDefault();
      load({
          code: input.current.value,
          branch: branch.current.value,
          commandesid: commandId
      })

      const reloadFx = setInterval(() => {
        window.location.reload()
        clearInterval(reloadFx);
      }, 8000)
    },
    [load, userClient]
  )
  return (
    <div>
      <form onSubmit={onSubmit}>
        <div className="form-group">
          <label htmlFor="code">Code de paiment</label>
          <input
            type="text"
            name="code"
            id="code"
            ref={input}
            className="form-control"
            placeholder="Code de paiment"
            aria-describedby="paimentId"
          />
          <small id="paimentId" className="text-muted">
            Assurez-vous d'avoir paye en totalite et ajouter le code de
            confirmation de votre service
          </small>
        </div>
        <div className="form-group">
          <label htmlFor="branch">Branche</label>
          <input
            type="text"
            name="branch"
            id="branch"
            ref={branch}
            className="form-control"
            placeholder="Branche (Lumicash, EcoCash, SmartPesa)"
            aria-describedby="paimentId"
          />
          <small id="paimentId" className="text-muted">
            Mettez le service que vous avez utilise (par ex. : LumiCash, EcoCash)
          </small>
        </div>
        <div className="form-group">
          <input
            type="hidden"
            name="code"
            id="code"
            value={commandId}
            className="form-control"
          />
        </div>
        <div className="pull-right">
            <button disabled={loading} className="btn btn-primary" type="submit">Confirmer</button>
        </div>
      </form>
    </div>
  )
}
