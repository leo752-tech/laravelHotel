import './bootstrap';

import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect'; // Aggiungi questo

Alpine.plugin(intersect); // Aggiungi questo
window.Alpine = Alpine;
Alpine.start();