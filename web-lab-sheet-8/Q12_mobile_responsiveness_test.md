# Q12. Verify mobile responsiveness across diverse device viewports using browser developer tools

## 1. How to test (Chrome / Edge DevTools)
1. Open the site and press `F12` (or `Ctrl+Shift+I`).
2. Click the **Toggle device toolbar** icon (or `Ctrl+Shift+M`).
3. Choose a device from the dropdown, or select **Responsive** and drag the width.
4. Test both **portrait and landscape** (rotate icon).
5. In Firefox: `Ctrl+Shift+M` (Responsive Design Mode).
6. Throttle network: **Network tab → Slow 4G** to check load on mobile data.

## 2. Viewports tested
| Device | Width × Height | Layout expected |
|--------|----------------|-----------------|
| iPhone SE | 375 × 667 | 1 column, stacked nav |
| iPhone 14 Pro | 393 × 852 | 1 column |
| Samsung Galaxy S20 | 360 × 800 | 1 column |
| iPad Mini | 768 × 1024 | 2-column cards |
| iPad Pro | 1024 × 1366 | 3-column cards + sidebar |
| Laptop | 1366 × 768 | Full desktop layout |
| Desktop | 1920 × 1080 | Content max-width 1200px, centered |

## 3. Checklist
| # | Check | 375 | 768 | 1024 | 1920 |
|---|-------|:-:|:-:|:-:|:-:|
| 1 | No horizontal scrolling | | | | |
| 2 | Text readable without zoom (≥16px body) | | | | |
| 3 | Images scale, none overflow | | | | |
| 4 | Navigation usable | | | | |
| 5 | Tap targets at least 44×44px | | | | |
| 6 | Carousel controls reachable | | | | |
| 7 | Form fields full width, correct keyboard (tel / email) | | | | |
| 8 | Map resizes correctly | | | | |
| 9 | Footer columns stack properly | | | | |

## 4. Required HTML and quick debug snippet
```html
<meta name="viewport" content="width=device-width, initial-scale=1">
```
Find elements causing sideways scroll (paste in DevTools Console):
```js
[...document.querySelectorAll('*')].filter(e => e.scrollWidth > document.documentElement.clientWidth).forEach(e => console.log(e));
```

## 5. Issues found
| Viewport | Issue | Fix |
|----------|-------|-----|
| | | |

Attach screenshots to the `/screenshots` folder in the repo.
