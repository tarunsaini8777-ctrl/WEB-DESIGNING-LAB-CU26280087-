# Q15. Deliver a live demonstration of the website functionality, interactive features, and responsive design during the lab presentation

## Before the demo (10 minutes early)
- [ ] Start the local server (see Q17) and open `http://localhost:8080`
- [ ] Load the page once so assets are cached; check internet for the map
- [ ] Close other tabs; zoom browser to 110%
- [ ] Open DevTools device toolbar in a second window
- [ ] Keep a backup: screenshots or a screen recording of every step

## Demo flow (about 6 minutes)
| Time | Step | What to say |
|------|------|-------------|
| 0:00 | Home page | "This is Rye & Rosemary, a bakery site built mobile-first." |
| 0:45 | Carousel | Click arrows and dots, press Pause, use ← → keys. "Controls are keyboard accessible and autoplay can be stopped." |
| 1:45 | Responsive design | Open DevTools, switch iPhone SE → iPad → Desktop. "Layout changes from 1 to 2 to 3 columns." |
| 2:45 | Booking form | Submit empty → errors appear. Enter a bad email and phone → messages. Fill correctly → confirmation. |
| 3:45 | Testimonials | Hover and click rating stars; use keyboard arrows. |
| 4:30 | Contact page | Show the map resizing; click "Open in Google Maps". |
| 5:00 | Footer | Show social links, latest posts, and Copy link. |
| 5:30 | Accessibility and performance | Tab through the page to show focus rings; show the Lighthouse report. |

## Likely questions
- *Why mobile-first?* Most visitors browse on phones; it forces content priorities.
- *How is the form validated?* JavaScript checks each field on blur and on submit, and focus moves to the first error.
- *How did you make it accessible?* ARIA landmarks, labels, alt text, contrast checks, keyboard support.
- *What would you add next?* Online payments and a real backend for bookings.
