# Q1. Draft a project specification and wireframe layout for a fictional client

## 1. Client
**Rye & Rosemary Bakehouse** – a local artisan bakery in Dehradun making sourdough, rye loaves, pastries and custom cakes.

## 2. Goals
- Show the daily menu and signature products.
- Let customers book a table or place a pre-order online.
- Build trust with team profiles and customer testimonials.
- Make the shop easy to find (map, hours, phone).

## 3. Target audience
| Group | Need |
|-------|------|
| Local families (30–50) | Weekend pre-orders, birthday cakes |
| Young professionals (22–35) | Quick coffee + bake, mobile-first browsing |
| Food lovers / tourists | Reviews, location, photos |

## 4. Scope (pages)
1. Home – hero carousel, highlights, testimonials
2. Menu – products grouped by category
3. About – story and team
4. Booking – reservation form
5. Contact – map, hours, social links

## 5. Functional requirements
- Hero carousel with autoplay, arrows, dots and pause control
- Booking form with client-side validation
- Testimonial grid with star ratings
- Google Maps embed
- Social share buttons in footer

## 6. Non-functional requirements
- Mobile-first, responsive from 320px to 1440px
- WCAG 2.1 AA accessibility
- Lighthouse score 90+ in Performance, Accessibility, Best Practices, SEO
- Works in Chrome, Firefox, Edge and Safari

## 7. Tech stack
HTML5, CSS3 (Grid + Flexbox, custom properties), vanilla JavaScript. No frameworks.

## 8. Timeline
| Week | Work |
|------|------|
| 1 | Research, spec, wireframes |
| 2 | HTML structure + CSS layout |
| 3 | JavaScript features, accessibility, SEO |
| 4 | Optimization, testing, presentation |

## 9. Wireframes

### Mobile (360px)
```
+----------------------+
| [Logo]          [≡]  |
+----------------------+
|  +----------------+  |
|  |  HERO IMAGE    |  |
|  |  Headline      |  |
|  |  [Book a table]|  |
|  |   ‹  • • •  ›  |  |
|  +----------------+  |
|  Today's bakes       |
|  +----------------+  |
|  | Product card   |  |
|  +----------------+  |
|  | Product card   |  |
|  +----------------+  |
|  Testimonials        |
|  +----------------+  |
|  | ★★★★★  quote   |  |
|  +----------------+  |
|  Footer / social     |
+----------------------+
```

### Desktop (1280px)
```
+--------------------------------------------------------------+
| [Logo]        Home  Menu  About  Booking  Contact            |
+--------------------------------------------------------------+
| +----------------------------------------------------------+ |
| |  HERO CAROUSEL   Headline + [Book a table]     ‹  ● ○ ○ ›| |
| +----------------------------------------------------------+ |
| Today's bakes                                                |
| +----------+ +----------+ +----------+ +----------+          |
| | Card     | | Card     | | Card     | | Card     |          |
| +----------+ +----------+ +----------+ +----------+          |
| Meet the team            |  Testimonials                     |
| [photo][photo][photo]    |  [★★★★★ quote] [★★★★☆ quote]      |
+--------------------------------------------------------------+
| Hours | Address | Social icons | Share buttons               |
+--------------------------------------------------------------+
```
