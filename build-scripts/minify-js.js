const fs = require('fs');
const path = require('path');
const { minify } = require('terser');

// JS dosyalarının bulunduğu dizinler
const jsDirectories = [
    path.join(__dirname, '../public/js'),
    path.join(__dirname, '../themes/awacms/default/public/js')
];

// Minify fonksiyonu
async function minifyJS(filePath) {
    try {
        const code = fs.readFileSync(filePath, 'utf8');

        // Eğer zaten .min.js dosyası ise atla
        if (filePath.endsWith('.min.js')) {
            console.log(`⏭️  Skipping already minified: ${path.basename(filePath)}`);
            return;
        }

        const result = await minify(code, {
            compress: {
                dead_code: true,
                drop_console: false, // Production'da console.log'ları tutmak istersen true yap
                drop_debugger: true,
                conditionals: true,
                evaluate: true,
                booleans: true,
                loops: true,
                unused: true,
                hoist_funs: true,
                hoist_vars: false,
                if_return: true,
                join_vars: true,
                side_effects: true,
                warnings: false
            },
            mangle: {
                toplevel: false,
                safari10: true
            },
            format: {
                comments: false
            },
            sourceMap: false
        });

        if (!result.code) {
            console.error(`❌ Error: No output for ${filePath}`);
            return;
        }

        // .min.js uzantılı dosya oluştur
        const minFilePath = filePath.replace(/\.js$/, '.min.js');
        fs.writeFileSync(minFilePath, result.code);

        // Boyut bilgisi
        const originalSize = (Buffer.byteLength(code, 'utf8') / 1024).toFixed(2);
        const minifiedSize = (Buffer.byteLength(result.code, 'utf8') / 1024).toFixed(2);
        const savedPercent = (((originalSize - minifiedSize) / originalSize) * 100).toFixed(2);

        console.log(`✅ ${path.basename(filePath)} → ${path.basename(minFilePath)}`);
        console.log(`   ${originalSize}KB → ${minifiedSize}KB (${savedPercent}% azaltma)`);
    } catch (error) {
        console.error(`❌ Error minifying ${filePath}:`, error.message);
    }
}

// Dizindeki tüm JS dosyalarını işle
async function processDirectory(directory) {
    if (!fs.existsSync(directory)) {
        console.log(`⚠️  Directory not found: ${directory}`);
        return;
    }

    const files = fs.readdirSync(directory);

    for (const file of files) {
        // macOS hidden dosyalarını ve .min.js dosyalarını atla
        if (file.startsWith('._')) {
            continue;
        }

        if (file.endsWith('.js') && !file.endsWith('.min.js')) {
            const filePath = path.join(directory, file);
            if (fs.statSync(filePath).isFile()) {
                await minifyJS(filePath);
            }
        }
    }
}

// Ana fonksiyon
async function main() {
    console.log('⚡ JavaScript Minification Started...\n');

    for (const directory of jsDirectories) {
        console.log(`\n📁 Processing: ${directory}`);
        await processDirectory(directory);
    }

    console.log('\n✨ JavaScript Minification Completed!\n');
}

main().catch(console.error);

