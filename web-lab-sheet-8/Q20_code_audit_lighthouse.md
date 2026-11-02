# Q20. Conduct a final code audit and accessibility evaluation using automated tools (e.g., Lighthouse)

## 1. Run Lighthouse in Chrome
1. Serve the site locally (see Q17) and open it in Chrome (use an Incognito window so extensions don't interfere).
2. Press `F12` → **Lighthouse** tab.
3. Select **Mobile**, tick Performance, Accessibility, Best Practices, SEO → **Analyze page load**.
4. Repeat with **Desktop**, and for every page (Home, Menu, About, Booking, Contact).
5. Click the three dots → **Save as HTML** (or JSON) and put reports in `/reports`.

## 2. Run Lighthouse from the command line
```bash
npm install -g lighthouse
lighthouse http://localhost:8080 --output html --output-path ./reports/home-mobile.html --view
lighthouse http://localhost:8080 --preset=desktop --output html --output-path ./reports/home-desktop.html
```

## 3. Other automated tools
| Tool | What it checks | How |
|------|----------------|-----|
| axe DevTools (browser extension) | WCAG violations | Install → DevTools → axe tab → Scan |
| WAVE (wave.webaim.org) | Accessibility errors, contrast | Enter URL or use extension |
| W3C HTML Validator | HTML errors | validator.w3.org |
| W3C CSS Validator | CSS errors | jigsaw.w3.org/css-validator |
| WebAIM Contrast Checker | Colour contrast | webaim.org/resources/contrastchecker |
| pa11y (CLI) | Accessibility | `npx pa11y http://localhost:8080` |
| ESLint / Stylelint | Code quality | see Q19 |

## 4. Results table
| Page | Performance | Accessibility | Best Practices | SEO |
|------|:-:|:-:|:-:|:-:|
| Home (mobile) | | | | |
| Home (desktop) | | | | |
| Menu | | | | |
| Booking | | | | |
| Contact | | | | |
Target: **90+** in every category.

## 5. Manual accessibility checks (automated tools find only ~30–40% of issues)
- [ ] Complete the whole site using only the keyboard (Tab, Shift+Tab, Enter, Space, arrows)
- [ ] Focus order is logical and the focus ring is always visible
- [ ] Test with a screen reader (NVDA on Windows – free, or VoiceOver on Mac)
- [ ] Zoom to 200% – nothing is cut off
- [ ] Turn on "reduce motion" in OS settings – carousel does not autoplay
- [ ] Form errors are announced and focus moves to the first error

## 6. Issues found and fixes
| # | Tool | Issue | Severity | Fix | Re-test score |
|---|------|-------|----------|-----|---------------|
| 1 | Lighthouse | Images missing width/height (CLS) | Medium | Added width and height attributes | |
| 2 | axe | Low contrast on gold text | High | Used gold for decoration only | |
| 3 | | | | | |

## 7. Common Lighthouse fixes
| Warning | Fix |
|---------|-----|
| Image elements do not have explicit width and height | Add `width` and `height` attributes |
| Properly size images | Use `srcset` and WebP (see Q10) |
| Eliminate render-blocking resources | `defer` on scripts, minify CSS |
| Document does not have a meta description | Add the tag (see Q16) |
| Links do not have descriptive text | Replace "click here" with meaningful text |
| Background and foreground colours lack contrast | Darken text or lighten background to reach 4.5:1 |

## 8. Conclusion (write after testing)
Summarise the final scores, what was fixed, and what remains.
