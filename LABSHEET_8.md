# MCA108P-AS08 (Part 2): Golden Crust Artisan Bakery Website

Client website project (HTML5, CSS3, JavaScript). Code is shown per experiment; copy each block into the file named above it.
Documents (specification, rationale, test plans, etc.) are shown as formatted text and are also saved in the `docs/` folder.

**Run:** open the folder in VS Code and use *Live Server*, or run `python3 -m http.server 8000` and open http://localhost:8000

## Project Structure

````text
MCA108P-AS08_1/
|-- index.html  booking.html  contact.html
|-- css/   base, layout, components, a11y, carousel, forms, contact, ratings, footer (.css)
|-- js/    main, carousel, booking, share, ratings (.js)
|-- docs/  specification, design rationale, test plans, presentation, demo, audit (.md)
|-- scripts/build.js    package.json    robots.txt    sitemap.xml    .editorconfig
````

## Index

1. [Experiment 1](#experiment-1)
2. [Experiment 2](#experiment-2)
3. [Experiment 3](#experiment-3)
4. [Experiment 4](#experiment-4)
5. [Experiment 5](#experiment-5)
6. [Experiment 6](#experiment-6)
7. [Experiment 7](#experiment-7)
8. [Experiment 8](#experiment-8)
9. [Experiment 9](#experiment-9)
10. [Experiment 10](#experiment-10)
11. [Experiment 11](#experiment-11)
12. [Experiment 12](#experiment-12)
13. [Experiment 13](#experiment-13)
14. [Experiment 14](#experiment-14)
15. [Experiment 15](#experiment-15)
16. [Experiment 16](#experiment-16)
17. [Experiment 17](#experiment-17)
18. [Experiment 18](#experiment-18)
19. [Experiment 19](#experiment-19)
20. [Experiment 20](#experiment-20)

---

## Experiment 1

**Aim:** Draft a project specification and wireframe layout for a fictional client (e.g., local artisan bakery, eco-friendly cafe, or boutique fitness studio).

**`docs/project-specification.md`**

### Project Specification and Wireframes (Experiment 1)

#### 1. Client
**Golden Crust Artisan Bakery** is a fictional neighbourhood bakery and cafe in Hauz Khas, New Delhi.
It sells slow-fermented sourdough, butter croissants, cookies and custom cakes, runs a small cafe corner,
and holds weekend baking workshops.

#### 2. Goals of the website
| Goal | Measure of success |
|------|--------------------|
| Show what the bakery sells | Visitors can see all product categories with prices on the home page |
| Get table reservations online | Booking form completed without errors in under 1 minute |
| Help people find the shop | Map, address, hours and phone visible on one page |
| Build trust | Testimonials, team photos and customer star ratings |
| Be found on Google | SEO meta tags, sitemap, structured data |

#### 3. Target audience
- Local residents aged 22-45 who want fresh bread and cakes (mostly on mobile phones)
- Office workers ordering birthday cakes
- Families booking weekend brunch

#### 4. Scope
| Page | Purpose | Key content |
|------|---------|-------------|
| `index.html` | Home | Hero carousel, offerings, story, team, testimonials, call to action |
| `booking.html` | Reservations | Validated reservation form |
| `contact.html` | Location | Address, hours, phone, Google Map |

**Out of scope:** online payments, user accounts, a server-side booking database.

#### 5. Technical requirements
- Semantic HTML5, CSS3 (Grid + Flexbox, mobile-first), vanilla JavaScript (no frameworks)
- WCAG 2.1 AA accessibility
- Works in Chrome, Firefox, Edge and Safari (last 2 versions)
- Lighthouse scores of 90+ for Performance, Accessibility, Best Practices and SEO

#### 6. Site map
```
Home (index.html)
 |-- #offerings  Our Bakes
 |-- #about      Our Story
 |-- #team       Our Team
 |-- #testimonials  Customer Reviews
Reserve a Table (booking.html)
Contact (contact.html)
```

#### 7. Wireframes

##### Mobile (360 px) - Home
```
+----------------------+
| Golden Crust  [Menu] |
+----------------------+
|  [ HERO CAROUSEL ]   |
|   Baked fresh every  |
|   morning            |
|   [See today's bakes]|
|   <  ||  o o o  >    |
+----------------------+
|  OUR BAKES           |
|  +----------------+  |
|  | image          |  |
|  | Country Sour.. |  |
|  | Rs 220         |  |
|  +----------------+  |
|  (cards stack 1 col) |
+----------------------+
|  OUR STORY           |
|  text + image        |
+----------------------+
|  MEET OUR BAKERS     |
|  (o) (o) (o)         |
+----------------------+
|  CUSTOMER REVIEWS    |
|  *****  *****  ****  |
|  Rate us: * * * * *  |
+----------------------+
|  [Reserve a Table]   |
+----------------------+
|  FOOTER (stacked)    |
+----------------------+
```

##### Desktop (1200 px) - Home
```
+--------------------------------------------------------------+
| Golden Crust        Home  Our Bakes  Team  Reserve  Contact  |
+--------------------------------------------------------------+
|                      [ HERO CAROUSEL ]                       |
|        Baked fresh, every single morning   [See bakes]       |
|                      <   || o o o   >                        |
+--------------------------------------------------------------+
|                        OUR BAKES                             |
|  +-----------+  +-----------+  +-----------+                 |
|  |  image    |  |  image    |  |  image    |   (3 columns)   |
|  +-----------+  +-----------+  +-----------+                 |
+--------------------------------------------------------------+
|  OUR STORY (text)              |        (image)              |
+--------------------------------------------------------------+
|  TEAM  (o)  (o)  (o)                                         |
+--------------------------------------------------------------+
|  REVIEWS  [card] [card] [card]      Rate us: * * * * *       |
+--------------------------------------------------------------+
|  About | Quick links | Follow us + feed | Share this page      |
+--------------------------------------------------------------+
```

##### Booking page
```
+------------------------------+
|  Reserve a Table             |
|  Name        [____________]  |
|  Email [______] Phone [____] |
|  Date  [______] Time  [____] |
|  Guests      [__]            |
|  Requests    [____________]  |
|  [ Request Reservation ]     |
+------------------------------+
```

##### Contact page
```
+---------------------------------------------+
|  Contact & Location                         |
|  Address / phone / email  |  [ Google Map ] |
|  Opening hours            |                 |
|  [Get Directions]         |                 |
+---------------------------------------------+
```


---

## Experiment 2

**Aim:** Implement a semantic HTML5 structure reflecting the client's business offerings, team, testimonials, and contact details.

**`index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- [seo] -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Golden Crust Artisan Bakery | Fresh Sourdough, Pastries &amp; Cakes in Delhi</title>
  <meta name="description" content="Golden Crust is a neighbourhood artisan bakery in Hauz Khas, New Delhi. Slow-fermented sourdough, butter croissants and custom cakes baked fresh every morning.">
  <meta name="keywords" content="artisan bakery, sourdough, croissants, custom cakes, Delhi bakery">
  <meta name="author" content="Golden Crust Artisan Bakery">
  <meta name="robots" content="index, follow">
  <meta name="theme-color" content="#a1440c">
  <link rel="canonical" href="https://www.goldencrustbakery.example/">

  <!-- Open Graph (Facebook, WhatsApp, LinkedIn) -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Golden Crust Artisan Bakery">
  <meta property="og:title" content="Golden Crust Artisan Bakery | Fresh Baked Every Morning">
  <meta property="og:description" content="Slow-fermented sourdough, butter croissants and custom cakes in Hauz Khas, New Delhi.">
  <meta property="og:url" content="https://www.goldencrustbakery.example/">
  <meta property="og:image" content="https://www.goldencrustbakery.example/images/og-cover.jpg">
  <meta property="og:image:alt" content="Fresh loaves of sourdough bread on a wooden counter">

  <!-- Twitter / X card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Golden Crust Artisan Bakery">
  <meta name="twitter:description" content="Slow-fermented sourdough, butter croissants and custom cakes in Delhi.">
  <meta name="twitter:image" content="https://www.goldencrustbakery.example/images/og-cover.jpg">

  <!-- structured data for search engines -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Bakery",
    "name": "Golden Crust Artisan Bakery",
    "url": "https://www.goldencrustbakery.example/",
    "telephone": "+91-98765-43210",
    "priceRange": "INR 80 - 1500",
    "address": { "@type": "PostalAddress", "streetAddress": "12 Green Park Market, Hauz Khas",
                 "addressLocality": "New Delhi", "postalCode": "110016", "addressCountry": "IN" },
    "openingHours": ["Tu-Sa 07:30-20:00", "Su 08:00-18:00"]
  }
  </script>
  <!-- [/seo] -->

  <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ctext y='.9em' font-size='90'%3E%F0%9F%A5%90%3C/text%3E%3C/svg%3E">
  <script>document.documentElement.classList.add('js');</script>

  <!-- build:css -->
  <link rel="stylesheet" href="css/base.css">
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="css/a11y.css">
  <link rel="stylesheet" href="css/carousel.css">
  <link rel="stylesheet" href="css/ratings.css">
  <link rel="stylesheet" href="css/footer.css">
  <!-- endbuild -->
</head>
<body>
  <!-- [header] -->
  <a class="skip-link" href="#main">Skip to main content</a>

  <header class="site-header" role="banner">
    <div class="container header-row">
      <a class="brand" href="index.html" aria-label="Golden Crust Artisan Bakery, home">Golden <span>Crust</span></a>
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">Menu</button>
      <nav aria-label="Main navigation">
        <ul class="nav-list" id="primary-nav">
          <li><a href="index.html" aria-current="page">Home</a></li>
          <li><a href="index.html#offerings">Our Bakes</a></li>
          <li><a href="index.html#team">Our Team</a></li>
          <li><a href="booking.html">Reserve a Table</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <!-- [/header] -->

  <main id="main">

    <!-- [carousel] -->
    <section class="carousel" data-carousel aria-roledescription="carousel" aria-label="Featured products and services">
      <div class="carousel-track" aria-live="off">
        <article class="slide slide-1 is-active" role="group" aria-roledescription="slide" aria-label="1 of 3">
          <div class="slide-content">
            <span class="emoji" aria-hidden="true">&#129366;</span>
            <h1>Baked fresh, every single morning</h1>
            <p>Slow-fermented sourdough and butter croissants, out of the oven by 7:30 am.</p>
            <a class="btn" href="index.html#offerings">See today&rsquo;s bakes</a>
          </div>
        </article>
        <article class="slide slide-2" role="group" aria-roledescription="slide" aria-label="2 of 3" aria-hidden="true">
          <div class="slide-content">
            <span class="emoji" aria-hidden="true">&#127856;</span>
            <h2>Custom cakes for every celebration</h2>
            <p>Birthdays, weddings and festivals. Tell us your idea and we will bake it.</p>
            <a class="btn" href="contact.html">Order a cake</a>
          </div>
        </article>
        <article class="slide slide-3" role="group" aria-roledescription="slide" aria-label="3 of 3" aria-hidden="true">
          <div class="slide-content">
            <span class="emoji" aria-hidden="true">&#9749;</span>
            <h2>Breakfast, brunch &amp; good coffee</h2>
            <p>Reserve a table in our sunny caf&eacute; corner and enjoy a slow weekend.</p>
            <a class="btn" href="booking.html">Reserve a table</a>
          </div>
        </article>
      </div>
      <div class="carousel-controls">
        <button class="carousel-btn carousel-prev" type="button" aria-label="Previous slide">&#10094;</button>
        <button class="carousel-btn carousel-toggle" type="button" aria-label="Pause automatic slide show">&#10074;&#10074;</button>
        <div class="carousel-dots" role="group" aria-label="Choose a slide"></div>
        <button class="carousel-btn carousel-next" type="button" aria-label="Next slide">&#10095;</button>
      </div>
      <p class="sr-only carousel-status" aria-live="polite"></p>
    </section>
    <!-- [/carousel] -->

    <section class="section" id="offerings" aria-labelledby="offerings-title">
      <div class="container">
        <div class="section-head">
          <p class="eyebrow">What we bake</p>
          <h2 id="offerings-title">Our Bakes &amp; Services</h2>
          <p class="lead">Everything is made from scratch with locally milled flour and real butter.</p>
        </div>
        <div class="grid grid-cards">
          <article class="card">
            <img src="https://picsum.photos/seed/sourdough/600/400" width="600" height="400" loading="lazy" alt="A freshly baked round loaf of sourdough bread with a crisp crust">
            <div class="card-body"><h3>Country Sourdough</h3><p>48-hour slow fermentation for a tangy flavour and chewy crumb.</p><p class="price">&#8377;220</p></div>
          </article>
          <article class="card">
            <img src="https://picsum.photos/seed/croissant/600/400" width="600" height="400" loading="lazy" alt="Golden flaky butter croissants on a baking tray">
            <div class="card-body"><h3>Butter Croissant</h3><p>27 layers of laminated dough, baked until golden and shatteringly crisp.</p><p class="price">&#8377;120</p></div>
          </article>
          <article class="card">
            <img src="https://picsum.photos/seed/cake/600/400" width="600" height="400" loading="lazy" alt="A decorated celebration cake topped with fresh berries">
            <div class="card-body"><h3>Custom Cakes</h3><p>Eggless and classic options, made to order with 48 hours notice.</p><p class="price">From &#8377;900</p></div>
          </article>
          <article class="card">
            <img src="https://picsum.photos/seed/cookies/600/400" width="600" height="400" loading="lazy" alt="A stack of chocolate chip cookies">
            <div class="card-body"><h3>Cookies &amp; Brownies</h3><p>Chunky chocolate cookies and fudgy brownies, baked in small batches.</p><p class="price">&#8377;90</p></div>
          </article>
          <article class="card">
            <img src="https://picsum.photos/seed/coffee/600/400" width="600" height="400" loading="lazy" alt="A cup of cappuccino with latte art next to a pastry">
            <div class="card-body"><h3>Caf&eacute; &amp; Brunch</h3><p>Coffee, sandwiches and all-day breakfast served at our caf&eacute; tables.</p><p class="price">From &#8377;180</p></div>
          </article>
          <article class="card">
            <img src="https://picsum.photos/seed/workshop/600/400" width="600" height="400" loading="lazy" alt="Hands kneading dough during a baking workshop">
            <div class="card-body"><h3>Baking Workshops</h3><p>Learn to bake sourdough in our Saturday hands-on class.</p><p class="price">&#8377;1,500</p></div>
          </article>
        </div>
      </div>
    </section>

    <section class="section section-alt" id="about" aria-labelledby="about-title">
      <div class="container split">
        <div>
          <p class="eyebrow">Our story</p>
          <h2 id="about-title">A neighbourhood bakery with a big heart</h2>
          <p>Golden Crust started in 2018 in a tiny kitchen with one oven and a jar of sourdough starter. Today we bake for hundreds of neighbours every week, but we still shape every loaf by hand.</p>
          <p>We source flour from a mill in Punjab, butter from a local dairy and never use preservatives or artificial colours.</p>
        </div>
        <img src="https://picsum.photos/seed/bakery-shop/700/500" width="700" height="500" loading="lazy" alt="Inside the bakery: shelves of bread and a baker behind the counter" style="border-radius:12px">
      </div>
    </section>

    <section class="section" id="team" aria-labelledby="team-title">
      <div class="container">
        <div class="section-head">
          <p class="eyebrow">The people</p>
          <h2 id="team-title">Meet Our Bakers</h2>
        </div>
        <div class="grid grid-cards">
          <article class="team-card">
            <img src="https://picsum.photos/seed/baker-meera/280/280" width="140" height="140" loading="lazy" alt="Portrait of Meera Kapoor, head baker">
            <h3>Meera Kapoor</h3><p class="role">Founder &amp; Head Baker</p>
          </article>
          <article class="team-card">
            <img src="https://picsum.photos/seed/baker-arjun/280/280" width="140" height="140" loading="lazy" alt="Portrait of Arjun Malhotra, pastry chef">
            <h3>Arjun Malhotra</h3><p class="role">Pastry Chef</p>
          </article>
          <article class="team-card">
            <img src="https://picsum.photos/seed/baker-sana/280/280" width="140" height="140" loading="lazy" alt="Portrait of Sana Khan, cake designer">
            <h3>Sana Khan</h3><p class="role">Cake Designer</p>
          </article>
        </div>
      </div>
    </section>

    <!-- [testimonials] -->
    <section class="section section-alt" id="testimonials" aria-labelledby="testimonials-title">
      <div class="container">
        <div class="section-head">
          <p class="eyebrow">Kind words</p>
          <h2 id="testimonials-title">What Our Customers Say</h2>
        </div>

        <div class="grid grid-cards">
          <figure class="testimonial">
            <p class="stars" role="img" aria-label="5 out of 5 stars"><span aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</span></p>
            <blockquote>The best sourdough in South Delhi. I come every Saturday morning for a loaf and a croissant.</blockquote>
            <footer>Ritu Sharma <span>Regular customer</span></footer>
          </figure>
          <figure class="testimonial">
            <p class="stars" role="img" aria-label="5 out of 5 stars"><span aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</span></p>
            <blockquote>They made my daughter&rsquo;s birthday cake exactly as she imagined it. Beautiful and delicious.</blockquote>
            <footer>Vikram Singh <span>Custom cake order</span></footer>
          </figure>
          <figure class="testimonial">
            <p class="stars" role="img" aria-label="4 out of 5 stars"><span aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9734;</span></p>
            <blockquote>Lovely caf&eacute; corner and friendly staff. The brunch menu could use a few more vegan options.</blockquote>
            <footer>Anita Desai <span>Weekend brunch</span></footer>
          </figure>
        </div>

        <div class="rating-box" data-rating>
          <form novalidate>
            <fieldset>
              <legend>Rate your experience</legend>
              <div class="stars-input">
                <input type="radio" name="rating" id="star5" value="5"><label for="star5"><span class="sr-only">5 stars</span></label>
                <input type="radio" name="rating" id="star4" value="4"><label for="star4"><span class="sr-only">4 stars</span></label>
                <input type="radio" name="rating" id="star3" value="3"><label for="star3"><span class="sr-only">3 stars</span></label>
                <input type="radio" name="rating" id="star2" value="2"><label for="star2"><span class="sr-only">2 stars</span></label>
                <input type="radio" name="rating" id="star1" value="1"><label for="star1"><span class="sr-only">1 star</span></label>
              </div>
            </fieldset>
            <p class="rating-message" role="status" aria-live="polite"></p>
          </form>
        </div>
      </div>
    </section>
    <!-- [/testimonials] -->

    <section class="cta-band" aria-labelledby="cta-title">
      <h2 id="cta-title">Hungry already?</h2>
      <p>Reserve a table for brunch or place an order for tomorrow&rsquo;s bake.</p>
      <a class="btn" href="booking.html">Reserve a Table</a>
    </section>
  </main>

  <!-- [footer] -->
  <footer class="site-footer" role="contentinfo">
    <div class="container">
      <div class="footer-grid">
        <section aria-labelledby="f-about">
          <h2 id="f-about">Golden Crust</h2>
          <p>Artisan bakery &amp; caf&eacute;.<br>12 Green Park Market, Hauz Khas,<br>New Delhi 110016</p>
          <p><a href="tel:+919876543210">+91 98765 43210</a><br><a href="mailto:hello@goldencrustbakery.example">hello@goldencrustbakery.example</a></p>
        </section>

        <nav aria-labelledby="f-links">
          <h2 id="f-links">Quick Links</h2>
          <ul class="footer-links">
            <li><a href="index.html#offerings">Our Bakes</a></li>
            <li><a href="index.html#team">Our Team</a></li>
            <li><a href="booking.html">Reserve a Table</a></li>
            <li><a href="contact.html">Find Us</a></li>
          </ul>
        </nav>

        <section aria-labelledby="f-social">
          <h2 id="f-social">Follow Us</h2>
          <ul class="social-list">
            <li><a class="instagram" href="https://www.instagram.com/" aria-label="Golden Crust on Instagram" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm0 2a3 3 0 00-3 3v10a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3zm5 3.500a4.500 4.500 0 110 9 4.500 4.500 0 010-9zm0 2a2.500 2.500 0 100 5 2.500 2.500 0 000-5zM17.500 6a1 1 0 110 2 1 1 0 010-2z"/></svg></a></li>
            <li><a class="facebook" href="https://www.facebook.com/" aria-label="Golden Crust on Facebook" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 8V6c0-.6.4-1 1-1h2V2h-3c-2.800 0-4 1.800-4 4v2H8v3h2v9h4v-9h2.500l.5-3z"/></svg></a></li>
            <li><a class="x-twitter" href="https://x.com/" aria-label="Golden Crust on X" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 3l7.200 9.600L3.400 21H6l5.400-6.200L16 21h5l-7.500-10L20.200 3h-2.500l-5 5.800L8 3z"/></svg></a></li>
            <li><a class="youtube" href="https://www.youtube.com/" aria-label="Golden Crust on YouTube" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21.600 7.200a2.500 2.500 0 00-1.800-1.800C18.200 5 12 5 12 5s-6.200 0-7.800.4A2.500 2.500 0 002.400 7.200C2 8.800 2 12 2 12s0 3.200.4 4.800a2.500 2.500 0 001.800 1.800C5.800 19 12 19 12 19s6.200 0 7.800-.4a2.500 2.500 0 001.800-1.800c.4-1.600.4-4.800.4-4.800s0-3.200-.4-4.800zM10 15V9l5.200 3z"/></svg></a></li>
          </ul>
          <p class="hint" style="margin-top:var(--space-2);color:var(--butter)">Latest from Instagram</p>
          <div class="feed">
            <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram post: sourdough loaves"><span aria-hidden="true">&#127838;</span></a>
            <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram post: croissants"><span aria-hidden="true">&#129360;</span></a>
            <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram post: birthday cake"><span aria-hidden="true">&#127874;</span></a>
            <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram post: coffee"><span aria-hidden="true">&#9749;</span></a>
          </div>
        </section>

        <section aria-labelledby="f-share">
          <h2 id="f-share">Share This Page</h2>
          <div class="share" data-share>
            <a href="#" data-network="facebook" target="_blank" rel="noopener">Facebook</a>
            <a href="#" data-network="x" target="_blank" rel="noopener">X</a>
            <a href="#" data-network="whatsapp" target="_blank" rel="noopener">WhatsApp</a>
            <button type="button" data-network="copy">Copy link</button>
          </div>
          <p class="share-status" role="status" aria-live="polite"></p>
        </section>
      </div>

      <p class="footer-bottom">&copy; <span data-year>2026</span> Golden Crust Artisan Bakery. A fictional client project for MCA108P.</p>
    </div>
  </footer>
  <!-- [/footer] -->

  <!-- build:js -->
  <script src="js/main.js" defer></script>
  <script src="js/carousel.js" defer></script>
  <script src="js/share.js" defer></script>
  <script src="js/ratings.js" defer></script>
  <script src="js/booking.js" defer></script>
  <!-- endbuild -->
</body>
</html>
````


---

## Experiment 3

**Aim:** Develop a fully responsive CSS layout using CSS Grid and Flexbox adhering to mobile-first design principles.

**`css/layout.css`**

````css
/* ==========================================================
   layout.css - mobile-first responsive layout (Experiment 3)
   Default rules = phones. min-width media queries add columns
   for tablets (600px) and desktops (900px).
   ========================================================== */
.container { width: 100%; max-width: var(--max-width); margin-inline: auto; padding-inline: var(--space-2); }
.section { padding-block: var(--space-5); }
.section-alt { background: var(--butter); }
.section-head { text-align: center; max-width: 640px; margin: 0 auto var(--space-4); }

/* ---------- header + navigation (Flexbox) ---------- */
.site-header { background: var(--white); border-bottom: 1px solid var(--line); position: sticky; top: 0; z-index: 50; }
.header-row { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: var(--space-1); padding-block: var(--space-1); }
.brand { font-family: var(--font-heading); font-size: var(--text-xl); font-weight: 700; color: var(--ink); text-decoration: none; }
.brand span { color: var(--caramel); }

.nav-toggle { background: none; border: 2px solid var(--ink); color: var(--ink); border-radius: 8px; padding: 0.4rem 0.8rem; font: inherit; font-weight: 700; cursor: pointer; }
.nav-list { list-style: none; padding: 0; display: flex; flex-direction: column; width: 100%; gap: 0; }
.nav-list a { display: block; padding: 0.75rem 0.25rem; color: var(--ink); text-decoration: none; font-weight: 600; border-top: 1px solid var(--line); }
.nav-list a:hover, .nav-list a[aria-current="page"] { color: var(--caramel); }
.nav-list a[aria-current="page"] { text-decoration: underline; text-underline-offset: 6px; }

/* nav collapses only when JavaScript is available (progressive enhancement) */
.js .nav-list { display: none; }
.js .nav-list.is-open { display: flex; }
.nav-toggle { display: none; }
.js .nav-toggle { display: inline-block; }

/* ---------- reusable grids (CSS Grid, auto-fit = responsive without breakpoints) ---------- */
.grid { display: grid; gap: var(--space-3); grid-template-columns: 1fr; }
.grid-cards { grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); }
.split { display: grid; gap: var(--space-4); grid-template-columns: 1fr; align-items: center; }

/* ---------- tablets and up ---------- */
@media (min-width: 600px) {
  .container { padding-inline: var(--space-3); }
  .section { padding-block: var(--space-6); }
}

/* ---------- desktops ---------- */
@media (min-width: 900px) {
  .header-row { flex-wrap: nowrap; }
  .nav-list, .js .nav-list { display: flex; flex-direction: row; width: auto; gap: var(--space-3); }
  .nav-list a { border-top: 0; padding: 0.4rem 0; }
  .js .nav-toggle, .nav-toggle { display: none; }
  .split { grid-template-columns: 1fr 1fr; }
  .split.reverse > :first-child { order: 2; }
}
````

**`css/components.css`**

````css
/* components.css - cards, team, offerings (Experiment 3) */
.card { background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; display: flex; flex-direction: column; transition: transform 0.25s; }
.card:hover { transform: translateY(-4px); }
.card img { width: 100%; aspect-ratio: 3 / 2; object-fit: cover; background: var(--butter); }
.card-body { padding: var(--space-3); display: flex; flex-direction: column; gap: var(--space-1); flex: 1; }
.card .price { margin-top: auto; font-weight: 700; color: var(--caramel); font-size: var(--text-lg); }

.team-card { text-align: center; background: var(--white); border-radius: var(--radius); padding: var(--space-3); box-shadow: var(--shadow); }
.team-card img { width: 140px; height: 140px; border-radius: 50%; object-fit: cover; margin: 0 auto var(--space-2); background: var(--butter); }
.team-card .role { color: var(--ink-soft); font-size: var(--text-sm); }

.hours { list-style: none; padding: 0; }
.hours li { display: flex; justify-content: space-between; gap: var(--space-2); padding: 0.4rem 0; border-bottom: 1px dashed var(--line); }

.cta-band { background: var(--sage); color: var(--white); text-align: center; padding: var(--space-5) var(--space-2); }
.cta-band h2 { color: var(--white); }
.cta-band .btn { background: var(--white); color: var(--sage); border-color: var(--white); margin-top: var(--space-2); }
.cta-band .btn:hover { background: var(--butter); color: var(--ink); }
````

**`js/main.js`**

````javascript
// main.js - mobile navigation toggle and small helpers (Experiment 3)
(function () {
  'use strict';

  var toggle = document.querySelector('.nav-toggle');
  var list = document.getElementById('primary-nav');

  if (toggle && list) {
    toggle.addEventListener('click', function () {
      var open = list.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', String(open));
      toggle.textContent = open ? 'Close' : 'Menu';
    });

    // close with the Escape key and return focus to the button
    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape' && list.classList.contains('is-open')) {
        list.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.textContent = 'Menu';
        toggle.focus();
      }
    });
  }

  // keep the copyright year up to date
  var year = document.querySelector('[data-year]');
  if (year) { year.textContent = new Date().getFullYear(); }
})();
````


---

## Experiment 4

**Aim:** Incorporate modern web design principles including consistent color palettes, typography scales, and white space management.

**`css/base.css`**

````css
/* ==========================================================
   base.css - design tokens, reset and typography (Experiment 4)
   Palette, type scale and spacing scale are defined once here
   and reused everywhere through CSS custom properties.
   ========================================================== */
:root {
  /* Colour palette (all text/background pairs pass WCAG AA, see docs/design-rationale.md) */
  --ink:        #3e2723;   /* main text            13.1:1 on cream */
  --ink-soft:   #6d4c41;   /* secondary text        7.2:1 on cream */
  --caramel:    #a1440c;   /* primary / buttons     6.3:1 with white text */
  --caramel-dk: #7f3508;   /* hover state */
  --cream:      #fff8ee;   /* page background */
  --butter:     #f6e3bf;   /* soft panels */
  --sage:       #3d5a40;   /* secondary accent      7.7:1 on white */
  --white:      #ffffff;
  --star:       #b45f06;
  --danger:     #b00020;
  --success:    #1b5e20;
  --line:       #e6d3b3;

  /* Typography: modular scale (ratio 1.25) */
  --font-body:    system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
  --font-heading: Georgia, "Times New Roman", serif;
  --text-sm:  0.875rem;
  --text-base: 1rem;
  --text-lg:  clamp(1.1rem, 1rem + 0.5vw, 1.25rem);
  --text-xl:  clamp(1.3rem, 1.1rem + 1vw, 1.563rem);
  --text-2xl: clamp(1.6rem, 1.3rem + 1.5vw, 1.953rem);
  --text-3xl: clamp(1.9rem, 1.4rem + 2.5vw, 2.441rem);
  --text-4xl: clamp(2.2rem, 1.5rem + 3.5vw, 3.052rem);

  /* Spacing scale (8px base) - white space is managed only with these values */
  --space-1: 0.5rem;
  --space-2: 1rem;
  --space-3: 1.5rem;
  --space-4: 2rem;
  --space-5: 3rem;
  --space-6: 4.5rem;

  --radius: 12px;
  --shadow: 0 4px 14px rgba(62, 39, 35, 0.12);
  --max-width: 1120px;
}

*, *::before, *::after { box-sizing: border-box; }
* { margin: 0; }
html { scroll-behavior: smooth; -webkit-text-size-adjust: 100%; }

body {
  font-family: var(--font-body);
  font-size: var(--text-base);
  line-height: 1.65;
  color: var(--ink);
  background: var(--cream);
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}
main { flex: 1; }

img, svg, iframe { max-width: 100%; display: block; }
img { height: auto; }

h1, h2, h3, h4 { font-family: var(--font-heading); line-height: 1.2; color: var(--ink); }
h1 { font-size: var(--text-4xl); }
h2 { font-size: var(--text-3xl); margin-bottom: var(--space-2); }
h3 { font-size: var(--text-xl);  margin-bottom: var(--space-1); }
p + p { margin-top: var(--space-2); }
.lead { font-size: var(--text-lg); color: var(--ink-soft); }
.eyebrow { text-transform: uppercase; letter-spacing: 0.12em; font-size: var(--text-sm); font-weight: 700; color: var(--caramel); }

a { color: var(--caramel); text-underline-offset: 3px; }
a:hover { color: var(--caramel-dk); }

/* buttons */
.btn {
  display: inline-block;
  padding: 0.75rem 1.6rem;
  background: var(--caramel);
  color: var(--white);
  border: 2px solid var(--caramel);
  border-radius: 999px;
  font: inherit;
  font-weight: 700;
  text-decoration: none;
  cursor: pointer;
  transition: background 0.2s, transform 0.2s;
}
.btn:hover { background: var(--caramel-dk); border-color: var(--caramel-dk); color: var(--white); transform: translateY(-2px); }
.btn-outline { background: transparent; color: var(--caramel); }
.btn-outline:hover { background: var(--caramel); color: var(--white); }
````


---

## Experiment 5

**Aim:** Implement web accessibility standards (WCAG) including ARIA landmarks, alt text for all images, and sufficient color contrast ratios.

**`css/a11y.css`**

````css
/* ==========================================================
   a11y.css - accessibility helpers (Experiment 5, WCAG 2.1 AA)
   ========================================================== */

/* visible only to screen readers */
.sr-only {
  position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px;
  overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0;
}

/* "Skip to content" link: appears on keyboard focus (WCAG 2.4.1) */
.skip-link {
  position: absolute; left: var(--space-1); top: -100px; z-index: 100;
  background: var(--ink); color: var(--white); padding: 0.75rem 1.2rem; border-radius: 0 0 8px 8px;
}
.skip-link:focus { top: 0; }

/* clear focus indicator for keyboard users (WCAG 2.4.7) */
:focus-visible { outline: 3px solid #1a73e8; outline-offset: 3px; border-radius: 4px; }

/* comfortable touch targets (WCAG 2.5.5) */
button, .btn, select, input[type="submit"] { min-height: 44px; }

/* respect the visitor's "reduce motion" operating-system setting (WCAG 2.3.3) */
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; scroll-behavior: auto !important; }
}

/* Windows high-contrast mode */
@media (forced-colors: active) {
  .btn, .card, .team-card { border: 2px solid CanvasText; }
}
````

**`index.html  (header and skip link)`**

````html
  <a class="skip-link" href="#main">Skip to main content</a>

  <header class="site-header" role="banner">
    <div class="container header-row">
      <a class="brand" href="index.html" aria-label="Golden Crust Artisan Bakery, home">Golden <span>Crust</span></a>
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">Menu</button>
      <nav aria-label="Main navigation">
        <ul class="nav-list" id="primary-nav">
          <li><a href="index.html" aria-current="page">Home</a></li>
          <li><a href="index.html#offerings">Our Bakes</a></li>
          <li><a href="index.html#team">Our Team</a></li>
          <li><a href="booking.html">Reserve a Table</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>
````


---

## Experiment 6

**Aim:** Create an interactive hero carousel showcasing client products and services using JavaScript and CSS transitions.

**`index.html  (hero carousel markup)`**

````html
    <section class="carousel" data-carousel aria-roledescription="carousel" aria-label="Featured products and services">
      <div class="carousel-track" aria-live="off">
        <article class="slide slide-1 is-active" role="group" aria-roledescription="slide" aria-label="1 of 3">
          <div class="slide-content">
            <span class="emoji" aria-hidden="true">&#129366;</span>
            <h1>Baked fresh, every single morning</h1>
            <p>Slow-fermented sourdough and butter croissants, out of the oven by 7:30 am.</p>
            <a class="btn" href="index.html#offerings">See today&rsquo;s bakes</a>
          </div>
        </article>
        <article class="slide slide-2" role="group" aria-roledescription="slide" aria-label="2 of 3" aria-hidden="true">
          <div class="slide-content">
            <span class="emoji" aria-hidden="true">&#127856;</span>
            <h2>Custom cakes for every celebration</h2>
            <p>Birthdays, weddings and festivals. Tell us your idea and we will bake it.</p>
            <a class="btn" href="contact.html">Order a cake</a>
          </div>
        </article>
        <article class="slide slide-3" role="group" aria-roledescription="slide" aria-label="3 of 3" aria-hidden="true">
          <div class="slide-content">
            <span class="emoji" aria-hidden="true">&#9749;</span>
            <h2>Breakfast, brunch &amp; good coffee</h2>
            <p>Reserve a table in our sunny caf&eacute; corner and enjoy a slow weekend.</p>
            <a class="btn" href="booking.html">Reserve a table</a>
          </div>
        </article>
      </div>
      <div class="carousel-controls">
        <button class="carousel-btn carousel-prev" type="button" aria-label="Previous slide">&#10094;</button>
        <button class="carousel-btn carousel-toggle" type="button" aria-label="Pause automatic slide show">&#10074;&#10074;</button>
        <div class="carousel-dots" role="group" aria-label="Choose a slide"></div>
        <button class="carousel-btn carousel-next" type="button" aria-label="Next slide">&#10095;</button>
      </div>
      <p class="sr-only carousel-status" aria-live="polite"></p>
    </section>
````

**`css/carousel.css`**

````css
/* carousel.css - hero carousel with opacity transitions (Experiment 6) */
.carousel { position: relative; background: var(--ink); color: var(--white); overflow: hidden; }
.carousel-track { position: relative; min-height: 440px; }

.slide {
  position: absolute; inset: 0;
  display: flex; align-items: center; justify-content: center; text-align: center;
  padding: var(--space-5) var(--space-2) 5rem;
  opacity: 0; visibility: hidden;
  transition: opacity 0.8s ease, visibility 0.8s;      /* cross-fade */
}
.slide.is-active { opacity: 1; visibility: visible; }
.slide-1 { background: linear-gradient(135deg, #5d3a1a, #a1440c); }
.slide-2 { background: linear-gradient(135deg, #2e4a31, #3d5a40 60%, #6f8f5f); }
.slide-3 { background: linear-gradient(135deg, #4a2c3d, #8a3b5a); }

.slide-content { max-width: 640px; }
.slide .emoji { font-size: 3.5rem; display: block; margin-bottom: var(--space-1); }
.slide h1, .slide h2 { color: var(--white); font-size: var(--text-4xl); margin-bottom: var(--space-1); }
.slide p { font-size: var(--text-lg); margin-bottom: var(--space-3); color: #fff4e0; }
.slide .btn { background: var(--white); color: var(--ink); border-color: var(--white); }
.slide .btn:hover { background: var(--butter); }

.carousel-controls {
  position: absolute; left: 0; right: 0; bottom: var(--space-2);
  display: flex; justify-content: center; align-items: center; gap: var(--space-2);
}
.carousel-btn { width: 44px; height: 44px; border-radius: 50%; border: 2px solid var(--white); background: rgba(0, 0, 0, 0.35); color: var(--white); font-size: 1.1rem; cursor: pointer; }
.carousel-btn:hover { background: var(--white); color: var(--ink); }
.carousel-dots { display: flex; gap: 10px; }
.carousel-dots button { width: 14px; height: 14px; min-height: 0; padding: 0; border-radius: 50%; border: 2px solid var(--white); background: transparent; cursor: pointer; }
.carousel-dots button[aria-current="true"] { background: var(--white); }

@media (min-width: 900px) { .carousel-track { min-height: 520px; } }
````

**`js/carousel.js`**

````javascript
// carousel.js - accessible hero carousel (Experiment 6)
// Features: next/prev, dots, auto-play with a pause button, pause on hover/focus,
// keyboard arrows, touch swipe, and no auto-play if the user prefers reduced motion.
(function () {
  'use strict';

  var root = document.querySelector('[data-carousel]');
  if (!root) { return; }

  var track = root.querySelector('.carousel-track');
  var slides = Array.prototype.slice.call(root.querySelectorAll('.slide'));
  var dotsBox = root.querySelector('.carousel-dots');
  var prevBtn = root.querySelector('.carousel-prev');
  var nextBtn = root.querySelector('.carousel-next');
  var toggleBtn = root.querySelector('.carousel-toggle');
  var status = root.querySelector('.carousel-status');
  var DELAY = 5000;

  var index = 0;
  var timer = null;
  var playing = !window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var dots = [];

  // build one dot button per slide
  slides.forEach(function (slide, i) {
    var dot = document.createElement('button');
    dot.type = 'button';
    dot.setAttribute('aria-label', 'Go to slide ' + (i + 1));
    dot.addEventListener('click', function () { show(i); });
    dotsBox.appendChild(dot);
    dots.push(dot);
  });

  function show(i) {
    index = (i + slides.length) % slides.length;
    slides.forEach(function (slide, n) {
      var active = n === index;
      slide.classList.toggle('is-active', active);
      slide.setAttribute('aria-hidden', String(!active));
      // links inside hidden slides must not be reachable with the Tab key
      Array.prototype.forEach.call(slide.querySelectorAll('a, button'), function (el) {
        el.tabIndex = active ? 0 : -1;
      });
    });
    dots.forEach(function (dot, n) { dot.setAttribute('aria-current', String(n === index)); });
    status.textContent = 'Slide ' + (index + 1) + ' of ' + slides.length;
  }

  function start() {
    stop();
    if (playing) { timer = setInterval(function () { show(index + 1); }, DELAY); }
    track.setAttribute('aria-live', playing ? 'off' : 'polite');
  }
  function stop() { if (timer) { clearInterval(timer); timer = null; } }

  function setPlaying(value) {
    playing = value;
    toggleBtn.innerHTML = playing ? '&#10074;&#10074;' : '&#9654;';
    toggleBtn.setAttribute('aria-label', playing ? 'Pause automatic slide show' : 'Start automatic slide show');
    start();
  }

  prevBtn.addEventListener('click', function () { show(index - 1); });
  nextBtn.addEventListener('click', function () { show(index + 1); });
  toggleBtn.addEventListener('click', function () { setPlaying(!playing); });

  // pause while the pointer or keyboard focus is inside the carousel
  root.addEventListener('mouseenter', stop);
  root.addEventListener('mouseleave', start);
  root.addEventListener('focusin', stop);
  root.addEventListener('focusout', start);

  root.addEventListener('keydown', function (event) {
    if (event.key === 'ArrowLeft') { show(index - 1); }
    if (event.key === 'ArrowRight') { show(index + 1); }
  });

  // touch swipe
  var startX = null;
  root.addEventListener('touchstart', function (e) { startX = e.touches[0].clientX; }, { passive: true });
  root.addEventListener('touchend', function (e) {
    if (startX === null) { return; }
    var diff = e.changedTouches[0].clientX - startX;
    if (Math.abs(diff) > 50) { show(diff < 0 ? index + 1 : index - 1); }
    startX = null;
  });

  show(0);
  setPlaying(playing);
})();
````


---

## Experiment 7

**Aim:** Design and integrate an interactive booking or reservation form with client-side JavaScript validation.

**`booking.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reserve a Table | Golden Crust Artisan Bakery</title>
  <meta name="description" content="Book a table at Golden Crust Artisan Bakery in Hauz Khas, New Delhi. Choose your date, time and party size online.">
  <meta name="robots" content="index, follow">
  <meta name="theme-color" content="#a1440c">
  <link rel="canonical" href="https://www.goldencrustbakery.example/booking.html">

  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Golden Crust Artisan Bakery">
  <meta property="og:title" content="Reserve a Table | Golden Crust Artisan Bakery">
  <meta property="og:description" content="Book a table at Golden Crust Artisan Bakery in Hauz Khas, New Delhi. Choose your date, time and party size online.">
  <meta property="og:url" content="https://www.goldencrustbakery.example/booking.html">
  <meta property="og:image" content="https://www.goldencrustbakery.example/images/og-cover.jpg">
  <meta property="og:image:alt" content="Fresh loaves of sourdough bread on a wooden counter">
  <meta name="twitter:card" content="summary_large_image">

  <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ctext y='.9em' font-size='90'%3E%F0%9F%A5%90%3C/text%3E%3C/svg%3E">
  <script>document.documentElement.classList.add('js');</script>

  <!-- build:css -->
  <link rel="stylesheet" href="css/base.css">
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="css/a11y.css">
  <link rel="stylesheet" href="css/forms.css">
  <link rel="stylesheet" href="css/footer.css">
  <!-- endbuild -->
</head>
<body>
  <a class="skip-link" href="#main">Skip to main content</a>

  <header class="site-header" role="banner">
    <div class="container header-row">
      <a class="brand" href="index.html" aria-label="Golden Crust Artisan Bakery, home">Golden <span>Crust</span></a>
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">Menu</button>
      <nav aria-label="Main navigation">
        <ul class="nav-list" id="primary-nav">
          <li><a href="index.html">Home</a></li>
          <li><a href="index.html#offerings">Our Bakes</a></li>
          <li><a href="index.html#team">Our Team</a></li>
          <li><a href="booking.html" aria-current="page">Reserve a Table</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>
  
  <main id="main">
    <section class="section" aria-labelledby="booking-title">
      <div class="container">
        <div class="section-head">
          <p class="eyebrow">Reservations</p>
          <h1 id="booking-title" style="font-size:var(--text-3xl)">Reserve a Table</h1>
          <p class="lead">Book a table in our caf&eacute; corner. We will confirm your reservation by email.</p>
        </div>

        <div class="form-card">
          <form id="bookingForm" novalidate>
            <p class="hint">Fields marked <span class="required" aria-hidden="true">*</span><span class="sr-only">with an asterisk</span> are required.</p>

            <div class="field">
              <label for="name">Full name <span class="required" aria-hidden="true">*</span></label>
              <input type="text" id="name" name="name" autocomplete="name" required aria-describedby="nameError">
              <span class="field-error" id="nameError" aria-live="polite"></span>
            </div>

            <div class="form-row">
              <div class="field">
                <label for="email">Email <span class="required" aria-hidden="true">*</span></label>
                <input type="email" id="email" name="email" autocomplete="email" required aria-describedby="emailError">
                <span class="field-error" id="emailError" aria-live="polite"></span>
              </div>
              <div class="field">
                <label for="phone">Mobile number <span class="required" aria-hidden="true">*</span></label>
                <input type="tel" id="phone" name="phone" autocomplete="tel" inputmode="numeric" required aria-describedby="phoneError">
                <span class="field-error" id="phoneError" aria-live="polite"></span>
              </div>
            </div>

            <div class="form-row">
              <div class="field">
                <label for="date">Date <span class="required" aria-hidden="true">*</span></label>
                <input type="date" id="date" name="date" required aria-describedby="dateError">
                <span class="field-error" id="dateError" aria-live="polite"></span>
              </div>
              <div class="field">
                <label for="time">Time <span class="required" aria-hidden="true">*</span></label>
                <select id="time" name="time" required aria-describedby="timeError">
                  <option value="">Select a time</option>
                  <option>08:00 AM</option><option>09:00 AM</option><option>10:00 AM</option>
                  <option>11:00 AM</option><option>12:00 PM</option><option>01:00 PM</option>
                  <option>04:00 PM</option><option>05:00 PM</option><option>06:00 PM</option>
                  <option>07:00 PM</option>
                </select>
                <span class="field-error" id="timeError" aria-live="polite"></span>
              </div>
            </div>

            <div class="field">
              <label for="guests">Number of guests <span class="required" aria-hidden="true">*</span></label>
              <input type="number" id="guests" name="guests" min="1" max="12" required aria-describedby="guestsHint guestsError">
              <span class="hint" id="guestsHint">Between 1 and 12 guests.</span>
              <span class="field-error" id="guestsError" aria-live="polite"></span>
            </div>

            <div class="field">
              <label for="notes">Special requests (optional)</label>
              <textarea id="notes" name="notes" rows="3" maxlength="250" aria-describedby="notesError"></textarea>
              <span class="field-error" id="notesError" aria-live="polite"></span>
            </div>

            <button class="btn" type="submit">Request Reservation</button>
            <div id="formStatus" class="form-status" role="status" tabindex="-1"></div>
          </form>
        </div>
      </div>
    </section>
  </main>

  <footer class="site-footer" role="contentinfo">
    <div class="container">
      <div class="footer-grid">
        <section aria-labelledby="f-about">
          <h2 id="f-about">Golden Crust</h2>
          <p>Artisan bakery &amp; caf&eacute;.<br>12 Green Park Market, Hauz Khas,<br>New Delhi 110016</p>
          <p><a href="tel:+919876543210">+91 98765 43210</a><br><a href="mailto:hello@goldencrustbakery.example">hello@goldencrustbakery.example</a></p>
        </section>

        <nav aria-labelledby="f-links">
          <h2 id="f-links">Quick Links</h2>
          <ul class="footer-links">
            <li><a href="index.html#offerings">Our Bakes</a></li>
            <li><a href="index.html#team">Our Team</a></li>
            <li><a href="booking.html">Reserve a Table</a></li>
            <li><a href="contact.html">Find Us</a></li>
          </ul>
        </nav>

        <section aria-labelledby="f-social">
          <h2 id="f-social">Follow Us</h2>
          <ul class="social-list">
            <li><a class="instagram" href="https://www.instagram.com/" aria-label="Golden Crust on Instagram" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm0 2a3 3 0 00-3 3v10a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3zm5 3.500a4.500 4.500 0 110 9 4.500 4.500 0 010-9zm0 2a2.500 2.500 0 100 5 2.500 2.500 0 000-5zM17.500 6a1 1 0 110 2 1 1 0 010-2z"/></svg></a></li>
            <li><a class="facebook" href="https://www.facebook.com/" aria-label="Golden Crust on Facebook" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 8V6c0-.6.4-1 1-1h2V2h-3c-2.800 0-4 1.800-4 4v2H8v3h2v9h4v-9h2.500l.5-3z"/></svg></a></li>
            <li><a class="x-twitter" href="https://x.com/" aria-label="Golden Crust on X" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 3l7.200 9.600L3.400 21H6l5.400-6.200L16 21h5l-7.500-10L20.200 3h-2.500l-5 5.800L8 3z"/></svg></a></li>
            <li><a class="youtube" href="https://www.youtube.com/" aria-label="Golden Crust on YouTube" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21.600 7.200a2.500 2.500 0 00-1.800-1.800C18.200 5 12 5 12 5s-6.200 0-7.800.4A2.500 2.500 0 002.400 7.200C2 8.800 2 12 2 12s0 3.200.4 4.800a2.500 2.500 0 001.800 1.800C5.800 19 12 19 12 19s6.200 0 7.800-.4a2.500 2.500 0 001.800-1.800c.4-1.600.4-4.800.4-4.800s0-3.200-.4-4.800zM10 15V9l5.200 3z"/></svg></a></li>
          </ul>
          <p class="hint" style="margin-top:var(--space-2);color:var(--butter)">Latest from Instagram</p>
          <div class="feed">
            <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram post: sourdough loaves"><span aria-hidden="true">&#127838;</span></a>
            <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram post: croissants"><span aria-hidden="true">&#129360;</span></a>
            <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram post: birthday cake"><span aria-hidden="true">&#127874;</span></a>
            <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram post: coffee"><span aria-hidden="true">&#9749;</span></a>
          </div>
        </section>

        <section aria-labelledby="f-share">
          <h2 id="f-share">Share This Page</h2>
          <div class="share" data-share>
            <a href="#" data-network="facebook" target="_blank" rel="noopener">Facebook</a>
            <a href="#" data-network="x" target="_blank" rel="noopener">X</a>
            <a href="#" data-network="whatsapp" target="_blank" rel="noopener">WhatsApp</a>
            <button type="button" data-network="copy">Copy link</button>
          </div>
          <p class="share-status" role="status" aria-live="polite"></p>
        </section>
      </div>

      <p class="footer-bottom">&copy; <span data-year>2026</span> Golden Crust Artisan Bakery. A fictional client project for MCA108P.</p>
    </div>
  </footer>
  
  <!-- build:js -->
  <script src="js/main.js" defer></script>
  <script src="js/carousel.js" defer></script>
  <script src="js/share.js" defer></script>
  <script src="js/ratings.js" defer></script>
  <script src="js/booking.js" defer></script>
  <!-- endbuild -->
</body>
</html>
````

**`css/forms.css`**

````css
/* forms.css - booking form styling and validation states (Experiment 7) */
.form-card { background: var(--white); max-width: 680px; margin: 0 auto; padding: var(--space-4) var(--space-3); border-radius: var(--radius); box-shadow: var(--shadow); }
.form-row { display: grid; gap: var(--space-2); grid-template-columns: 1fr; }
.field { margin-bottom: var(--space-2); }
.field label, .field legend { display: block; font-weight: 700; margin-bottom: 0.3rem; }
.required { color: var(--danger); }

input[type="text"], input[type="email"], input[type="tel"], input[type="date"], input[type="number"], select, textarea {
  width: 100%; padding: 0.7rem 0.85rem; font: inherit; color: var(--ink);
  background: var(--white); border: 2px solid #8d6e63; border-radius: 8px;
}
input:focus, select:focus, textarea:focus { border-color: var(--caramel); }
[aria-invalid="true"] { border-color: var(--danger) !important; background: #fff5f5; }
.field-error { display: block; color: var(--danger); font-size: var(--text-sm); min-height: 1.2em; margin-top: 0.25rem; }
.hint { color: var(--ink-soft); font-size: var(--text-sm); }

.form-status { margin-top: var(--space-3); padding: var(--space-2); border-radius: 8px; }
.form-status.success { background: #e8f5e9; color: var(--success); border: 1px solid var(--success); }
.form-status.error { background: #fdecea; color: var(--danger); border: 1px solid var(--danger); }
.form-status:empty { display: none; }

@media (min-width: 600px) { .form-row { grid-template-columns: 1fr 1fr; } }
````

**`js/booking.js`**

````javascript
// booking.js - client-side validation for the reservation form (Experiment 7)
(function () {
  'use strict';

  var form = document.getElementById('bookingForm');
  if (!form) { return; }

  var statusBox = document.getElementById('formStatus');
  var dateInput = form.elements.date;

  // allow only today .. 60 days ahead
  function iso(d) { return d.toISOString().slice(0, 10); }
  var today = new Date();
  var max = new Date(); max.setDate(today.getDate() + 60);
  dateInput.min = iso(today);
  dateInput.max = iso(max);

  // each rule returns an error message, or '' when the value is valid
  var rules = {
    name: function (v) {
      v = v.trim();
      if (!v) { return 'Please enter your full name.'; }
      if (!/^[A-Za-z .'-]{2,60}$/.test(v)) { return 'Use letters only (2 to 60 characters).'; }
      return '';
    },
    email: function (v) {
      if (!v.trim()) { return 'Please enter your email address.'; }
      return /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v.trim()) ? '' : 'Enter a valid email, for example name@example.com.';
    },
    phone: function (v) {
      if (!v.trim()) { return 'Please enter your mobile number.'; }
      return /^[6-9]\d{9}$/.test(v.replace(/[\s-]/g, '')) ? '' : 'Enter a valid 10-digit Indian mobile number.';
    },
    date: function (v) {
      if (!v) { return 'Please choose a date.'; }
      if (v < dateInput.min) { return 'The date cannot be in the past.'; }
      if (v > dateInput.max) { return 'Bookings open up to 60 days in advance.'; }
      return '';
    },
    time: function (v) { return v ? '' : 'Please choose a time slot.'; },
    guests: function (v) {
      var n = Number(v);
      if (!v) { return 'Please enter the number of guests.'; }
      return Number.isInteger(n) && n >= 1 && n <= 12 ? '' : 'We can seat 1 to 12 guests online. Call us for larger groups.';
    },
    notes: function (v) { return v.length <= 250 ? '' : 'Please keep notes under 250 characters.'; }
  };

  function setError(field, message) {
    var errorBox = document.getElementById(field.name + 'Error');
    errorBox.textContent = message;
    field.setAttribute('aria-invalid', message ? 'true' : 'false');
    return !message;
  }

  function validate(field) {
    return setError(field, rules[field.name](field.value));
  }

  Object.keys(rules).forEach(function (name) {
    var field = form.elements[name];
    field.addEventListener('blur', function () { validate(field); });
    field.addEventListener('input', function () {
      if (field.getAttribute('aria-invalid') === 'true') { validate(field); }
    });
  });

  form.addEventListener('submit', function (event) {
    event.preventDefault();
    var firstInvalid = null;
    Object.keys(rules).forEach(function (name) {
      var field = form.elements[name];
      if (!validate(field) && !firstInvalid) { firstInvalid = field; }
    });

    if (firstInvalid) {
      statusBox.className = 'form-status error';
      statusBox.textContent = 'Please fix the highlighted fields and try again.';
      firstInvalid.focus();
      return;
    }

    // A real site would send the data to a server here (fetch/POST).
    var ref = 'GC' + Math.floor(100000 + Math.random() * 900000);
    var d = new Date(form.elements.date.value + 'T00:00:00');
    statusBox.className = 'form-status success';
    statusBox.textContent = 'Thank you, ' + form.elements.name.value.trim() + '! Your table for ' +
      form.elements.guests.value + ' on ' + d.toLocaleDateString('en-IN', { weekday: 'long', day: 'numeric', month: 'long' }) +
      ' at ' + form.elements.time.value + ' is requested. Reference: ' + ref + '. We will confirm by email shortly.';
    statusBox.focus();
    form.reset();
    Object.keys(rules).forEach(function (name) { form.elements[name].setAttribute('aria-invalid', 'false'); });
  });
})();
````


---

## Experiment 8

**Aim:** Implement Google Maps embedding and responsive styling on the client's contact page.

**`contact.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact & Location | Golden Crust Artisan Bakery</title>
  <meta name="description" content="Find Golden Crust Artisan Bakery at Green Park Market, Hauz Khas, New Delhi. Opening hours, phone, email and map.">
  <meta name="robots" content="index, follow">
  <meta name="theme-color" content="#a1440c">
  <link rel="canonical" href="https://www.goldencrustbakery.example/contact.html">

  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Golden Crust Artisan Bakery">
  <meta property="og:title" content="Contact & Location | Golden Crust Artisan Bakery">
  <meta property="og:description" content="Find Golden Crust Artisan Bakery at Green Park Market, Hauz Khas, New Delhi. Opening hours, phone, email and map.">
  <meta property="og:url" content="https://www.goldencrustbakery.example/contact.html">
  <meta property="og:image" content="https://www.goldencrustbakery.example/images/og-cover.jpg">
  <meta property="og:image:alt" content="Fresh loaves of sourdough bread on a wooden counter">
  <meta name="twitter:card" content="summary_large_image">

  <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ctext y='.9em' font-size='90'%3E%F0%9F%A5%90%3C/text%3E%3C/svg%3E">
  <script>document.documentElement.classList.add('js');</script>

  <!-- build:css -->
  <link rel="stylesheet" href="css/base.css">
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="css/a11y.css">
  <link rel="stylesheet" href="css/contact.css">
  <link rel="stylesheet" href="css/footer.css">
  <!-- endbuild -->
</head>
<body>
  <a class="skip-link" href="#main">Skip to main content</a>

  <header class="site-header" role="banner">
    <div class="container header-row">
      <a class="brand" href="index.html" aria-label="Golden Crust Artisan Bakery, home">Golden <span>Crust</span></a>
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">Menu</button>
      <nav aria-label="Main navigation">
        <ul class="nav-list" id="primary-nav">
          <li><a href="index.html">Home</a></li>
          <li><a href="index.html#offerings">Our Bakes</a></li>
          <li><a href="index.html#team">Our Team</a></li>
          <li><a href="booking.html">Reserve a Table</a></li>
          <li><a href="contact.html" aria-current="page">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>
  
  <main id="main">
    <section class="section" aria-labelledby="contact-title">
      <div class="container">
        <div class="section-head">
          <p class="eyebrow">Visit us</p>
          <h1 id="contact-title" style="font-size:var(--text-3xl)">Contact &amp; Location</h1>
          <p class="lead">Drop in for a fresh loaf, call us for a custom cake, or send an email.</p>
        </div>

        <div class="contact-grid">
          <div>
            <ul class="contact-list">
              <li><strong>Address</strong>12 Green Park Market, Hauz Khas, New Delhi 110016</li>
              <li><strong>Phone</strong><a href="tel:+919876543210">+91 98765 43210</a></li>
              <li><strong>Email</strong><a href="mailto:hello@goldencrustbakery.example">hello@goldencrustbakery.example</a></li>
              <li><strong>Nearest metro</strong>Green Park (Yellow Line), 5 minute walk</li>
            </ul>

            <h2 style="font-size:var(--text-xl);margin-top:var(--space-3)">Opening hours</h2>
            <ul class="hours">
              <li><span>Monday</span><span>Closed</span></li>
              <li><span>Tuesday - Saturday</span><span>7:30 am - 8:00 pm</span></li>
              <li><span>Sunday</span><span>8:00 am - 6:00 pm</span></li>
            </ul>

            <p style="margin-top:var(--space-3)">
              <a class="btn" href="https://www.google.com/maps/dir/?api=1&amp;destination=Green+Park+Market+Hauz+Khas+New+Delhi" target="_blank" rel="noopener">Get Directions<span class="sr-only"> (opens Google Maps in a new tab)</span></a>
            </p>
          </div>

          <!-- Google Maps embed: needs no API key, scales with screen width -->
          <div class="map-embed">
            <iframe
              title="Map showing the location of Golden Crust Artisan Bakery in Hauz Khas, New Delhi"
              src="https://www.google.com/maps?q=Green+Park+Market,+Hauz+Khas,+New+Delhi&amp;output=embed"
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="site-footer" role="contentinfo">
    <div class="container">
      <div class="footer-grid">
        <section aria-labelledby="f-about">
          <h2 id="f-about">Golden Crust</h2>
          <p>Artisan bakery &amp; caf&eacute;.<br>12 Green Park Market, Hauz Khas,<br>New Delhi 110016</p>
          <p><a href="tel:+919876543210">+91 98765 43210</a><br><a href="mailto:hello@goldencrustbakery.example">hello@goldencrustbakery.example</a></p>
        </section>

        <nav aria-labelledby="f-links">
          <h2 id="f-links">Quick Links</h2>
          <ul class="footer-links">
            <li><a href="index.html#offerings">Our Bakes</a></li>
            <li><a href="index.html#team">Our Team</a></li>
            <li><a href="booking.html">Reserve a Table</a></li>
            <li><a href="contact.html">Find Us</a></li>
          </ul>
        </nav>

        <section aria-labelledby="f-social">
          <h2 id="f-social">Follow Us</h2>
          <ul class="social-list">
            <li><a class="instagram" href="https://www.instagram.com/" aria-label="Golden Crust on Instagram" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm0 2a3 3 0 00-3 3v10a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3zm5 3.500a4.500 4.500 0 110 9 4.500 4.500 0 010-9zm0 2a2.500 2.500 0 100 5 2.500 2.500 0 000-5zM17.500 6a1 1 0 110 2 1 1 0 010-2z"/></svg></a></li>
            <li><a class="facebook" href="https://www.facebook.com/" aria-label="Golden Crust on Facebook" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 8V6c0-.6.4-1 1-1h2V2h-3c-2.800 0-4 1.800-4 4v2H8v3h2v9h4v-9h2.500l.5-3z"/></svg></a></li>
            <li><a class="x-twitter" href="https://x.com/" aria-label="Golden Crust on X" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 3l7.200 9.600L3.400 21H6l5.400-6.200L16 21h5l-7.500-10L20.200 3h-2.500l-5 5.800L8 3z"/></svg></a></li>
            <li><a class="youtube" href="https://www.youtube.com/" aria-label="Golden Crust on YouTube" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21.600 7.200a2.500 2.500 0 00-1.800-1.800C18.200 5 12 5 12 5s-6.200 0-7.800.4A2.500 2.500 0 002.400 7.200C2 8.800 2 12 2 12s0 3.200.4 4.800a2.500 2.500 0 001.800 1.800C5.800 19 12 19 12 19s6.200 0 7.800-.4a2.500 2.500 0 001.800-1.800c.4-1.600.4-4.800.4-4.800s0-3.200-.4-4.800zM10 15V9l5.200 3z"/></svg></a></li>
          </ul>
          <p class="hint" style="margin-top:var(--space-2);color:var(--butter)">Latest from Instagram</p>
          <div class="feed">
            <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram post: sourdough loaves"><span aria-hidden="true">&#127838;</span></a>
            <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram post: croissants"><span aria-hidden="true">&#129360;</span></a>
            <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram post: birthday cake"><span aria-hidden="true">&#127874;</span></a>
            <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram post: coffee"><span aria-hidden="true">&#9749;</span></a>
          </div>
        </section>

        <section aria-labelledby="f-share">
          <h2 id="f-share">Share This Page</h2>
          <div class="share" data-share>
            <a href="#" data-network="facebook" target="_blank" rel="noopener">Facebook</a>
            <a href="#" data-network="x" target="_blank" rel="noopener">X</a>
            <a href="#" data-network="whatsapp" target="_blank" rel="noopener">WhatsApp</a>
            <button type="button" data-network="copy">Copy link</button>
          </div>
          <p class="share-status" role="status" aria-live="polite"></p>
        </section>
      </div>

      <p class="footer-bottom">&copy; <span data-year>2026</span> Golden Crust Artisan Bakery. A fictional client project for MCA108P.</p>
    </div>
  </footer>
  
  <!-- build:js -->
  <script src="js/main.js" defer></script>
  <script src="js/carousel.js" defer></script>
  <script src="js/share.js" defer></script>
  <script src="js/ratings.js" defer></script>
  <script src="js/booking.js" defer></script>
  <!-- endbuild -->
</body>
</html>
````

**`css/contact.css`**

````css
/* contact.css - contact page and responsive Google Map (Experiment 8) */
.contact-grid { display: grid; gap: var(--space-4); grid-template-columns: 1fr; }
.contact-list { list-style: none; padding: 0; }
.contact-list li { padding: var(--space-1) 0; border-bottom: 1px solid var(--line); }
.contact-list strong { display: block; color: var(--ink-soft); font-size: var(--text-sm); text-transform: uppercase; letter-spacing: 0.08em; }

/* the wrapper keeps a 16:9 shape and scales with the screen width */
.map-embed { position: relative; width: 100%; aspect-ratio: 16 / 9; min-height: 280px; border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow); background: var(--butter); }
.map-embed iframe { position: absolute; inset: 0; width: 100%; height: 100%; border: 0; }

@media (min-width: 900px) { .contact-grid { grid-template-columns: 1fr 1.4fr; } }
````


---

## Experiment 9

**Aim:** Add social media integration feeds and sharing buttons within the website footer.

**`index.html  (footer markup)`**

````html
  <footer class="site-footer" role="contentinfo">
    <div class="container">
      <div class="footer-grid">
        <section aria-labelledby="f-about">
          <h2 id="f-about">Golden Crust</h2>
          <p>Artisan bakery &amp; caf&eacute;.<br>12 Green Park Market, Hauz Khas,<br>New Delhi 110016</p>
          <p><a href="tel:+919876543210">+91 98765 43210</a><br><a href="mailto:hello@goldencrustbakery.example">hello@goldencrustbakery.example</a></p>
        </section>

        <nav aria-labelledby="f-links">
          <h2 id="f-links">Quick Links</h2>
          <ul class="footer-links">
            <li><a href="index.html#offerings">Our Bakes</a></li>
            <li><a href="index.html#team">Our Team</a></li>
            <li><a href="booking.html">Reserve a Table</a></li>
            <li><a href="contact.html">Find Us</a></li>
          </ul>
        </nav>

        <section aria-labelledby="f-social">
          <h2 id="f-social">Follow Us</h2>
          <ul class="social-list">
            <li><a class="instagram" href="https://www.instagram.com/" aria-label="Golden Crust on Instagram" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm0 2a3 3 0 00-3 3v10a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3zm5 3.500a4.500 4.500 0 110 9 4.500 4.500 0 010-9zm0 2a2.500 2.500 0 100 5 2.500 2.500 0 000-5zM17.500 6a1 1 0 110 2 1 1 0 010-2z"/></svg></a></li>
            <li><a class="facebook" href="https://www.facebook.com/" aria-label="Golden Crust on Facebook" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 8V6c0-.6.4-1 1-1h2V2h-3c-2.800 0-4 1.800-4 4v2H8v3h2v9h4v-9h2.500l.5-3z"/></svg></a></li>
            <li><a class="x-twitter" href="https://x.com/" aria-label="Golden Crust on X" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 3l7.200 9.600L3.400 21H6l5.400-6.200L16 21h5l-7.500-10L20.200 3h-2.500l-5 5.800L8 3z"/></svg></a></li>
            <li><a class="youtube" href="https://www.youtube.com/" aria-label="Golden Crust on YouTube" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21.600 7.200a2.500 2.500 0 00-1.800-1.800C18.200 5 12 5 12 5s-6.200 0-7.800.4A2.500 2.500 0 002.400 7.200C2 8.800 2 12 2 12s0 3.200.4 4.800a2.500 2.500 0 001.800 1.800C5.800 19 12 19 12 19s6.200 0 7.800-.4a2.500 2.500 0 001.800-1.800c.4-1.600.4-4.800.4-4.800s0-3.200-.4-4.800zM10 15V9l5.200 3z"/></svg></a></li>
          </ul>
          <p class="hint" style="margin-top:var(--space-2);color:var(--butter)">Latest from Instagram</p>
          <div class="feed">
            <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram post: sourdough loaves"><span aria-hidden="true">&#127838;</span></a>
            <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram post: croissants"><span aria-hidden="true">&#129360;</span></a>
            <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram post: birthday cake"><span aria-hidden="true">&#127874;</span></a>
            <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram post: coffee"><span aria-hidden="true">&#9749;</span></a>
          </div>
        </section>

        <section aria-labelledby="f-share">
          <h2 id="f-share">Share This Page</h2>
          <div class="share" data-share>
            <a href="#" data-network="facebook" target="_blank" rel="noopener">Facebook</a>
            <a href="#" data-network="x" target="_blank" rel="noopener">X</a>
            <a href="#" data-network="whatsapp" target="_blank" rel="noopener">WhatsApp</a>
            <button type="button" data-network="copy">Copy link</button>
          </div>
          <p class="share-status" role="status" aria-live="polite"></p>
        </section>
      </div>

      <p class="footer-bottom">&copy; <span data-year>2026</span> Golden Crust Artisan Bakery. A fictional client project for MCA108P.</p>
    </div>
  </footer>
````

**`css/footer.css`**

````css
/* footer.css - footer, social icons, social feed and share buttons (Experiment 9) */
.site-footer { background: var(--ink); color: var(--cream); padding-top: var(--space-5); }
.site-footer h2 { font-size: var(--text-lg); color: var(--butter); margin-bottom: var(--space-1); }
.site-footer a { color: var(--butter); }
.site-footer a:hover { color: var(--white); }
.footer-grid { display: grid; gap: var(--space-4); grid-template-columns: 1fr; }
.footer-links { list-style: none; padding: 0; }
.footer-links li { padding: 0.2rem 0; }

.social-list { list-style: none; padding: 0; display: flex; gap: var(--space-1); flex-wrap: wrap; }
.social-list a {
  display: flex; align-items: center; justify-content: center;
  width: 46px; height: 46px; border-radius: 50%;
  background: #5d4037; color: var(--white);
  transition: background 0.25s, transform 0.25s;
}
.social-list a:hover { transform: translateY(-3px); color: var(--white); }
.social-list .instagram:hover { background: #c13584; }
.social-list .facebook:hover  { background: #1877f2; }
.social-list .x-twitter:hover { background: #000; }
.social-list .youtube:hover   { background: #c4302b; }
.social-list svg { width: 22px; height: 22px; fill: currentColor; }

/* "latest posts" feed (links open the real profile) */
.feed { display: grid; grid-template-columns: repeat(4, 1fr); gap: 6px; margin-top: var(--space-2); }
.feed a { aspect-ratio: 1; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; border-radius: 8px; text-decoration: none; }
.feed a:nth-child(1) { background: #8a5a2b; } .feed a:nth-child(2) { background: #6f4e37; }
.feed a:nth-child(3) { background: #a1440c; } .feed a:nth-child(4) { background: #3d5a40; }

/* share buttons */
.share { display: flex; flex-wrap: wrap; gap: var(--space-1); }
.share button, .share a {
  background: transparent; color: var(--cream); border: 2px solid var(--butter);
  border-radius: 999px; padding: 0.4rem 1rem; font: inherit; font-size: var(--text-sm);
  cursor: pointer; text-decoration: none;
}
.share button:hover, .share a:hover { background: var(--butter); color: var(--ink); }
.share-status { min-height: 1.4em; font-size: var(--text-sm); color: var(--butter); margin-top: 0.4rem; }

.footer-bottom { border-top: 1px solid #5d4037; margin-top: var(--space-4); padding: var(--space-2) 0; text-align: center; font-size: var(--text-sm); }

@media (min-width: 600px) { .footer-grid { grid-template-columns: 1fr 1fr; } }
@media (min-width: 900px) { .footer-grid { grid-template-columns: 1.3fr 1fr 1.2fr 1.3fr; } }
````

**`js/share.js`**

````javascript
// share.js - social sharing buttons in the footer (Experiment 9)
(function () {
  'use strict';

  var box = document.querySelector('[data-share]');
  if (!box) { return; }

  var statusEl = document.querySelector('.share-status');
  var url = window.location.href;
  var title = document.title;

  var links = {
    facebook: 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url),
    x:        'https://twitter.com/intent/tweet?url=' + encodeURIComponent(url) + '&text=' + encodeURIComponent(title),
    whatsapp: 'https://wa.me/?text=' + encodeURIComponent(title + ' ' + url)
  };

  // fill the href of each network link
  Array.prototype.forEach.call(box.querySelectorAll('a[data-network]'), function (a) {
    a.href = links[a.getAttribute('data-network')];
  });

  var copyBtn = box.querySelector('[data-network="copy"]');
  copyBtn.addEventListener('click', function () {
    // phones: use the native share sheet when available
    if (navigator.share) {
      navigator.share({ title: title, url: url }).catch(function () {});
      return;
    }
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(url).then(
        function () { statusEl.textContent = 'Link copied to clipboard.'; },
        function () { statusEl.textContent = 'Could not copy. Please copy the address bar link.'; }
      );
    } else {
      statusEl.textContent = 'Copy this link: ' + url;
    }
  });
})();
````


---

## Experiment 10

**Aim:** Optimize website assets (compressing images, minifying CSS/JS) for high performance and fast loading speeds.

**`package.json`**

````json
{
  "name": "golden-crust-bakery",
  "version": "1.0.0",
  "description": "Golden Crust Artisan Bakery - MCA108P client website project",
  "private": true,
  "scripts": {
    "start": "npx serve . -l 8000",
    "build": "node scripts/build.js",
    "images": "npx sharp-cli --input images/*.jpg --output dist/images --format webp --quality 75",
    "lighthouse": "npx lighthouse http://localhost:8000 --view"
  },
  "devDependencies": {
    "clean-css-cli": "^5.6.3",
    "html-minifier-terser": "^7.2.0",
    "terser": "^5.31.0"
  }
}
````

**`scripts/build.js`**

````javascript
#!/usr/bin/env node
/**
 * build.js - asset optimisation (Experiment 10)
 *
 *  1. Concatenates + minifies all CSS into dist/css/site.min.css   (clean-css)
 *  2. Concatenates + minifies all JS  into dist/js/site.min.js     (terser)
 *  3. Rewrites each HTML page so the <!-- build:css --> and <!-- build:js --> blocks
 *     point to the two bundles (2 requests instead of 14), then minifies the HTML.
 *  4. Copies robots.txt and sitemap.xml
 *
 * Usage:  npm install   then   npm run build
 */
const fs = require('fs');
const path = require('path');
const { execSync } = require('child_process');

const root = path.join(__dirname, '..');
const dist = path.join(root, 'dist');
const bin = (name) => path.join(root, 'node_modules', '.bin', name);
const run = (cmd) => execSync(cmd, { cwd: root, stdio: 'inherit' });
const size = (file) => (fs.statSync(file).size / 1024).toFixed(1) + ' KB';

const cssFiles = ['base', 'layout', 'components', 'a11y', 'carousel', 'forms', 'contact', 'ratings', 'footer']
  .map((n) => `css/${n}.css`);
const jsFiles = ['main', 'carousel', 'share', 'ratings', 'booking'].map((n) => `js/${n}.js`);
const pages = ['index', 'booking', 'contact'];

/** Replaces the build blocks of an HTML string with the bundled files. */
function rewriteHtml(html) {
  return html
    .replace(/<!-- build:css -->[\s\S]*?<!-- endbuild -->/, '<link rel="stylesheet" href="css/site.min.css">')
    .replace(/<!-- build:js -->[\s\S]*?<!-- endbuild -->/, '<script src="js/site.min.js" defer></script>');
}

function build() {
  fs.rmSync(dist, { recursive: true, force: true });
  fs.mkdirSync(path.join(dist, 'css'), { recursive: true });
  fs.mkdirSync(path.join(dist, 'js'), { recursive: true });

  run(`${bin('cleancss')} -o dist/css/site.min.css ${cssFiles.join(' ')}`);
  run(`${bin('terser')} ${jsFiles.join(' ')} --compress --mangle -o dist/js/site.min.js`);

  pages.forEach((page) => {
    const out = path.join(dist, `${page}.html`);
    fs.writeFileSync(out, rewriteHtml(fs.readFileSync(path.join(root, `${page}.html`), 'utf8')));
    run(`${bin('html-minifier-terser')} --collapse-whitespace --remove-comments --minify-css true --minify-js true -o dist/${page}.html dist/${page}.html`);
  });

  ['robots.txt', 'sitemap.xml'].forEach((f) => fs.copyFileSync(path.join(root, f), path.join(dist, f)));

  const before = (list) => list.reduce((sum, f) => sum + fs.statSync(path.join(root, f)).size, 0) / 1024;
  console.log('\n--- Size report ---');
  console.log(`CSS: ${before(cssFiles).toFixed(1)} KB -> ${size(path.join(dist, 'css/site.min.css'))}`);
  console.log(`JS : ${before(jsFiles).toFixed(1)} KB -> ${size(path.join(dist, 'js/site.min.js'))}`);
}

if (require.main === module) { build(); }
module.exports = { rewriteHtml };
````

**`docs/optimization.md`**

### Performance Optimisation (Experiment 10)

#### What was done
| Technique | Where | Benefit |
|-----------|-------|---------|
| Minify + concatenate CSS (9 files to 1) | `scripts/build.js` (clean-css) | Fewer requests, smaller download |
| Minify + concatenate JS (5 files to 1) | `scripts/build.js` (terser) | Fewer requests, smaller download |
| Minify HTML | `scripts/build.js` (html-minifier-terser) | Smaller pages |
| `defer` on every script | all pages | Scripts never block rendering |
| `loading="lazy"` on below-the-fold images | `index.html` | Images load only when needed |
| `width` and `height` on every image | `index.html` | Prevents layout shift (CLS) |
| System font stack (no web fonts) | `css/base.css` | Zero font downloads |
| Emoji + CSS gradients for carousel slides | `css/carousel.css` | No large hero image needed |
| Inline SVG icons | footer | No icon-font download |
| Lazy-loaded map iframe | `contact.html` | Map loads only when scrolled to |

#### Image compression
1. Resize images to the largest size they are displayed at (cards: 600 px wide).
2. Convert to WebP: `npm run images` (uses sharp-cli) or use https://squoosh.app
3. Target: under 100 KB per image.
4. Use `<picture>` to serve WebP with a JPEG fallback:
```html
<picture>
  <source srcset="images/sourdough.webp" type="image/webp">
  <img src="images/sourdough.jpg" width="600" height="400" loading="lazy" alt="Sourdough loaf">
</picture>
```

#### How to run
```
npm install
npm run build        # creates the dist/ folder
```
Serve `dist/` and compare Lighthouse results before and after (see `docs/audit-report.md`).

#### Results (fill in after running the build)
| File group | Before | After |
|------------|--------|-------|
| CSS | ____ KB | ____ KB |
| JS | ____ KB | ____ KB |
| Requests on home page | 14 | 3 + images |


---

## Experiment 11

**Aim:** Test website cross-browser compatibility across Chrome, Firefox, Edge, and Safari.

**`docs/cross-browser-test.md`**

### Cross-Browser Compatibility Test (Experiment 11)

**Browsers:** Chrome, Firefox, Microsoft Edge, Safari (latest versions).
Safari can be tested on a Mac/iPhone or with BrowserStack's free trial / LambdaTest.

#### Test cases
| # | Feature | Page | Expected result | Chrome | Firefox | Edge | Safari |
|---|---------|------|-----------------|:------:|:-------:|:----:|:------:|
| 1 | Page layout (Grid + Flexbox) | All | Cards align in a responsive grid | | | | |
| 2 | CSS variables / `clamp()` | All | Colours and fluid font sizes applied | | | | |
| 3 | `aspect-ratio` (cards, map) | Home, Contact | Images and map keep their shape | | | | |
| 4 | Sticky header | All | Header stays on top while scrolling | | | | |
| 5 | Mobile menu toggle | All (< 900 px) | Opens and closes, Esc closes | | | | |
| 6 | Hero carousel | Home | Auto-plays, arrows, dots and pause work | | | | |
| 7 | Star rating widget | Home | Stars fill on hover and click; message shown | | | | |
| 8 | Date and time inputs | Booking | Date picker appears; min/max dates enforced | | | | |
| 9 | Form validation | Booking | Errors show for bad input; success message for good | | | | |
| 10 | Google Map iframe | Contact | Map loads and is responsive | | | | |
| 11 | Share buttons / copy link | Footer | Share links open; copy link works | | | | |
| 12 | `localStorage` rating memory | Home | Rating is restored after refresh | | | | |

Mark each cell: P (pass), F (fail, add a note), N/A.

#### Known differences and fixes
| Issue | Browser | Fix applied |
|-------|---------|-------------|
| `<input type="date">` looks different on each browser | All | Styled with the same border/padding, JS validates min and max |
| `navigator.share` only on mobile browsers | Desktop | Falls back to the Clipboard API |
| `:focus-visible` on older Safari | Safari < 15.4 | Browser default focus ring is still visible |
| Smooth scrolling | Safari | Supported from 15.4; older versions jump (harmless) |

#### Tools
- https://caniuse.com to check support for any CSS/JS feature
- DevTools > Console in every browser: no errors should appear


---

## Experiment 12

**Aim:** Verify mobile responsiveness across diverse device viewports using browser developer tools.

**`docs/responsive-test.md`**

### Mobile Responsiveness Verification (Experiment 12)

#### How to test with browser developer tools
1. Open the site in Chrome or Edge and press **F12** (or Ctrl+Shift+I).
2. Click the **Toggle device toolbar** icon (or Ctrl+Shift+M).
3. Choose a device from the dropdown, or drag the viewport edge to any width.
4. Test both portrait and landscape (rotate icon).
5. In Firefox use **Responsive Design Mode** (Ctrl+Shift+M).

#### Viewports tested
| Device | Width x Height | Layout expected |
|--------|----------------|-----------------|
| iPhone SE | 375 x 667 | 1 column, hamburger menu |
| iPhone 14 | 390 x 844 | 1 column, hamburger menu |
| Samsung Galaxy S20 | 360 x 800 | 1 column, hamburger menu |
| iPad Mini | 768 x 1024 | 2 to 3 card columns, hamburger menu |
| iPad Pro | 1024 x 1366 | 3 columns, full navigation bar |
| Laptop | 1366 x 768 | 3 columns, 4-column footer |
| Desktop | 1920 x 1080 | Content centred, max width 1120 px |

#### Checklist (tick for every viewport)
| Check | 360 | 390 | 768 | 1024 | 1366 | 1920 |
|-------|:---:|:---:|:---:|:----:|:----:|:----:|
| No horizontal scrollbar | | | | | | |
| Navigation usable (menu or bar) | | | | | | |
| Text readable without zooming (16px+) | | | | | | |
| Buttons and links at least 44 x 44 px | | | | | | |
| Images scale without distortion | | | | | | |
| Carousel text fits inside slides | | | | | | |
| Booking form fields stack correctly | | | | | | |
| Map keeps 16:9 shape | | | | | | |
| Footer columns reflow | | | | | | |

#### Breakpoints used (mobile-first)
| Breakpoint | Change |
|------------|--------|
| Default (< 600px) | Single column, hamburger menu |
| 600px and up | Larger padding, form fields in 2 columns, footer in 2 columns |
| 900px and up | Horizontal navigation, split sections side by side, 4-column footer |

#### Real device test
Run `python3 -m http.server 8000`, find your computer's IP address and open `http://<IP>:8000` on a phone connected to the same Wi-Fi.


---

## Experiment 13

**Aim:** Prepare a comprehensive design rationale document explaining color choices, typography, and target audience alignment.

**`docs/design-rationale.md`**

### Design Rationale (Experiment 13)

#### 1. Target audience
Young professionals and families around Hauz Khas who look for the bakery on their phones,
usually to check opening hours, see the menu, book a table or order a cake. The design therefore
puts the key actions (Reserve a Table, Order a cake, Get Directions) one tap away and is built mobile-first.

#### 2. Brand personality
Warm, friendly, handmade and trustworthy: the feeling of walking into a bakery in the morning.

#### 3. Colour palette
| Name | Hex | Used for | Why |
|------|-----|----------|-----|
| Cream | `#FFF8EE` | Page background | Soft and warm like dough; gentler than pure white |
| Espresso brown | `#3E2723` | Text, footer | Strong contrast for reading; evokes coffee and crust |
| Caramel | `#A1440C` | Buttons, links, accents | Baked-crust colour that draws attention to actions |
| Butter | `#F6E3BF` | Alternate section background | Adds rhythm between sections without new hues |
| Sage green | `#3D5A40` | Call-to-action band, slide 2 | Fresh, natural contrast to the warm browns |

##### Contrast ratios (WCAG AA needs 4.5:1 for normal text)
| Combination | Ratio | Result |
|-------------|-------|--------|
| Espresso on cream | 13.1 : 1 | Pass (AAA) |
| Soft brown `#6D4C41` on cream | 7.2 : 1 | Pass (AAA) |
| Caramel on cream (links) | 5.9 : 1 | Pass (AA) |
| White on caramel (buttons) | 6.3 : 1 | Pass (AA) |
| Cream on espresso (footer) | 13.1 : 1 | Pass (AAA) |
| Butter on espresso (footer links) | 11.0 : 1 | Pass (AAA) |
| Sage on white | 7.7 : 1 | Pass (AAA) |

#### 4. Typography
| Role | Font | Reason |
|------|------|--------|
| Headings | Georgia (serif) | Traditional, craft feeling; available on every device |
| Body | System UI sans-serif | Very readable on phones and loads instantly (no web font download) |

**Type scale:** a modular scale with ratio 1.25 (0.875 / 1 / 1.25 / 1.56 / 1.95 / 2.44 / 3.05 rem).
`clamp()` makes headings fluid between phone and desktop sizes. Body line height is 1.65 for easy reading.

#### 5. Spacing and white space
All gaps use an 8 px based scale (`0.5, 1, 1.5, 2, 3, 4.5 rem`). Generous section padding separates
topics, cards have equal gutters, and paragraph width is limited to a comfortable line length.
Consistent spacing makes the page feel calm and organised.

#### 6. Layout decisions
- **Mobile-first** so the phone experience is never an afterthought.
- **CSS Grid `auto-fit`** for card sections: columns appear automatically as space allows.
- **Flexbox** for navigation and rows of controls.
- Alternating cream and butter sections break up the long home page.

#### 7. Imagery and motion
- Real product photography (replace the placeholders) shows what customers will receive.
- The hero carousel highlights three business goals: products, cakes and the cafe.
- Motion is subtle (fade, small lift on hover) and disabled for visitors who prefer reduced motion.

#### 8. Accessibility decisions
Skip link, ARIA landmarks, alt text on every image, visible focus rings, keyboard-operable carousel
with a pause button, form errors announced to screen readers, 44 px touch targets.

#### 9. Alignment with the audience
| Audience need | Design response |
|---------------|-----------------|
| "Is it open now?" | Hours on the contact page and footer, structured data for Google |
| "What do they sell?" | Card grid with photo, description and price |
| "Can I trust them?" | Team photos, story, customer reviews and rating |
| "How do I book?" | Prominent buttons on carousel, call-to-action band and navigation |


---

## Experiment 14

**Aim:** Create a slide presentation outlining the website planning, wireframing, development phases, and testing results.

**`docs/presentation-outline.md`**

### Presentation Outline (Experiment 14)

Build these slides in PowerPoint, Google Slides or Canva. About 12 slides, 10 minutes.

| Slide | Title | Content |
|------:|-------|---------|
| 1 | Title | Golden Crust Artisan Bakery website, your name, roll number, MCA108P |
| 2 | The client | Who they are, products, location, problem to solve |
| 3 | Goals and audience | 5 goals (table from `project-specification.md`), target users |
| 4 | Planning | Site map, scope, timeline (Gantt: Plan, Design, Build, Test, Present) |
| 5 | Wireframes | Mobile and desktop wireframes for Home, Booking, Contact |
| 6 | Design system | Colour palette, fonts, spacing scale, contrast table |
| 7 | Development: structure | Semantic HTML5, CSS file organisation (base, layout, components, a11y) |
| 8 | Development: features | Carousel, booking form validation, star rating, map, share buttons (screenshots) |
| 9 | Accessibility and SEO | WCAG checklist, ARIA landmarks, meta tags, Open Graph, sitemap |
| 10 | Performance | Minification and image optimisation, before/after Lighthouse numbers |
| 11 | Testing results | Cross-browser table, responsive viewports, bugs found and fixed |
| 12 | Conclusion | What was learned, future work (backend booking, online ordering), thank you |

#### Tips
- One idea per slide, large screenshots, maximum 5 bullet points.
- Use the same colours as the website so the deck looks consistent.
- Export a PDF copy and keep it in the repository (`docs/presentation.pdf`).


---

## Experiment 15

**Aim:** Deliver a live demonstration of the website functionality, interactive features, and responsive design during the lab presentation.

**`docs/demo-script.md`**

### Live Demonstration Script (Experiment 15)

Total time: about 6 minutes. Run the site locally first (`docs/local-setup.md`) and keep a backup copy of screenshots.

#### Before you start
- [ ] Server running, site open in Chrome at `http://localhost:8000`
- [ ] Browser zoom at 100%, DevTools closed
- [ ] Internet connected (images and map need it)
- [ ] Clear the saved star rating: DevTools > Application > Local Storage > delete `goldenCrustRating`

#### Steps
| Time | Action | What to say |
|------|--------|-------------|
| 0:00 | Open the home page | "This is Golden Crust, a fictional artisan bakery. The site has 3 pages." |
| 0:30 | Let the carousel play, click pause, then next/previous | "The carousel is keyboard accessible and has a pause button for accessibility." |
| 1:00 | Scroll through offerings, story, team | "Semantic HTML5 sections with proper alt text on every image." |
| 1:45 | Hover and click the star rating, refresh the page | "The rating is saved in localStorage." |
| 2:15 | Press Tab repeatedly from the top | "Skip link and focus indicators for keyboard users." |
| 2:45 | Open DevTools device toolbar, switch to iPhone, open the hamburger menu | "Mobile-first design, menu collapses below 900 px." |
| 3:30 | Go to Reserve a Table, submit empty, then with bad email, then valid data | "Client-side validation shows clear errors and a confirmation." |
| 4:30 | Open Contact page, show the map and Get Directions | "Embedded Google Map, responsive 16:9 container." |
| 5:00 | Click Copy link / share in the footer | "Social sharing and follow links." |
| 5:30 | Show Lighthouse results | "Scores for performance, accessibility, best practices and SEO." |

#### Possible questions
- *Why no framework?* To demonstrate core HTML, CSS and JS fundamentals.
- *Where does the booking go?* There is no backend yet; a server or form service would be the next step.
- *How did you test accessibility?* Keyboard testing, screen reader checks and Lighthouse / axe.


---

## Experiment 16

**Aim:** Implement SEO meta tags (title, description, Open Graph tags) across all pages of the client website.

**`index.html  (<head> SEO and Open Graph tags)`**

````html
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Golden Crust Artisan Bakery | Fresh Sourdough, Pastries &amp; Cakes in Delhi</title>
  <meta name="description" content="Golden Crust is a neighbourhood artisan bakery in Hauz Khas, New Delhi. Slow-fermented sourdough, butter croissants and custom cakes baked fresh every morning.">
  <meta name="keywords" content="artisan bakery, sourdough, croissants, custom cakes, Delhi bakery">
  <meta name="author" content="Golden Crust Artisan Bakery">
  <meta name="robots" content="index, follow">
  <meta name="theme-color" content="#a1440c">
  <link rel="canonical" href="https://www.goldencrustbakery.example/">

  <!-- Open Graph (Facebook, WhatsApp, LinkedIn) -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Golden Crust Artisan Bakery">
  <meta property="og:title" content="Golden Crust Artisan Bakery | Fresh Baked Every Morning">
  <meta property="og:description" content="Slow-fermented sourdough, butter croissants and custom cakes in Hauz Khas, New Delhi.">
  <meta property="og:url" content="https://www.goldencrustbakery.example/">
  <meta property="og:image" content="https://www.goldencrustbakery.example/images/og-cover.jpg">
  <meta property="og:image:alt" content="Fresh loaves of sourdough bread on a wooden counter">

  <!-- Twitter / X card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Golden Crust Artisan Bakery">
  <meta name="twitter:description" content="Slow-fermented sourdough, butter croissants and custom cakes in Delhi.">
  <meta name="twitter:image" content="https://www.goldencrustbakery.example/images/og-cover.jpg">

  <!-- structured data for search engines -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Bakery",
    "name": "Golden Crust Artisan Bakery",
    "url": "https://www.goldencrustbakery.example/",
    "telephone": "+91-98765-43210",
    "priceRange": "INR 80 - 1500",
    "address": { "@type": "PostalAddress", "streetAddress": "12 Green Park Market, Hauz Khas",
                 "addressLocality": "New Delhi", "postalCode": "110016", "addressCountry": "IN" },
    "openingHours": ["Tu-Sa 07:30-20:00", "Su 08:00-18:00"]
  }
  </script>
````

**`robots.txt`**

````text
User-agent: *
Allow: /

Sitemap: https://www.goldencrustbakery.example/sitemap.xml
````

**`sitemap.xml`**

````xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url><loc>https://www.goldencrustbakery.example/</loc><changefreq>weekly</changefreq><priority>1.0</priority></url>
  <url><loc>https://www.goldencrustbakery.example/booking.html</loc><changefreq>monthly</changefreq><priority>0.8</priority></url>
  <url><loc>https://www.goldencrustbakery.example/contact.html</loc><changefreq>yearly</changefreq><priority>0.6</priority></url>
</urlset>
````


---

## Experiment 17

**Aim:** Set up a local test environment to host and run the client website smoothly before presentation.

**`docs/local-setup.md`**

### Local Test Environment (Experiment 17)

The site is static HTML, CSS and JavaScript, so any local web server works.
Opening `index.html` directly with `file://` also works, but a server is closer to real hosting.

#### Option 1: VS Code Live Server (easiest)
1. Install **Visual Studio Code**.
2. Install the extension **Live Server** (Ritwick Dey).
3. Right-click `index.html` > **Open with Live Server**. The page reloads automatically when you save.

#### Option 2: Python (already installed on most computers)
```
cd MCA108P-AS08_1
python3 -m http.server 8000        # Windows: python -m http.server 8000
```
Open http://localhost:8000

#### Option 3: Node.js
```
npm install
npm start                          # runs: npx serve . -l 8000
```

#### Option 4: XAMPP / Apache
Copy the project folder into `htdocs` and open http://localhost/MCA108P-AS08_1/

#### Testing on a phone
Connect the phone to the same Wi-Fi, find your computer's IP (`ipconfig` on Windows, `ifconfig` on Mac/Linux)
and open `http://<IP>:8000`.

#### Production build
```
npm install
npm run build                      # minified site in dist/
npx serve dist -l 8001
```

#### Troubleshooting
| Problem | Fix |
|---------|-----|
| Images or map do not show | Check the internet connection (placeholders load from picsum.photos) |
| Port already in use | Change 8000 to another port, e.g. 8080 |
| CSS changes not visible | Hard refresh with Ctrl+Shift+R |


---

## Experiment 18

**Aim:** Incorporate customer testimonial grids with interactive rating stars.

**`index.html  (testimonials and rating markup)`**

````html
    <section class="section section-alt" id="testimonials" aria-labelledby="testimonials-title">
      <div class="container">
        <div class="section-head">
          <p class="eyebrow">Kind words</p>
          <h2 id="testimonials-title">What Our Customers Say</h2>
        </div>

        <div class="grid grid-cards">
          <figure class="testimonial">
            <p class="stars" role="img" aria-label="5 out of 5 stars"><span aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</span></p>
            <blockquote>The best sourdough in South Delhi. I come every Saturday morning for a loaf and a croissant.</blockquote>
            <footer>Ritu Sharma <span>Regular customer</span></footer>
          </figure>
          <figure class="testimonial">
            <p class="stars" role="img" aria-label="5 out of 5 stars"><span aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</span></p>
            <blockquote>They made my daughter&rsquo;s birthday cake exactly as she imagined it. Beautiful and delicious.</blockquote>
            <footer>Vikram Singh <span>Custom cake order</span></footer>
          </figure>
          <figure class="testimonial">
            <p class="stars" role="img" aria-label="4 out of 5 stars"><span aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9734;</span></p>
            <blockquote>Lovely caf&eacute; corner and friendly staff. The brunch menu could use a few more vegan options.</blockquote>
            <footer>Anita Desai <span>Weekend brunch</span></footer>
          </figure>
        </div>

        <div class="rating-box" data-rating>
          <form novalidate>
            <fieldset>
              <legend>Rate your experience</legend>
              <div class="stars-input">
                <input type="radio" name="rating" id="star5" value="5"><label for="star5"><span class="sr-only">5 stars</span></label>
                <input type="radio" name="rating" id="star4" value="4"><label for="star4"><span class="sr-only">4 stars</span></label>
                <input type="radio" name="rating" id="star3" value="3"><label for="star3"><span class="sr-only">3 stars</span></label>
                <input type="radio" name="rating" id="star2" value="2"><label for="star2"><span class="sr-only">2 stars</span></label>
                <input type="radio" name="rating" id="star1" value="1"><label for="star1"><span class="sr-only">1 star</span></label>
              </div>
            </fieldset>
            <p class="rating-message" role="status" aria-live="polite"></p>
          </form>
        </div>
      </div>
    </section>
````

**`css/ratings.css`**

````css
/* ratings.css - testimonial grid and interactive star rating (Experiment 18) */
.testimonial { background: var(--white); border-radius: var(--radius); padding: var(--space-3); box-shadow: var(--shadow); display: flex; flex-direction: column; gap: var(--space-1); }
.testimonial blockquote { font-style: italic; }
.testimonial footer { margin-top: auto; font-weight: 700; }
.testimonial footer span { display: block; font-weight: 400; font-size: var(--text-sm); color: var(--ink-soft); }

/* read-only stars */
.stars { color: var(--star); font-size: 1.3rem; letter-spacing: 2px; }

/* interactive stars: radio buttons are visually replaced by star glyphs */
.rating-box { background: var(--white); max-width: 520px; margin: var(--space-4) auto 0; padding: var(--space-3); border-radius: var(--radius); text-align: center; box-shadow: var(--shadow); }
.rating-box fieldset { border: 0; padding: 0; }
.rating-box legend { font-family: var(--font-heading); font-size: var(--text-xl); margin-bottom: var(--space-1); }
.stars-input { display: inline-flex; flex-direction: row-reverse; justify-content: center; gap: 4px; }
.stars-input input { position: absolute; opacity: 0; width: 1px; height: 1px; }
.stars-input label { font-size: 2.4rem; line-height: 1; color: #bcaaa4; cursor: pointer; transition: color 0.15s, transform 0.15s; padding: 0 2px; }
.stars-input label::before { content: "\2605"; }
/* DOM order is 5 -> 1 with row-reverse, so "~" fills every lower star too */
.stars-input input:checked ~ label,
.stars-input label:hover,
.stars-input label:hover ~ label { color: var(--star); }
.stars-input label:hover { transform: scale(1.15); }
.stars-input input:focus-visible + label { outline: 3px solid #1a73e8; border-radius: 6px; }
.rating-message { min-height: 1.6em; margin-top: var(--space-1); font-weight: 700; color: var(--success); }
````

**`js/ratings.js`**

````javascript
// ratings.js - interactive star rating (Experiment 18)
// The visitor's rating is remembered in localStorage (wrapped in try/catch because
// storage can be blocked in private mode).
(function () {
  'use strict';

  var box = document.querySelector('[data-rating]');
  if (!box) { return; }

  var message = box.querySelector('.rating-message');
  var inputs = box.querySelectorAll('input[name="rating"]');
  var KEY = 'goldenCrustRating';
  var words = { 1: 'Poor', 2: 'Fair', 3: 'Good', 4: 'Very good', 5: 'Excellent' };

  function show(value) {
    message.textContent = 'Thank you! You rated us ' + value + ' out of 5 (' + words[value] + ').';
  }

  Array.prototype.forEach.call(inputs, function (input) {
    input.addEventListener('change', function () {
      show(input.value);
      try { localStorage.setItem(KEY, input.value); } catch (e) { /* storage unavailable */ }
    });
  });

  // restore a previous rating
  try {
    var saved = localStorage.getItem(KEY);
    if (saved && words[saved]) {
      box.querySelector('input[value="' + saved + '"]').checked = true;
      show(saved);
    }
  } catch (e) { /* ignore */ }
})();
````


---

## Experiment 19

**Aim:** Write clean, well-commented HTML, CSS, and JavaScript code following industry coding standards.

**`docs/coding-standards.md`**

### Coding Standards (Experiment 19)

Applied across all HTML, CSS and JavaScript files. `.editorconfig` enforces indentation and line endings.

#### General
- UTF-8, LF line endings, 2-space indentation, no tabs, no trailing spaces.
- File and folder names: lowercase, words separated with hyphens or a single word (`booking.js`).
- Every file starts with a comment that says what it does.
- Comment the *why*, not the obvious *what*.

#### HTML
- `<!DOCTYPE html>`, `lang` attribute, viewport meta tag on every page.
- Use semantic elements (`header`, `nav`, `main`, `section`, `article`, `footer`) instead of generic `div`s.
- One `<h1>` per page and headings in logical order.
- Every image has `alt`, `width` and `height`; decorative icons use `aria-hidden="true"`.
- Every form control has a `<label>`.
- Lowercase tags and attributes, double quotes for attribute values.

#### CSS
- Colours, font sizes and spacing come from CSS variables in `base.css`: no magic numbers.
- Mobile-first: base styles for phones, `min-width` media queries for larger screens.
- Class names are lowercase with hyphens (`.card-body`); no IDs for styling.
- One concern per file: `base`, `layout`, `components`, `a11y`, plus one file per feature.
- Avoid `!important` (used only for accessibility overrides and error states).

#### JavaScript
- Wrap each file in an IIFE and use `'use strict'` so nothing leaks into the global scope.
- Use `const`/`let` or `var` consistently inside a file, strict equality (`===`), semicolons.
- Check that an element exists before using it (scripts are shared across pages).
- Wrap `localStorage` in `try/catch`.
- Keep functions small and name them with verbs (`validateEmail`, `showSlide`).
- No inline event handlers (`onclick="..."`).

#### Review checklist
- [ ] No console errors or warnings
- [ ] HTML validates at https://validator.w3.org
- [ ] CSS validates at https://jigsaw.w3.org/css-validator
- [ ] Comments added for non-obvious code
- [ ] No unused CSS, JS or files

**`.editorconfig`**

````text
# Keeps indentation and line endings consistent in every editor (Experiment 19)
root = true

[*]
charset = utf-8
end_of_line = lf
insert_final_newline = true
trim_trailing_whitespace = true
indent_style = space
indent_size = 2

[*.md]
trim_trailing_whitespace = false
````


---

## Experiment 20

**Aim:** Conduct a final code audit and accessibility evaluation using automated tools (e.g., Lighthouse).

**`docs/audit-report.md`**

### Final Code Audit and Accessibility Evaluation (Experiment 20)

#### 1. Tools
| Tool | How to run |
|------|-----------|
| Lighthouse (Chrome DevTools) | F12 > Lighthouse tab > select all categories > **Analyze page load** |
| Lighthouse CLI | `npm run lighthouse` (site must be running on port 8000) |
| axe DevTools extension | Install from the Chrome Web Store > **Scan all of my page** |
| WAVE | https://wave.webaim.org (browser extension) |
| W3C HTML validator | https://validator.w3.org |
| W3C CSS validator | https://jigsaw.w3.org/css-validator |
| Screen reader | NVDA (Windows, free) or VoiceOver (Mac: Cmd+F5) |

#### 2. Lighthouse scores (mobile)
| Page | Performance | Accessibility | Best Practices | SEO |
|------|:-----------:|:-------------:|:--------------:|:---:|
| index.html | | | | |
| booking.html | | | | |
| contact.html | | | | |
| **Target** | 90+ | 100 | 95+ | 100 |

Performance metrics: LCP ____ s (target under 2.5 s), CLS ____ (target under 0.1), TBT ____ ms.

#### 3. Manual accessibility checks
| WCAG criterion | Check | Result |
|----------------|-------|:------:|
| 1.1.1 Non-text content | Every image has meaningful alt text | |
| 1.3.1 Info and relationships | Headings, landmarks, labels used correctly | |
| 1.4.3 Contrast (minimum) | All text at least 4.5:1 (see design rationale) | |
| 1.4.4 Resize text | Page usable at 200% zoom | |
| 1.4.10 Reflow | No horizontal scroll at 320 px width | |
| 2.1.1 Keyboard | Everything reachable and usable with Tab, Enter, Space, arrows | |
| 2.2.2 Pause, stop, hide | Carousel has a pause button | |
| 2.4.1 Bypass blocks | Skip link works | |
| 2.4.7 Focus visible | Focus ring visible on every control | |
| 3.3.1 Error identification | Form errors described in text | |
| 3.3.2 Labels or instructions | Required fields marked | |
| 4.1.2 Name, role, value | Buttons and widgets have accessible names | |

#### 4. Issues found and fixed
| # | Issue | Severity | Fix | Status |
|---|-------|----------|-----|--------|
| 1 | | | | |
| 2 | | | | |

#### 5. Code audit checklist
- [ ] No console errors in Chrome, Firefox, Edge, Safari
- [ ] HTML and CSS pass the W3C validators
- [ ] No unused CSS or JavaScript
- [ ] All links work (no 404 pages)
- [ ] All images have alt, width, height
- [ ] Meta description, title and Open Graph tags present on every page
- [ ] Comments and naming follow `docs/coding-standards.md`

#### 6. Conclusion
Summarise the final scores, remaining limitations and recommended future improvements.

