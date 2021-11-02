import { render } from "react-dom";
import React from "react";
import { ServicesList } from './ServicesList'


export class ServiceListElement extends HTMLElement {
  connectedCallback() {
    render(
        <ServicesList />
    , this);
  }
}