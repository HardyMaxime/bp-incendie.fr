import legacy from '@vitejs/plugin-legacy'
import { defineConfig } from 'vite'
import fs from 'fs'
import path from 'path'
import LiveReload from 'vite-plugin-live-reload'

const THEME = "colibrys";
const THEME_PATH = path.resolve(__dirname, 'web/app/themes/'+THEME);

export default defineConfig({
    base: "./",
    root: './assets',
    build: {
        manifest: true,
        outDir: `${THEME_PATH}/assets/dist/`,
        assetsDir: '',
        rollupOptions: {
            input: [
                'assets/scripts/main.js',
                'assets/styles/main.scss',
            ],
            output: {
                entryFileNames: 'scripts/[name]-[hash].js',
                chunkFileNames: 'scripts/[name]-[hash].[ext]',
                assetFileNames: assetInfo => {
                  const ext = assetInfo.name.split('.').pop();
                  if (/\.css$/.test(assetInfo.name)) return `css/[name]-[hash].${ext}`;
                  if (/\.(woff2?|eot|ttf|otf)$/.test(assetInfo.name)) return `fonts/[name]-[hash].${ext}`;
                  if (/\.(png|jpe?g|gif|svg|webp|webm|mp3)$/.test(assetInfo.name)) return `images/[name]-[hash].${ext}`;
                  return `[name]-[hash].${ext}`;
                }
            }
        }
    },
    server: {
        host: '0.0.0.0', // Écoute sur toutes les interfaces
        port: 5173,      // Port du serveur de développement
        origin: 'http://localhost:5173',
        cors: true,
    },
    plugins: [
        legacy({
            targets: ['defaults', 'not IE 11']
        }),
        LiveReload([
            path.join(THEME_PATH, '**/*.php'),
        ]),
    ],
    resolve: {
        alias: {
            '@images': path.resolve(__dirname, './assets/images'),
            '@': path.resolve(__dirname, './assets')
        }
    },
});