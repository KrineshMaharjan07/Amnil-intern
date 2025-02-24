// Import the necessary CSS file for your project
import '../css/app.css';

// Example: You can add your custom JavaScript here
console.log("Vite and Laravel are ready to go!");

// Example: Import Alpine.js (if you're using it)
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// Or you can import libraries like React, Vue, etc. for example:
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';

const app = createApp(ExampleComponent);
app.mount('#app');
