const fs = require('fs');
const path = require('path');
const postcss = require('postcss');
const cssnano = require('cssnano');

// CSS dosyalarının bulunduğu dizinler
const cssDirectories = [
    path.join(__dirname, '../public/css'),
    path.join(__dirname, '../themes/awacms/default/public/css')
];

// Basit CSS minify (newstyle.css için)
function simpleMinifyCSS(css) {
    return css
        // Çok satırlı yorumları kaldır
        .replace(/\/\*[\s\S]*?\*\//g, '')
        // Gereksiz boşlukları kaldır
        .replace(/\s+/g, ' ')
        // Selektör ve property arası boşlukları temizle
        .replace(/\s*{\s*/g, '{')
        .replace(/\s*}\s*/g, '}')
        .replace(/\s*:\s*/g, ':')
        .replace(/\s*;\s*/g, ';')
        .replace(/\s*,\s*/g, ',')
        // Başlangıç ve bitişteki boşlukları kaldır
        .trim();
}

// Minify fonksiyonu
async function minifyCSS(filePath) {
    try {
        const css = fs.readFileSync(filePath, 'utf8');

        // Eğer zaten .min.css dosyası ise atla
        if (filePath.endsWith('.min.css')) {
            console.log(`⏭️  Skipping already minified: ${path.basename(filePath)}`);
            return;
        }

        // newstyle.css için basit minify kullan (postcss ile sorun yaşıyor)
        const isNewStyle = filePath.includes('newstyle.css');

        let minifiedCSS;
        if (isNewStyle) {
            minifiedCSS = simpleMinifyCSS(css);
        } else {
            const result = await postcss([
                cssnano({
                    preset: ['default', {
                        discardComments: { removeAll: true },
                        normalizeWhitespace: true,
                        colormin: true,
                        minifyFontValues: true,
                        minifyGradients: true,
                        normalizeUrl: false,
                        discardUnused: false,
                    }]
                })
            ]).process(css, { from: filePath, to: filePath });

            minifiedCSS = result.css;
        }

        // .min.css uzantılı dosya oluştur
        const minFilePath = filePath.replace(/\.css$/, '.min.css');
        fs.writeFileSync(minFilePath, minifiedCSS);

        // Boyut bilgisi
        const originalSize = (Buffer.byteLength(css, 'utf8') / 1024).toFixed(2);
        const minifiedSize = (Buffer.byteLength(minifiedCSS, 'utf8') / 1024).toFixed(2);
        const savedPercent = (((originalSize - minifiedSize) / originalSize) * 100).toFixed(2);

        console.log(`✅ ${path.basename(filePath)} → ${path.basename(minFilePath)}`);
        console.log(`   ${originalSize}KB → ${minifiedSize}KB (${savedPercent}% azaltma)`);
    } catch (error) {
        console.error(`❌ Error minifying ${filePath}:`, error.message);
    }
}

// Dizindeki tüm CSS dosyalarını işle
async function processDirectory(directory) {
    if (!fs.existsSync(directory)) {
        console.log(`⚠️  Directory not found: ${directory}`);
        return;
    }

    const files = fs.readdirSync(directory);

    for (const file of files) {
        // macOS hidden dosyalarını ve .min.css dosyalarını atla
        if (file.startsWith('._')) {
            continue;
        }

        if (file.endsWith('.css') && !file.endsWith('.min.css')) {
            const filePath = path.join(directory, file);
            if (fs.statSync(filePath).isFile()) {
                await minifyCSS(filePath);
            }
        }
    }
}

// Ana fonksiyon
async function main() {
    console.log('🎨 CSS Minification Started...\n');

    for (const directory of cssDirectories) {
        console.log(`\n📁 Processing: ${directory}`);
        await processDirectory(directory);
    }

    console.log('\n✨ CSS Minification Completed!\n');
}

main().catch(console.error);

