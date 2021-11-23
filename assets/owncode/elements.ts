import {ServiceListElement} from './Services/appList'
import {PaimentElement} from './paiments/paimentEl'

if (!customElements.get("service-list")) {
  customElements.define("service-list", ServiceListElement);
}

if (!customElements.get("paiment-form")) {
  customElements.define("paiment-form", PaimentElement);
}
