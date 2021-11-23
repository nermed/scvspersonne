import { render } from "react-dom";
import React from "react";
import { ServicesList } from './ServicesList'


export class ServiceListElement extends HTMLElement {
  connectedCallback() {
    const userClient = parseInt(this.dataset.user, 10) || null
    render(
        <ServicesList userClient={userClient} />
    , this);
  }
}