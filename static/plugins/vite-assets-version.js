import fs from 'fs'
import path from 'path'

/**
 * Plugin Vite personnalisé pour générer un fichier de version
 * @param {Object} options - Options du plugin
 * @param {string} options.outputPath - Chemin de sortie pour le fichier de version
 * @param {string} options.fileName - Nom du fichier (par défaut: 'version.json')
 * @param {Function} options.generateVersion - Fonction pour générer la version (par défaut: Date.now())
 * @param {boolean} options.verbose - Affichage des logs détaillés (par défaut: true)
 */
export function vitePluginVersionFile(options = {}) {
    const {
        outputPath,
        fileName = 'version.json',
        generateVersion = () => Date.now(),
        verbose = true
    } = options;

    return {
        name: 'vite-plugin-version-file',
        writeBundle() {
            try {
                if (!outputPath) {
                    throw new Error('outputPath est requis dans les options du plugin');
                }

                const version = generateVersion();
                const versionFile = path.join(outputPath, fileName);
                const versionData = {
                    version,
                    timestamp: new Date().toISOString(),
                    buildDate: new Date().toLocaleDateString('fr-FR')
                };

                if (verbose) {
                    console.log(`📁 Répertoire de sortie : ${outputPath}`);
                    console.log(`📄 Fichier de version : ${versionFile}`);
                }

                // Vérifier que le répertoire existe, sinon le créer
                if (!fs.existsSync(outputPath)) {
                    fs.mkdirSync(outputPath, { recursive: true });
                    if (verbose) {
                        console.log(`📁 Répertoire créé : ${outputPath}`);
                    }
                }

                // Écrire le fichier de version
                fs.writeFileSync(
                    versionFile, 
                    JSON.stringify(versionData, null, 2), 
                    'utf-8'
                );

                if (verbose) {
                    console.log(`📦 Version générée : ${version}`);
                    console.log(`✅ Fichier créé avec succès : ${versionFile}`);
                }

            } catch (err) {
                console.error(`❌ Erreur lors de l'écriture de ${fileName} :`, err);
                console.error("❌ Chemin de sortie :", outputPath);
                console.error("❌ Répertoire de travail actuel :", process.cwd());
            }
        }
    };
}

export default vitePluginVersionFile;