import {ServiceListElement} from './Services/appList'

if (!customElements.get("service-list")) {
  customElements.define("service-list", ServiceListElement);
}
