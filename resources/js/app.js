import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const element = document.querySelector(".js-choice")

const choices = new Choices(element)
