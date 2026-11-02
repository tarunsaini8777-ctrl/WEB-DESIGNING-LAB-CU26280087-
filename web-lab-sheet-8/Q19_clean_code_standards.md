# Q19. Write clean, well-commented HTML, CSS, and JavaScript code following industry coding standards

## 1. HTML standards
- Start with `<!DOCTYPE html>` and `<html lang="en">`.
- Lowercase tags and attributes, double quotes, 2-space indentation.
- Use semantic elements (`header`, `nav`, `main`, `section`, `article`, `footer`).
- One `<h1>` per page, headings in order (h1 → h2 → h3).
- Every `<img>` has `alt`, `width` and `height`.
- Every form control has a `<label>`.
- Comment each major section.

```html
<!-- ========== Featured products ========== -->
<section id="products" aria-labelledby="products-title">
  <h2 id="products-title">What we bake</h2>
  <article class="card">
    <img src="img/sourdough.webp" alt="Round sourdough loaf" width="400" height="300">
    <h3>Country Sourdough</h3>
  </article>
</section>
```

## 2. CSS standards
- Mobile-first: base styles for phones, `min-width` media queries for bigger screens.
- Design tokens in `:root` custom properties; no repeated magic numbers.
- BEM naming: `block__element--modifier` (e.g. `.card__title--large`).
- Low specificity: classes only, avoid `!important` and IDs.
- Group by: layout → box model → typography → colour → effects.

```css
/* ---------- Tokens ---------- */
:root {
  --color-primary: #3F5E45;
  --space-2: 1rem;
}

/* ---------- Component: card ---------- */
.card {
  /* layout */
  display: grid;
  gap: var(--space-2);
  /* box */
  padding: var(--space-2);
  border-radius: 8px;
  /* colour */
  background: #fff;
}
.card__title { font-size: 1.25rem; }
.card--featured { border-top: 4px solid var(--color-primary); }

/* ---------- Tablet and up ---------- */
@media (min-width: 768px) {
  .card { grid-template-columns: 1fr 2fr; }
}
```

## 3. JavaScript standards
- `const` by default, `let` when reassigning, never `var`.
- `camelCase` for variables and functions, `UPPER_CASE` for constants.
- One function = one job; short functions with a JSDoc comment.
- Strict equality `===`; no global variables; semicolons used consistently.
- Use `textContent` (not `innerHTML`) for user-supplied text.
- Handle errors with `try/catch` around async code.

```js
'use strict';

const MAX_GUESTS = 12;

/**
 * Check that the number of guests is valid.
 * @param {number} guests - Value entered in the booking form.
 * @returns {string} Error message, or an empty string if valid.
 */
function validateGuests(guests) {
  if (!Number.isInteger(guests) || guests < 1 || guests > MAX_GUESTS) {
    return `Enter a number from 1 to ${MAX_GUESTS}.`;
  }
  return '';
}
```

## 4. Tooling (enforces the standards automatically)
```bash
npm init -y
npm install --save-dev eslint prettier stylelint stylelint-config-standard htmlhint
```

`.prettierrc`
```json
{ "singleQuote": true, "tabWidth": 2, "printWidth": 100, "semi": true }
```

`eslint.config.js`
```js
export default [
  {
    files: ['**/*.js'],
    languageOptions: { ecmaVersion: 2022, sourceType: 'module', globals: { window: 'readonly', document: 'readonly' } },
    rules: { 'no-var': 'error', 'prefer-const': 'error', eqeqeq: 'error', 'no-unused-vars': 'warn' }
  }
];
```

`.stylelintrc.json`
```json
{ "extends": "stylelint-config-standard" }
```

Run all checks:
```bash
npx prettier --check .
npx eslint .
npx stylelint "**/*.css"
npx htmlhint "**/*.html"
```

## 5. Review checklist
- [ ] No unused CSS or JS
- [ ] No console errors
- [ ] Comments explain *why*, not just *what*
- [ ] Consistent naming and indentation
- [ ] Validated at validator.w3.org
