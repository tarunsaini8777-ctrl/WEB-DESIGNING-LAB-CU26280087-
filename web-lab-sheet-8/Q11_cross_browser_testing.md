# Q11. Test website cross-browser compatibility across Chrome, Firefox, Edge, and Safari

## 1. Browsers tested
| Browser | Version | OS | Tester |
|---------|---------|----|--------|
| Chrome | latest | Windows 11 | |
| Firefox | latest | Windows 11 | |
| Edge | latest | Windows 11 | |
| Safari | latest | macOS / iOS | |

> No Mac? Use BrowserStack / LambdaTest free tier, or Safari on an iPhone.

## 2. Test checklist (mark Pass / Fail)
| # | Feature | Chrome | Firefox | Edge | Safari |
|---|---------|:-:|:-:|:-:|:-:|
| 1 | Layout (Grid / Flexbox) renders correctly | | | | |
| 2 | Fonts and colours consistent | | | | |
| 3 | Hero carousel slides, arrows, dots, pause | | | | |
| 4 | Booking form validation messages | | | | |
| 5 | Date picker input works | | | | |
| 6 | Google Maps iframe loads | | | | |
| 7 | Share buttons open correct URLs | | | | |
| 8 | Copy-link button (Clipboard API) | | | | |
| 9 | Rating stars display and click | | | | |
| 10 | Keyboard navigation and focus outline | | | | |
| 11 | Reduced-motion setting respected | | | | |

## 3. Compatibility techniques used in the code
```css
/* Feature query: fall back where aspect-ratio is unsupported (older Safari) */
.map-wrap { height: 300px; }
@supports (aspect-ratio: 4 / 3) {
  .map-wrap { height: auto; aspect-ratio: 4 / 3; }
}

/* Safari needs the -webkit- prefix for some properties */
.card { -webkit-backdrop-filter: blur(6px); backdrop-filter: blur(6px); }

/* Safari date-input height fix */
input[type="date"] { min-height: 2.75rem; -webkit-appearance: none; appearance: none; }
```
```js
// Clipboard API fallback for older browsers
async function copyText(text) {
  if (navigator.clipboard) return navigator.clipboard.writeText(text);
  const t = document.createElement('textarea');
  t.value = text; document.body.appendChild(t); t.select();
  document.execCommand('copy'); t.remove();
}
```

## 4. Bug log
| # | Browser | Problem | Fix | Status |
|---|---------|---------|-----|--------|
| 1 | Safari | Date input looked different | Added `appearance: none` | Fixed |
| 2 | | | | |

## 5. Tools
- caniuse.com – check support before using a CSS/JS feature
- Autoprefixer – `npx postcss style.css --use autoprefixer -o style.prefixed.css`
