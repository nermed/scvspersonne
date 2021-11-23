import { render } from "react-dom";
import React from "react";
import { PaimentForm } from './paiment'


export class PaimentElement extends HTMLElement {
  connectedCallback() {
    const userClient = parseInt(this.dataset.user, 10) || null
    const commandId = parseInt(this.dataset.commid, 10) || null
    render(
        <PaimentForm userClient={userClient} commandId={commandId} />
    , this);
  }
}