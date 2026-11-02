# Q13. Prepare a comprehensive design rationale document explaining color choices, typography, and target audience alignment

## 1. Brand concept
**Rye & Rosemary Bakehouse** is an honest, hand-made bakery. The design should feel warm, calm and crafted, not corporate. The visuals borrow from the ingredients: dark rye, fresh rosemary, golden crust and flour.

## 2. Target audience alignment
| Audience | What they need | Design response |
|----------|----------------|-----------------|
| Local families | Easy pre-ordering and cake bookings | Prominent "Book a table" button, simple form with clear errors |
| Young professionals | Fast mobile browsing | Mobile-first layout, large tap targets, quick load |
| Food lovers and visitors | Trust, photos, location | Testimonials with star ratings, team profiles, embedded map |
| Older customers | Readability | 16px+ body text, high contrast, keyboard and screen-reader support |

## 3. Colour choices
| Name | Hex | Role | Why |
|------|-----|------|-----|
| Rye | `#3B2A30` | Header, headings, footer | Deep brown-plum reads as rye bread and gives strong contrast (13.8:1 with white) |
| Rosemary | `#3F5E45` | Buttons and links | A natural green signals freshness and stands out as the action colour (7:1 with white) |
| Crust | `#B8741A` | Accents, focus rings, decorative shapes | Golden baked-crust tone; used only decoratively because its contrast with white is below 4.5:1 |
| Blush | `#EBD9D2` | Soft panels | Softens the dark colours without looking sterile |
| Flour | `#F7F5F0` | Page background | Warm off-white is easier on the eyes than pure white |
| Ink | `#2A2024` | Body text | 16:1 contrast on white for comfortable reading |

Principles: one primary action colour, a limited 5-colour palette, dark-on-light text, colour never used as the only way to convey meaning (error messages have text, not just red borders).

## 4. Typography
| Use | Font | Reason |
|-----|------|--------|
| Headings | Georgia (serif) | Feels traditional and crafted, like a chalkboard menu. Installed on nearly every device, so no loading delay |
| Body and UI | System sans-serif stack | Fast, familiar, very readable at small sizes |

- **Scale:** 1.25 modular ratio (1rem → 1.25 → 1.563 → 1.953 → 2.441rem) keeps hierarchy consistent.
- **Line height:** 1.6–1.7 for body text. **Line length:** max 65 characters.
- **Weights:** regular for body, bold only for labels and emphasis.

## 5. Layout and white space
- 8px spacing rhythm (0.5, 1, 1.5, 2, 3, 4rem) for consistent gaps.
- Generous section padding so each offering is easy to scan.
- Cards in a responsive grid: 1 column on phones, 2 on tablets, 3 on desktop.

## 6. Interaction and motion
- Carousel uses a gentle 0.6s slide, can be paused, and is disabled for users who prefer reduced motion.
- Form errors appear next to the field in plain language and move focus to the first error.

## 7. Accessibility decisions
Skip link, ARIA landmarks, alt text on every informative image, visible focus rings, 44px tap targets, WCAG AA contrast.

## 8. Conclusion
Each decision supports the same goal: help hungry people find, trust and order from the bakery quickly on any device.
