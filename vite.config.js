import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    // server: {
    //     host: '0.0.0.0',
    //     port: 5173,
    //     cors: {
    //         origin: [
    //             'https://tjgm14r9-8000.asse.devtunnels.ms',
    //             // 'https://8c22-101-128-109-80.ngrok-free.app',
    //         ],
    //         methods: ['GET', 'HEAD', 'POST', 'OPTIONS'],
    //         credentials: true,
    //     }, 
    //     hmr: {
    //         host: 'tjgm14r9-5173.asse.devtunnels.ms',
    //         protocol: 'wss',
    //         clientPort: 443,
    //     },
    // }
});
