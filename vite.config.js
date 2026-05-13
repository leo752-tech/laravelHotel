import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0', // Permette a Vite di ascoltare sulla rete
        port: 5173,
        hmr: {
            host: '192.168.1.15', // <--- METTI QUI IL TUO INDIRIZZO IP LOCALE
        },
    },
});
