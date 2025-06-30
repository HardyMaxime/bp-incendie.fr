import legacy from '@vitejs/plugin-legacy'
import { defineConfig } from 'vite'
import nunjucks from 'vite-plugin-nunjucks'
import path from 'path'

const THEME = "colibrys";
const THEME_PATH = '../../web/app/themes/'+THEME+'/assets/ressources/';

export default defineConfig({
    base: "./",
    root: './src',
    build: {
        outDir: THEME_PATH,
        assetsDir: '',
        assetsInlineLimit: 0,
        rollupOptions: {
            output: {
                entryFileNames: `scripts/[name].js`,
                chunkFileNames: `scripts/[name].js`,
                assetFileNames: assetInfo => {
                    const info = assetInfo.name.split('.');
                    const extType = info[info.length - 1];
                    const assetPatterns = [
                        { regex: /\.(css)$/, path: 'css' },
                        { regex: /\.(js)$/, path: 'js' },
                        { regex: /\.(woff|woff2|eot|ttf|otf)$/, path: 'fonts' },
                        { regex: /\.(png|jpe?g|gif|svg|webp|webm|mp3)$/, path: 'images' },
                    ];

                    for (let pattern of assetPatterns) {
                        if (pattern.regex.test(assetInfo.name)) {
                            return `${pattern.path}/[name].${extType}`;
                        }
                    }
                    return `default/[name].${extType}`;
                },
            }
        }
    },
    server: {
        host: '0.0.0.0', // Écoute sur toutes les interfaces
        port: 5173,      // Port du serveur de développement
    },
    plugins: [
        legacy({
            targets: ['defaults', 'not IE 11']
        }),
        nunjucks()
    ],
    resolve: {
        alias: {
            '@images': path.resolve(__dirname, './src/images'),
            '@': path.resolve(__dirname, './src')
        }
    },
});