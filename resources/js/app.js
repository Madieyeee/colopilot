import './bootstrap';

import jQuery from 'jquery';
window.$ = jQuery;

import 'datatables.net-bs5';
import 'datatables.net-responsive-bs5';

import Alpine from 'alpinejs';
import TomSelect from 'tom-select';

window.Alpine = Alpine;

window.TomSelect = TomSelect;

Alpine.start();
