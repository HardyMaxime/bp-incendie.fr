import legacy from '@vitejs/plugin-legacy'
import { defineConfig } from 'vite'

const THEME = "scorpe";

export default defineConfig({
    base: "./",
    root: './src',
    build: {
        outDir: '../../web/app/themes/'+THEME+'/assets/ressources/',
        assetsDir: '', // Leave `assetsDir` empty so that all static resources are placed in the root of the `dist` folder.
        assetsInlineLimit: 0,
        rollupOptions: {
            //input: {
                // Uncomment if you need to specify entry points for .html files
                //index: resolve(__dirname, 'index.html'),
            //},
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
    plugins: [
        legacy({
            targets: ['defaults', 'not IE 11']
        })
    ],
});