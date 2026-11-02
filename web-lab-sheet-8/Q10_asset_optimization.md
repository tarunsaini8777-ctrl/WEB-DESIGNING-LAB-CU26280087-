# Q10. Optimize website assets (compressing images, minifying CSS/JS) for high performance and fast loading speeds

## 1. Project layout
```
bakery/
├── src/            (original files)
│   ├── index.html
│   ├── css/style.css
│   ├── js/main.js
│   └── img/
├── dist/           (optimized output – deploy this)
└── package.json
```

## 2. package.json
```json
{
  "name": "rye-rosemary-bakehouse",
  "version": "1.0.0",
  "scripts": {
    "clean": "rm -rf dist && mkdir -p dist/css dist/js dist/img",
    "css": "csso src/css/style.css --output dist/css/style.min.css",
    "js": "terser src/js/main.js --compress --mangle --output dist/js/main.min.js",
    "html": "html-minifier-terser --collapse-whitespace --remove-comments --minify-css true --minify-js true src/index.html -o dist/index.html",
    "img": "squoosh-cli --webp '{\"quality\":75}' -d dist/img src/img/*.{jpg,png}",
    "build": "npm run clean && npm run css && npm run js && npm run html && npm run img"
  },
  "devDependencies": {
    "csso-cli": "^4.0.2",
    "html-minifier-terser": "^7.2.0",
    "terser": "^5.31.0"
  }
}
```
Run:
```bash
npm install
npm run build
```
Image compression (alternative using ImageMagick):
```bash
mkdir -p dist/img
for f in src/img/*.jpg; do magick "$f" -resize 1600x -strip -quality 78 "dist/img/$(basename "${f%.jpg}").webp"; done
```

## 3. HTML techniques
```html
<!-- Responsive, modern-format images with explicit size (prevents layout shift) -->
<picture>
  <source type="image/webp" srcset="img/loaf-480.webp 480w, img/loaf-960.webp 960w" sizes="(min-width: 768px) 50vw, 100vw">
  <img src="img/loaf-960.jpg" alt="Sourdough loaf" width="960" height="640" loading="lazy" decoding="async">
</picture>

<!-- First (hero) image must NOT be lazy-loaded -->
<img src="img/hero.webp" alt="Bakery counter" width="1600" height="900" fetchpriority="high">

<!-- Load CSS in head, JS deferred -->
<link rel="preload" href="css/style.min.css" as="style">
<link rel="stylesheet" href="css/style.min.css">
<script src="js/main.min.js" defer></script>
```

## 4. Server caching (Apache `.htaccess` example)
```apache
<IfModule mod_deflate.c>
  AddOutputFilterByType DEFLATE text/html text/css application/javascript image/svg+xml
</IfModule>
<IfModule mod_expires.c>
  ExpiresActive On
  ExpiresByType image/webp "access plus 1 year"
  ExpiresByType text/css "access plus 1 month"
  ExpiresByType application/javascript "access plus 1 month"
</IfModule>
```

## 5. Results table (fill after running)
| File | Before | After | Saving |
|------|--------|-------|--------|
| style.css | | | |
| main.js | | | |
| hero.jpg → hero.webp | | | |
| Total page weight | | | |
