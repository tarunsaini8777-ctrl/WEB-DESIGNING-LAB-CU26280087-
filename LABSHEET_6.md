# MCA108P-AS08: HTML, CSS & JavaScript Portfolio Website

All programs in one file. Every experiment is a separate folder: copy each block into the file named above it, then open `index.html` in a browser.

**Setup:** No installation needed. Use VS Code with the Live Server extension, or just double-click `index.html`. Experiments 3 and 5 load images from picsum.photos, so internet is needed for those.

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

---

---

## Experiment 1

**Aim:** Design a multi-page portfolio website (Home, About, Projects, Contact) using semantic HTML5 tags (<header>, <nav>, <section>, <article>, <footer>).

**`01_multipage_portfolio/about.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About | My Portfolio</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Aman Kumar</h1>
    <nav>
      <a href="index.html">Home</a>
      <a href="about.html" class="active">About</a>
      <a href="projects.html">Projects</a>
      <a href="contact.html">Contact</a>
    </nav>
  </header>

  <main>
    <section>
      <h2>About Me</h2>
      <article>
        <h3>Education</h3>
        <p>Master of Computer Applications (MCA), 2025 - 2027.</p>
      </article>
      <article>
        <h3>Skills</h3>
        <p>HTML5, CSS3, JavaScript, PHP, Python, MySQL.</p>
      </article>
    </section>
  </main>

  <footer>
    <p>&copy; 2026 Aman Kumar. All rights reserved.</p>
  </footer>
</body>
</html>
````

**`01_multipage_portfolio/contact.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact | My Portfolio</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Aman Kumar</h1>
    <nav>
      <a href="index.html">Home</a>
      <a href="about.html">About</a>
      <a href="projects.html">Projects</a>
      <a href="contact.html" class="active">Contact</a>
    </nav>
  </header>

  <main>
    <section>
      <h2>Contact Me</h2>
      <address>
        <p>Email: <a href="mailto:aman@example.com">aman@example.com</a></p>
        <p>Phone: +91 98765 43210</p>
      </address>
    </section>
  </main>

  <footer>
    <p>&copy; 2026 Aman Kumar. All rights reserved.</p>
  </footer>
</body>
</html>
````

**`01_multipage_portfolio/index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | My Portfolio</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Aman Kumar</h1>
    <nav>
      <a href="index.html" class="active">Home</a>
      <a href="about.html">About</a>
      <a href="projects.html">Projects</a>
      <a href="contact.html">Contact</a>
    </nav>
  </header>

  <main>
    <section>
      <h2>Welcome to my portfolio</h2>
      <p>I am an MCA student who enjoys building clean, responsive web applications.</p>
    </section>
    <section>
      <h2>Featured Work</h2>
      <article>
        <h3>Student Management System</h3>
        <p>A PHP and MySQL application for managing student records.</p>
      </article>
    </section>
  </main>

  <footer>
    <p>&copy; 2026 Aman Kumar. All rights reserved.</p>
  </footer>
</body>
</html>
````

**`01_multipage_portfolio/projects.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Projects | My Portfolio</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Aman Kumar</h1>
    <nav>
      <a href="index.html">Home</a>
      <a href="about.html">About</a>
      <a href="projects.html" class="active">Projects</a>
      <a href="contact.html">Contact</a>
    </nav>
  </header>

  <main>
    <section>
      <h2>My Projects</h2>
      <article>
        <h3>Portfolio Website</h3>
        <p>Multi-page responsive site built with semantic HTML5.</p>
      </article>
      <article>
        <h3>Weather App</h3>
        <p>JavaScript app that fetches live weather data from an API.</p>
      </article>
      <article>
        <h3>Library System</h3>
        <p>Python and MySQL application to issue and return books.</p>
      </article>
    </section>
  </main>

  <footer>
    <p>&copy; 2026 Aman Kumar. All rights reserved.</p>
  </footer>
</body>
</html>
````

**`01_multipage_portfolio/style.css`**

````css
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
header { background: #2c3e50; color: #fff; padding: 15px 30px; }
header h1 { font-size: 1.5rem; }
nav a { color: #ecf0f1; text-decoration: none; margin-right: 18px; }
nav a:hover, nav a.active { color: #f1c40f; }
main { max-width: 900px; margin: 30px auto; padding: 0 20px; }
section { margin-bottom: 30px; }
article { background: #f4f6f8; padding: 15px; margin: 12px 0; border-left: 4px solid #2c3e50; }
footer { background: #2c3e50; color: #fff; text-align: center; padding: 15px; }
````

---

## Experiment 2

**Aim:** Style the portfolio website using an external CSS file featuring CSS Flexbox for responsive navigation bars and card grids.

**`02_css_flexbox/index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Flexbox Nav and Cards</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="navbar">
    <div class="logo">MyPortfolio</div>
    <nav class="nav-links">
      <a href="#">Home</a>
      <a href="#">About</a>
      <a href="#">Projects</a>
      <a href="#">Contact</a>
    </nav>
  </header>

  <main>
    <h2 class="title">My Projects</h2>
    <section class="card-grid">
      <article class="card"><h3>Project One</h3><p>Responsive landing page using Flexbox.</p></article>
      <article class="card"><h3>Project Two</h3><p>JavaScript to-do list with local storage.</p></article>
      <article class="card"><h3>Project Three</h3><p>PHP and MySQL student record system.</p></article>
      <article class="card"><h3>Project Four</h3><p>Python CGI web dashboard.</p></article>
      <article class="card"><h3>Project Five</h3><p>Weather app using a public API.</p></article>
      <article class="card"><h3>Project Six</h3><p>Online quiz with score tracking.</p></article>
    </section>
  </main>
</body>
</html>
````

**`02_css_flexbox/style.css`**

````css
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: Arial, sans-serif; background: #f4f6f8; }

/* Flexbox navigation bar */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  background: #2c3e50;
  padding: 15px 30px;
}
.logo { color: #fff; font-size: 1.4rem; font-weight: bold; }
.nav-links { display: flex; gap: 20px; flex-wrap: wrap; }
.nav-links a { color: #ecf0f1; text-decoration: none; }
.nav-links a:hover { color: #f1c40f; }

main { max-width: 1100px; margin: 30px auto; padding: 0 20px; }
.title { margin-bottom: 20px; }

/* Flexbox card grid */
.card-grid { display: flex; flex-wrap: wrap; gap: 20px; }
.card {
  flex: 1 1 280px;        /* grow, shrink, minimum width */
  background: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}
.card h3 { margin-bottom: 8px; color: #2c3e50; }

@media (max-width: 600px) {
  .navbar { flex-direction: column; gap: 10px; }
}
````

---

## Experiment 3

**Aim:** Implement a responsive hero banner section with background image overlay, typography hierarchy, and a call-to-action button.

**`03_hero_banner/index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hero Banner</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <section class="hero">
    <div class="hero-content">
      <p class="eyebrow">Web Developer</p>
      <h1>Hi, I'm Aman Kumar</h1>
      <p class="subtitle">I design and build fast, responsive and accessible websites.</p>
      <a href="#work" class="btn">View My Work</a>
    </div>
  </section>
  <section id="work" style="padding:60px 20px;text-align:center;">
    <h2>My Work</h2>
  </section>
</body>
</html>
````

**`03_hero_banner/style.css`**

````css
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: Arial, sans-serif; }

.hero {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  color: #fff;
  /* gradient overlay on top of the background image */
  background:
    linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)),
    url("https://picsum.photos/1600/900") center / cover no-repeat,
    #34495e;
  padding: 20px;
}
.hero-content { max-width: 700px; }

/* Typography hierarchy */
.eyebrow { text-transform: uppercase; letter-spacing: 3px; font-size: 0.9rem; color: #f1c40f; margin-bottom: 10px; }
.hero h1 { font-size: 3.2rem; line-height: 1.2; margin-bottom: 15px; }
.subtitle { font-size: 1.2rem; margin-bottom: 30px; color: #ecf0f1; }

/* Call-to-action */
.btn {
  display: inline-block;
  background: #f1c40f;
  color: #222;
  padding: 14px 34px;
  border-radius: 30px;
  text-decoration: none;
  font-weight: bold;
  transition: transform 0.2s, background 0.2s;
}
.btn:hover { background: #fff; transform: translateY(-3px); }

@media (max-width: 600px) { .hero h1 { font-size: 2.2rem; } }
````

---

## Experiment 4

**Aim:** Add interactive hamburger menu toggling for mobile screens using JavaScript event listeners and CSS class manipulation.

**`04_hamburger_menu/index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hamburger Menu</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="navbar">
    <div class="logo">MyPortfolio</div>
    <button class="hamburger" id="hamburger" aria-label="Toggle menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
    <nav class="nav-links" id="navLinks">
      <a href="#">Home</a>
      <a href="#">About</a>
      <a href="#">Projects</a>
      <a href="#">Contact</a>
    </nav>
  </header>
  <main style="padding:30px;"><h2>Resize the window below 700px to see the menu button.</h2></main>
  <script src="script.js"></script>
</body>
</html>
````

**`04_hamburger_menu/script.js`**

````javascript
const hamburger = document.getElementById('hamburger');
const navLinks = document.getElementById('navLinks');

hamburger.addEventListener('click', () => {
  const isOpen = navLinks.classList.toggle('open');
  hamburger.classList.toggle('active');
  hamburger.setAttribute('aria-expanded', isOpen);
});

// close the menu after a link is clicked
navLinks.querySelectorAll('a').forEach(link => {
  link.addEventListener('click', () => {
    navLinks.classList.remove('open');
    hamburger.classList.remove('active');
    hamburger.setAttribute('aria-expanded', 'false');
  });
});
````

**`04_hamburger_menu/style.css`**

````css
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: Arial, sans-serif; }

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #2c3e50;
  padding: 15px 25px;
  position: relative;
}
.logo { color: #fff; font-size: 1.4rem; font-weight: bold; }
.nav-links { display: flex; gap: 22px; }
.nav-links a { color: #ecf0f1; text-decoration: none; }
.nav-links a:hover { color: #f1c40f; }

.hamburger { display: none; background: none; border: none; cursor: pointer; }
.hamburger span {
  display: block; width: 26px; height: 3px; background: #fff;
  margin: 5px 0; transition: transform 0.3s, opacity 0.3s;
}
/* turn the three bars into an X when active */
.hamburger.active span:nth-child(1) { transform: translateY(8px) rotate(45deg); }
.hamburger.active span:nth-child(2) { opacity: 0; }
.hamburger.active span:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }

@media (max-width: 700px) {
  .hamburger { display: block; }
  .nav-links {
    display: none;
    flex-direction: column;
    position: absolute;
    top: 100%; left: 0; width: 100%;
    background: #34495e;
    padding: 15px 25px;
    gap: 14px;
  }
  .nav-links.open { display: flex; }
}
````

---

## Experiment 5

**Aim:** Design a CSS Grid-based photo gallery with image hover zoom effects using CSS transform: scale() and transition properties.

**`05_css_grid_gallery/index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Photo Gallery</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Photo Gallery</h1>
  <section class="gallery">
    <figure class="item wide"><img src="https://picsum.photos/id/1015/800/500" alt="River valley"></figure>
    <figure class="item"><img src="https://picsum.photos/id/1016/400/400" alt="Canyon"></figure>
    <figure class="item"><img src="https://picsum.photos/id/1018/400/400" alt="Mountains"></figure>
    <figure class="item tall"><img src="https://picsum.photos/id/1020/400/800" alt="Bear"></figure>
    <figure class="item"><img src="https://picsum.photos/id/1024/400/400" alt="Bird"></figure>
    <figure class="item"><img src="https://picsum.photos/id/1025/400/400" alt="Dog"></figure>
    <figure class="item wide"><img src="https://picsum.photos/id/1035/800/500" alt="Waterfall"></figure>
    <figure class="item"><img src="https://picsum.photos/id/1039/400/400" alt="Forest"></figure>
  </section>
</body>
</html>
````

**`05_css_grid_gallery/style.css`**

````css
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: Arial, sans-serif; padding: 20px; background: #f4f6f8; }
h1 { text-align: center; margin-bottom: 20px; }

.gallery {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  grid-auto-rows: 200px;
  gap: 12px;
  max-width: 1100px;
  margin: 0 auto;
}
.item { overflow: hidden; border-radius: 8px; background: #bdc3c7; }
.item.wide { grid-column: span 2; }
.item.tall { grid-row: span 2; }

.item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.4s ease;
}
.item:hover img { transform: scale(1.15); }

@media (max-width: 500px) { .item.wide { grid-column: span 1; } }
````

---

## Experiment 6

**Aim:** Implement a client-side contact form validation script in JavaScript ensuring name, valid email, and message fields are populated before submission.

**`06_form_validation/index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Form Validation</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <form id="contactForm" novalidate>
    <h2>Contact Me</h2>

    <label for="name">Name</label>
    <input type="text" id="name" placeholder="Your name">
    <small class="error" id="nameError"></small>

    <label for="email">Email</label>
    <input type="email" id="email" placeholder="you@example.com">
    <small class="error" id="emailError"></small>

    <label for="message">Message</label>
    <textarea id="message" rows="5" placeholder="Your message"></textarea>
    <small class="error" id="messageError"></small>

    <button type="submit">Send Message</button>
    <p class="success" id="successMsg"></p>
  </form>
  <script src="script.js"></script>
</body>
</html>
````

**`06_form_validation/script.js`**

````javascript
const form = document.getElementById('contactForm');
const fields = {
  name:    { el: document.getElementById('name'),    err: document.getElementById('nameError') },
  email:   { el: document.getElementById('email'),   err: document.getElementById('emailError') },
  message: { el: document.getElementById('message'), err: document.getElementById('messageError') },
};
const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

function setState(field, message) {
  field.err.textContent = message;
  field.el.classList.toggle('invalid', !!message);
  field.el.classList.toggle('valid', !message);
  return !message;
}

function validateName() {
  const v = fields.name.el.value.trim();
  return setState(fields.name, v === '' ? 'Name is required.' : v.length < 2 ? 'Name is too short.' : '');
}
function validateEmail() {
  const v = fields.email.el.value.trim();
  return setState(fields.email, v === '' ? 'Email is required.' : !emailPattern.test(v) ? 'Enter a valid email address.' : '');
}
function validateMessage() {
  const v = fields.message.el.value.trim();
  return setState(fields.message, v === '' ? 'Message is required.' : v.length < 10 ? 'Message must be at least 10 characters.' : '');
}

// live validation while typing
fields.name.el.addEventListener('input', validateName);
fields.email.el.addEventListener('input', validateEmail);
fields.message.el.addEventListener('input', validateMessage);

form.addEventListener('submit', (e) => {
  e.preventDefault();
  const ok = [validateName(), validateEmail(), validateMessage()].every(Boolean);
  const success = document.getElementById('successMsg');
  if (ok) {
    success.textContent = 'Thank you! Your message has been validated and is ready to send.';
    form.reset();
    Object.values(fields).forEach(f => f.el.classList.remove('valid'));
  } else {
    success.textContent = '';
  }
});
````

**`06_form_validation/style.css`**

````css
* { box-sizing: border-box; }
body { font-family: Arial, sans-serif; background: #f4f6f8; display: flex; justify-content: center; padding: 40px 15px; }
form { background: #fff; padding: 25px 30px; width: 100%; max-width: 450px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
h2 { margin-bottom: 15px; }
label { display: block; margin: 14px 0 5px; font-weight: bold; }
input, textarea { width: 100%; padding: 10px; border: 2px solid #ccc; border-radius: 5px; font-size: 1rem; }
input.invalid, textarea.invalid { border-color: #e74c3c; }
input.valid, textarea.valid { border-color: #27ae60; }
.error { color: #e74c3c; display: block; min-height: 18px; margin-top: 4px; }
button { margin-top: 15px; width: 100%; padding: 12px; background: #2c3e50; color: #fff; border: none; border-radius: 5px; font-size: 1rem; cursor: pointer; }
button:hover { background: #1a252f; }
.success { color: #27ae60; margin-top: 12px; font-weight: bold; text-align: center; }
````

---

## Experiment 7

**Aim:** Create a dark mode / light mode toggle switch using JavaScript to swap CSS root variables (:root) dynamically.

**`07_dark_mode/index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dark / Light Mode</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>My Portfolio</h1>
    <label class="switch" title="Toggle dark mode">
      <input type="checkbox" id="themeToggle">
      <span class="slider"></span>
    </label>
  </header>
  <main>
    <article class="card">
      <h2>Theme switcher</h2>
      <p>Toggling the switch changes the CSS variables defined on :root using JavaScript.</p>
    </article>
  </main>
  <script src="script.js"></script>
</body>
</html>
````

**`07_dark_mode/script.js`**

````javascript
const toggle = document.getElementById('themeToggle');
const root = document.documentElement;

const themes = {
  light: { '--bg': '#f4f6f8', '--text': '#222222', '--card': '#ffffff', '--header': '#2c3e50' },
  dark:  { '--bg': '#121212', '--text': '#eaeaea', '--card': '#1e1e1e', '--header': '#000000' },
};

function applyTheme(name) {
  Object.entries(themes[name]).forEach(([prop, value]) => root.style.setProperty(prop, value));
  toggle.checked = name === 'dark';
  try { localStorage.setItem('theme', name); } catch (e) {}
}

toggle.addEventListener('change', () => applyTheme(toggle.checked ? 'dark' : 'light'));

// restore saved preference, else follow the system setting
let saved = null;
try { saved = localStorage.getItem('theme'); } catch (e) {}
applyTheme(saved || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'));
````

**`07_dark_mode/style.css`**

````css
:root {
  --bg: #f4f6f8;
  --text: #222;
  --card: #ffffff;
  --header: #2c3e50;
}

* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: Arial, sans-serif; background: var(--bg); color: var(--text); transition: background 0.3s, color 0.3s; }
header { background: var(--header); color: #fff; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
main { max-width: 800px; margin: 30px auto; padding: 0 20px; }
.card { background: var(--card); padding: 20px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.15); transition: background 0.3s; }

/* toggle switch */
.switch { position: relative; width: 52px; height: 26px; }
.switch input { display: none; }
.slider { position: absolute; inset: 0; background: #95a5a6; border-radius: 26px; cursor: pointer; transition: background 0.3s; }
.slider::before { content: ""; position: absolute; width: 20px; height: 20px; left: 3px; top: 3px; background: #fff; border-radius: 50%; transition: transform 0.3s; }
.switch input:checked + .slider { background: #f1c40f; }
.switch input:checked + .slider::before { transform: translateX(26px); }
````

---

## Experiment 8

**Aim:** Design a pricing table section using CSS cards with distinct borders, hover elevation shadows, and highlighted popular plans.

**`08_pricing_table/index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pricing Table</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <section class="pricing">
    <h2>Choose Your Plan</h2>
    <div class="plans">
      <article class="plan">
        <h3>Basic</h3>
        <p class="price">&#8377;499<span>/month</span></p>
        <ul>
          <li>1 Website</li>
          <li>5 GB Storage</li>
          <li>Email Support</li>
        </ul>
        <a href="#" class="btn">Get Started</a>
      </article>

      <article class="plan popular">
        <span class="badge">Most Popular</span>
        <h3>Pro</h3>
        <p class="price">&#8377;999<span>/month</span></p>
        <ul>
          <li>5 Websites</li>
          <li>50 GB Storage</li>
          <li>Priority Support</li>
          <li>Free Domain</li>
        </ul>
        <a href="#" class="btn">Get Started</a>
      </article>

      <article class="plan">
        <h3>Premium</h3>
        <p class="price">&#8377;1999<span>/month</span></p>
        <ul>
          <li>Unlimited Websites</li>
          <li>200 GB Storage</li>
          <li>24/7 Support</li>
          <li>Free Domain + SSL</li>
        </ul>
        <a href="#" class="btn">Get Started</a>
      </article>
    </div>
  </section>
</body>
</html>
````

**`08_pricing_table/style.css`**

````css
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: Arial, sans-serif; background: #f4f6f8; }
.pricing { max-width: 1000px; margin: 0 auto; padding: 50px 20px; text-align: center; }
.pricing h2 { margin-bottom: 35px; }
.plans { display: flex; flex-wrap: wrap; gap: 25px; justify-content: center; align-items: stretch; }

.plan {
  position: relative;
  flex: 1 1 260px;
  max-width: 300px;
  background: #fff;
  border: 2px solid #dcdfe3;
  border-radius: 10px;
  padding: 30px 20px;
  transition: transform 0.3s, box-shadow 0.3s;
}
.plan:hover { transform: translateY(-8px); box-shadow: 0 12px 25px rgba(0,0,0,0.18); }

.plan.popular { border-color: #f39c12; border-width: 3px; transform: scale(1.04); }
.plan.popular:hover { transform: scale(1.04) translateY(-8px); }
.badge { position: absolute; top: -14px; left: 50%; transform: translateX(-50%); background: #f39c12; color: #fff; padding: 4px 16px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; }

.price { font-size: 2.2rem; font-weight: bold; margin: 15px 0; color: #2c3e50; }
.price span { font-size: 0.9rem; font-weight: normal; color: #7f8c8d; }
.plan ul { list-style: none; margin-bottom: 25px; }
.plan li { padding: 9px 0; border-bottom: 1px solid #eee; }
.btn { display: inline-block; background: #2c3e50; color: #fff; padding: 11px 28px; border-radius: 25px; text-decoration: none; }
.popular .btn { background: #f39c12; }
.btn:hover { opacity: 0.85; }
````

---

## Experiment 9

**Aim:** Implement a smooth-scrolling navigation effect in JavaScript when clicking anchor links in the header menu.

**`09_smooth_scroll/index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Smooth Scrolling</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <nav>
      <a href="#home">Home</a>
      <a href="#about">About</a>
      <a href="#projects">Projects</a>
      <a href="#contact">Contact</a>
    </nav>
  </header>
  <section id="home" class="panel p1"><h2>Home</h2></section>
  <section id="about" class="panel p2"><h2>About</h2></section>
  <section id="projects" class="panel p3"><h2>Projects</h2></section>
  <section id="contact" class="panel p4"><h2>Contact</h2></section>
  <script src="script.js"></script>
</body>
</html>
````

**`09_smooth_scroll/script.js`**

````javascript
const headerHeight = 60;

// custom easing animation (works even if CSS scroll-behavior is unsupported)
function smoothScrollTo(targetY, duration = 700) {
  const startY = window.scrollY;
  const distance = targetY - startY;
  let startTime = null;

  function easeInOut(t) { return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t; }

  function step(timestamp) {
    if (!startTime) startTime = timestamp;
    const progress = Math.min((timestamp - startTime) / duration, 1);
    window.scrollTo(0, startY + distance * easeInOut(progress));
    if (progress < 1) requestAnimationFrame(step);
  }
  requestAnimationFrame(step);
}

document.querySelectorAll('header a[href^="#"]').forEach(link => {
  link.addEventListener('click', (e) => {
    e.preventDefault();
    const target = document.querySelector(link.getAttribute('href'));
    if (target) {
      smoothScrollTo(target.offsetTop - headerHeight + 60);
      history.pushState(null, '', link.getAttribute('href'));
    }
  });
});
````

**`09_smooth_scroll/style.css`**

````css
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: Arial, sans-serif; }
header { position: fixed; top: 0; left: 0; width: 100%; height: 60px; background: #2c3e50; z-index: 10; display: flex; align-items: center; justify-content: center; }
nav a { color: #fff; text-decoration: none; margin: 0 14px; }
nav a:hover { color: #f1c40f; }
.panel { min-height: 100vh; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 2rem; }
.p1 { background: #1abc9c; } .p2 { background: #3498db; } .p3 { background: #9b59b6; } .p4 { background: #e67e22; }
````

---

## Experiment 10

**Aim:** Build an interactive FAQ accordion section where clicking question headings expands and collapses answer text using JavaScript DOM manipulation.

**`10_faq_accordion/index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ Accordion</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <section class="faq">
    <h2>Frequently Asked Questions</h2>

    <div class="faq-item">
      <button class="faq-question">What services do you offer?<span class="icon">+</span></button>
      <div class="faq-answer"><p>I offer web design, front-end development and basic back-end development with PHP and Python.</p></div>
    </div>
    <div class="faq-item">
      <button class="faq-question">How long does a project take?<span class="icon">+</span></button>
      <div class="faq-answer"><p>A simple website takes 1 to 2 weeks. Larger applications may take a month or more.</p></div>
    </div>
    <div class="faq-item">
      <button class="faq-question">Do you provide support after delivery?<span class="icon">+</span></button>
      <div class="faq-answer"><p>Yes, I provide 30 days of free support for bug fixes after the project is delivered.</p></div>
    </div>
    <div class="faq-item">
      <button class="faq-question">How can I contact you?<span class="icon">+</span></button>
      <div class="faq-answer"><p>You can email me at aman@example.com or use the contact form on the Contact page.</p></div>
    </div>
  </section>
  <script src="script.js"></script>
</body>
</html>
````

**`10_faq_accordion/script.js`**

````javascript
const items = document.querySelectorAll('.faq-item');

items.forEach(item => {
  const question = item.querySelector('.faq-question');
  const answer = item.querySelector('.faq-answer');

  question.addEventListener('click', () => {
    const isOpen = item.classList.contains('active');

    // close all other items (only one open at a time)
    items.forEach(other => {
      other.classList.remove('active');
      other.querySelector('.faq-answer').style.maxHeight = null;
    });

    if (!isOpen) {
      item.classList.add('active');
      answer.style.maxHeight = answer.scrollHeight + 'px';
    }
  });
});
````

**`10_faq_accordion/style.css`**

````css
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: Arial, sans-serif; background: #f4f6f8; }
.faq { max-width: 700px; margin: 50px auto; padding: 0 20px; }
.faq h2 { margin-bottom: 20px; text-align: center; }
.faq-item { background: #fff; margin-bottom: 10px; border-radius: 6px; box-shadow: 0 1px 4px rgba(0,0,0,0.1); overflow: hidden; }
.faq-question { width: 100%; display: flex; justify-content: space-between; align-items: center; padding: 16px 18px; background: none; border: none; font-size: 1rem; font-weight: bold; text-align: left; cursor: pointer; }
.faq-question:hover { background: #eef2f5; }
.icon { font-size: 1.4rem; transition: transform 0.3s; }
.faq-item.active .icon { transform: rotate(45deg); }
.faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.35s ease; }
.faq-answer p { padding: 0 18px 16px; color: #555; line-height: 1.6; }
````

---

## Experiment 11

**Aim:** Create a testimonials slider carousel powered by JavaScript arrays and CSS opacity transitions.

**`11_testimonial_slider/index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Testimonials Slider</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <section class="testimonials">
    <h2>What Clients Say</h2>
    <div class="slider">
      <blockquote id="testimonial" class="fade">
        <p id="quote"></p>
        <footer id="author"></footer>
      </blockquote>
    </div>
    <div class="controls">
      <button id="prev" aria-label="Previous">&#10094;</button>
      <div class="dots" id="dots"></div>
      <button id="next" aria-label="Next">&#10095;</button>
    </div>
  </section>
  <script src="script.js"></script>
</body>
</html>
````

**`11_testimonial_slider/script.js`**

````javascript
const testimonials = [
  { quote: 'Aman delivered our website ahead of schedule and the quality was outstanding.', author: 'Rohit Sharma, Startup Founder' },
  { quote: 'Clean code, responsive design and great communication throughout the project.', author: 'Priya Singh, Marketing Lead' },
  { quote: 'Our online traffic doubled after the redesign. Highly recommended!', author: 'Neha Gupta, Shop Owner' },
  { quote: 'Professional, reliable and very easy to work with.', author: 'Karan Mehta, Project Manager' },
];

const box = document.getElementById('testimonial');
const quoteEl = document.getElementById('quote');
const authorEl = document.getElementById('author');
const dotsEl = document.getElementById('dots');
let index = 0;
let timer;

testimonials.forEach((_, i) => {
  const dot = document.createElement('span');
  dot.className = 'dot';
  dot.addEventListener('click', () => { show(i); restartAuto(); });
  dotsEl.appendChild(dot);
});

function show(i) {
  index = (i + testimonials.length) % testimonials.length;
  box.classList.add('fade-out');                 // CSS opacity transition
  setTimeout(() => {
    quoteEl.textContent = '\u201C' + testimonials[index].quote + '\u201D';
    authorEl.textContent = testimonials[index].author;
    dotsEl.querySelectorAll('.dot').forEach((d, n) => d.classList.toggle('active', n === index));
    box.classList.remove('fade-out');
  }, 500);
}

function restartAuto() {
  clearInterval(timer);
  timer = setInterval(() => show(index + 1), 4000);
}

document.getElementById('next').addEventListener('click', () => { show(index + 1); restartAuto(); });
document.getElementById('prev').addEventListener('click', () => { show(index - 1); restartAuto(); });

show(0);
restartAuto();
````

**`11_testimonial_slider/style.css`**

````css
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: Arial, sans-serif; background: #f4f6f8; }
.testimonials { max-width: 700px; margin: 60px auto; padding: 0 20px; text-align: center; }
.testimonials h2 { margin-bottom: 25px; }
.slider { background: #fff; border-radius: 10px; padding: 35px 30px; min-height: 180px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(0,0,0,0.12); }
blockquote { opacity: 1; transition: opacity 0.5s ease; }
blockquote.fade-out { opacity: 0; }
#quote { font-size: 1.15rem; font-style: italic; line-height: 1.6; margin-bottom: 14px; }
#author { font-weight: bold; color: #2c3e50; }
.controls { display: flex; justify-content: center; align-items: center; gap: 18px; margin-top: 18px; }
.controls button { background: #2c3e50; color: #fff; border: none; width: 38px; height: 38px; border-radius: 50%; cursor: pointer; }
.controls button:hover { background: #1a252f; }
.dots { display: flex; gap: 8px; }
.dot { width: 11px; height: 11px; border-radius: 50%; background: #bdc3c7; cursor: pointer; transition: background 0.3s; }
.dot.active { background: #2c3e50; }
````

---

## Experiment 12

**Aim:** Design a footer section containing social media icon links styled with CSS flexbox and hover color transitions.

**`12_footer_social/index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Footer with Social Icons</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main><h2>Page content goes here</h2></main>

  <footer class="site-footer">
    <p class="footer-title">Follow Me</p>
    <ul class="social">
      <li><a href="#" class="facebook" aria-label="Facebook">
        <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M14 8V6c0-.6.4-1 1-1h2V2h-3c-2.8 0-4 1.8-4 4v2H8v3h2v9h4v-9h2.5l.5-3h-3z"/></svg></a></li>
      <li><a href="#" class="twitter" aria-label="Twitter">
        <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M3 3l7.2 9.6L3.4 21H6l5.4-6.2L16 21h5l-7.5-10L20.2 3h-2.5l-5 5.8L8 3z"/></svg></a></li>
      <li><a href="#" class="linkedin" aria-label="LinkedIn">
        <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M4 9h4v11H4zM6 3.5a2.3 2.3 0 110 4.6 2.3 2.3 0 010-4.6zM10 9h3.8v1.6c.6-1 1.9-1.9 3.8-1.9 4 0 4.4 2.600 4.400 6V20h-4v-4.800c0-1.300 0-2.800-1.800-2.800s-2.200 1.300-2.200 2.700V20h-4z"/></svg></a></li>
      <li><a href="#" class="github" aria-label="GitHub">
        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 19c-4 1.500-4-2-6-2m12 4v-3.500c0-1 .1-1.400-.5-2 2.800-.3 5.500-1.400 5.500-6a4.600 4.600 0 00-1.300-3.200 4.200 4.200 0 00-.1-3.200s-1.100-.3-3.500 1.300a12 12 0 00-6.200 0C6.500 2.800 5.400 3.100 5.400 3.100a4.200 4.200 0 00-.1 3.200A4.600 4.600 0 004 9.500c0 4.600 2.700 5.700 5.500 6-.6.600-.6 1.200-.5 2V21"/></svg></a></li>
    </ul>
    <p class="copy">&copy; 2026 Aman Kumar</p>
  </footer>
</body>
</html>
````

**`12_footer_social/style.css`**

````css
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: Arial, sans-serif; display: flex; flex-direction: column; min-height: 100vh; }
main { flex: 1; padding: 40px; }

.site-footer { background: #2c3e50; color: #ecf0f1; text-align: center; padding: 30px 20px; }
.footer-title { font-size: 1.1rem; margin-bottom: 15px; }

.social { list-style: none; display: flex; justify-content: center; flex-wrap: wrap; gap: 15px; margin-bottom: 20px; }
.social a {
  display: flex; align-items: center; justify-content: center;
  width: 46px; height: 46px; border-radius: 50%;
  background: #3d566e; color: #fff; text-decoration: none;
  transition: background 0.3s, transform 0.3s;
}
.social a:hover { transform: translateY(-4px); }
.social .facebook:hover { background: #1877f2; }
.social .twitter:hover  { background: #000000; }
.social .linkedin:hover { background: #0a66c2; }
.social .github:hover   { background: #6e5494; }
.copy { font-size: 0.85rem; color: #bdc3c7; }
````

---

## Experiment 13

**Aim:** Implement a 'Back to Top' floating button that appears when scrolling down the webpage and smoothly scrolls back to the top when clicked.

**`13_back_to_top/index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Back to Top Button</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header><h1>Scroll down</h1></header>
  <main>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Scroll down to see the button appear.</p>
    <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.</p>
  </main>

  <button id="backToTop" title="Back to top" aria-label="Back to top">&#8593;</button>
  <script src="script.js"></script>
</body>
</html>
````

**`13_back_to_top/script.js`**

````javascript
const backToTop = document.getElementById('backToTop');

window.addEventListener('scroll', () => {
  backToTop.classList.toggle('show', window.scrollY > 300);
});

backToTop.addEventListener('click', () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});
````

**`13_back_to_top/style.css`**

````css
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: Arial, sans-serif; }
header { background: #2c3e50; color: #fff; padding: 20px; text-align: center; }
main p { padding: 120px 40px; font-size: 1.2rem; border-bottom: 1px solid #eee; }

#backToTop {
  position: fixed;
  bottom: 25px;
  right: 25px;
  width: 48px;
  height: 48px;
  border: none;
  border-radius: 50%;
  background: #2c3e50;
  color: #fff;
  font-size: 1.4rem;
  cursor: pointer;
  box-shadow: 0 3px 10px rgba(0,0,0,0.3);
  opacity: 0;
  visibility: hidden;
  transform: translateY(15px);
  transition: opacity 0.3s, visibility 0.3s, transform 0.3s, background 0.3s;
}
#backToTop.show { opacity: 1; visibility: visible; transform: translateY(0); }
#backToTop:hover { background: #f39c12; }
````

---

## Experiment 14

**Aim:** Write custom CSS media queries to ensure the website is fully responsive across mobile, tablet, and desktop viewports.

**`14_media_queries/index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Website</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>My Portfolio</h1>
    <nav><a href="#">Home</a><a href="#">About</a><a href="#">Projects</a><a href="#">Contact</a></nav>
  </header>
  <div class="layout">
    <main>
      <section class="cards">
        <article class="card">Card 1</article>
        <article class="card">Card 2</article>
        <article class="card">Card 3</article>
        <article class="card">Card 4</article>
        <article class="card">Card 5</article>
        <article class="card">Card 6</article>
      </section>
    </main>
    <aside><h3>Sidebar</h3><p>Links and extra information.</p></aside>
  </div>
  <p class="device" id="device"></p>
</body>
</html>
````

**`14_media_queries/style.css`**

````css
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: Arial, sans-serif; background: #f4f6f8; }

/* ---------- Mobile first (default: up to 599px) ---------- */
header { background: #2c3e50; color: #fff; padding: 15px; text-align: center; }
nav { display: flex; flex-direction: column; gap: 8px; margin-top: 10px; }
nav a { color: #ecf0f1; text-decoration: none; }
.layout { display: flex; flex-direction: column; gap: 15px; padding: 15px; }
.cards { display: grid; grid-template-columns: 1fr; gap: 15px; }
.card { background: #fff; padding: 40px 15px; text-align: center; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
aside { background: #dfe6e9; padding: 15px; border-radius: 8px; }
h1 { font-size: 1.4rem; }
.device::after { content: "Viewport: Mobile (< 600px)"; }
.device { position: fixed; bottom: 10px; left: 10px; background: #e74c3c; color: #fff; padding: 6px 12px; border-radius: 15px; font-size: 0.8rem; }

/* ---------- Tablet (600px - 1023px) ---------- */
@media (min-width: 600px) {
  header { display: flex; justify-content: space-between; align-items: center; text-align: left; }
  nav { flex-direction: row; gap: 18px; margin-top: 0; }
  .cards { grid-template-columns: repeat(2, 1fr); }
  h1 { font-size: 1.7rem; }
  .device { background: #f39c12; }
  .device::after { content: "Viewport: Tablet (600px - 1023px)"; }
}

/* ---------- Desktop (1024px and above) ---------- */
@media (min-width: 1024px) {
  .layout { flex-direction: row; max-width: 1200px; margin: 0 auto; padding: 25px; }
  main { flex: 3; }
  aside { flex: 1; align-self: flex-start; }
  .cards { grid-template-columns: repeat(3, 1fr); }
  h1 { font-size: 2rem; }
  .device { background: #27ae60; }
  .device::after { content: "Viewport: Desktop (1024px+)"; }
}
````

---

## Experiment 15

**Aim:** Create a statistics counter animation in JavaScript that increments numbers from zero to target values when scrolled into view.

**`15_counter_animation/index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Statistics Counter</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <section class="spacer"><h2>Scroll down to see the counters</h2></section>

  <section class="stats" id="stats">
    <div class="stat"><span class="number" data-target="150">0</span><span class="plus">+</span><p>Projects Completed</p></div>
    <div class="stat"><span class="number" data-target="85">0</span><span class="plus">+</span><p>Happy Clients</p></div>
    <div class="stat"><span class="number" data-target="12">0</span><span class="plus">+</span><p>Awards Won</p></div>
    <div class="stat"><span class="number" data-target="5000">0</span><span class="plus">+</span><p>Cups of Coffee</p></div>
  </section>

  <section class="spacer"></section>
  <script src="script.js"></script>
</body>
</html>
````

**`15_counter_animation/script.js`**

````javascript
const counters = document.querySelectorAll('.number');

function animateCounter(el) {
  const target = +el.dataset.target;
  const duration = 2000;                       // ms
  const startTime = performance.now();

  function update(now) {
    const progress = Math.min((now - startTime) / duration, 1);
    el.textContent = Math.floor(progress * target).toLocaleString();
    if (progress < 1) requestAnimationFrame(update);
    else el.textContent = target.toLocaleString();
  }
  requestAnimationFrame(update);
}

// start counting only when the stat is scrolled into view (once)
const observer = new IntersectionObserver((entries, obs) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      animateCounter(entry.target);
      obs.unobserve(entry.target);
    }
  });
}, { threshold: 0.5 });

counters.forEach(c => observer.observe(c));
````

**`15_counter_animation/style.css`**

````css
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: Arial, sans-serif; }
.spacer { min-height: 100vh; display: flex; align-items: center; justify-content: center; background: #ecf0f1; }
.stats { display: flex; flex-wrap: wrap; justify-content: center; gap: 30px; background: #2c3e50; color: #fff; padding: 70px 20px; }
.stat { text-align: center; min-width: 170px; }
.number { font-size: 3rem; font-weight: bold; color: #f1c40f; }
.plus { font-size: 2rem; color: #f1c40f; }
.stat p { margin-top: 8px; color: #ecf0f1; }
````

---

## Experiment 16

**Aim:** Design a product feature grid using CSS flexbox with custom vector icons and responsive spacing.

**`16_feature_grid/index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Feature Grid</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <section class="features">
    <h2>Why Choose Us</h2>
    <div class="feature-grid">

      <article class="feature">
        <svg viewBox="0 0 24 24" class="icon"><path d="M13 2L4 14h6l-1 8 9-12h-6z"/></svg>
        <h3>Fast Performance</h3>
        <p>Optimised pages that load in under two seconds.</p>
      </article>

      <article class="feature">
        <svg viewBox="0 0 24 24" class="icon"><path d="M12 2l8 3v6c0 5-3.400 9.500-8 11-4.600-1.500-8-6-8-11V5z"/></svg>
        <h3>Secure</h3>
        <p>Built-in protection against common web attacks.</p>
      </article>

      <article class="feature">
        <svg viewBox="0 0 24 24" class="icon"><path d="M7 2h10a2 2 0 012 2v16a2 2 0 01-2 2H7a2 2 0 01-2-2V4a2 2 0 012-2zm5 17a1 1 0 100-2 1 1 0 000 2z"/></svg>
        <h3>Mobile Friendly</h3>
        <p>Looks great on phones, tablets and desktops.</p>
      </article>

      <article class="feature">
        <svg viewBox="0 0 24 24" class="icon"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zm-1.500 14.500l-4-4 1.400-1.400 2.600 2.600 5.600-5.600 1.400 1.400z"/></svg>
        <h3>Easy to Use</h3>
        <p>Clean interface that needs no training.</p>
      </article>

      <article class="feature">
        <svg viewBox="0 0 24 24" class="icon"><path d="M4 4h16v12H4zM2 18h20v2H2z"/></svg>
        <h3>Cross Browser</h3>
        <p>Tested on Chrome, Firefox, Edge and Safari.</p>
      </article>

      <article class="feature">
        <svg viewBox="0 0 24 24" class="icon"><path d="M12 2a7 7 0 00-4 12.700V18h8v-3.300A7 7 0 0012 2zM9 20h6v2H9z"/></svg>
        <h3>Smart Design</h3>
        <p>Thoughtful layouts that guide users naturally.</p>
      </article>

    </div>
  </section>
</body>
</html>
````

**`16_feature_grid/style.css`**

````css
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: Arial, sans-serif; background: #f4f6f8; }
.features { max-width: 1100px; margin: 0 auto; padding: 50px 20px; text-align: center; }
.features h2 { margin-bottom: 35px; }

.feature-grid { display: flex; flex-wrap: wrap; gap: clamp(15px, 3vw, 30px); }
.feature {
  flex: 1 1 280px;
  background: #fff;
  padding: clamp(18px, 3vw, 30px);
  border-radius: 10px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  transition: transform 0.3s;
}
.feature:hover { transform: translateY(-5px); }

.icon { width: 52px; height: 52px; fill: #2c3e50; margin-bottom: 12px; padding: 10px; background: #eaf0f6; border-radius: 12px; box-sizing: content-box; }
.feature h3 { margin-bottom: 8px; color: #2c3e50; }
.feature p { color: #666; line-height: 1.5; }
````

---

## Experiment 17

**Aim:** Implement a modal popup window in JavaScript that triggers upon clicking a button and closes upon clicking an 'X' or outside the modal.

**`17_modal_popup/index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modal Popup</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main>
    <h1>Modal Popup Demo</h1>
    <button id="openModal" class="open-btn">Open Modal</button>
  </main>

  <div class="modal" id="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="modal-content">
      <span class="close" id="closeModal" aria-label="Close">&times;</span>
      <h2 id="modalTitle">Subscribe to Newsletter</h2>
      <p>Get the latest updates about new projects and articles directly in your inbox.</p>
      <input type="email" placeholder="Enter your email">
      <button class="open-btn">Subscribe</button>
    </div>
  </div>
  <script src="script.js"></script>
</body>
</html>
````

**`17_modal_popup/script.js`**

````javascript
const modal = document.getElementById('modal');
const openBtn = document.getElementById('openModal');
const closeBtn = document.getElementById('closeModal');

const openModal = () => modal.classList.add('show');
const closeModal = () => modal.classList.remove('show');

openBtn.addEventListener('click', openModal);
closeBtn.addEventListener('click', closeModal);

// close when clicking on the dark overlay (outside the content box)
modal.addEventListener('click', (e) => {
  if (e.target === modal) closeModal();
});

// close with the Escape key
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') closeModal();
});
````

**`17_modal_popup/style.css`**

````css
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: Arial, sans-serif; }
main { min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 20px; }
.open-btn { background: #2c3e50; color: #fff; border: none; padding: 12px 28px; border-radius: 6px; font-size: 1rem; cursor: pointer; }
.open-btn:hover { background: #1a252f; }

.modal { position: fixed; inset: 0; background: rgba(0,0,0,0.6); display: flex; align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: opacity 0.3s, visibility 0.3s; z-index: 100; }
.modal.show { opacity: 1; visibility: visible; }
.modal-content { position: relative; background: #fff; width: 90%; max-width: 420px; padding: 30px; border-radius: 10px; transform: scale(0.85); transition: transform 0.3s; }
.modal.show .modal-content { transform: scale(1); }
.modal-content h2 { margin-bottom: 10px; }
.modal-content p { margin-bottom: 15px; color: #555; }
.modal-content input { width: 100%; padding: 10px; margin-bottom: 15px; border: 2px solid #ccc; border-radius: 5px; }
.close { position: absolute; top: 10px; right: 16px; font-size: 1.8rem; cursor: pointer; color: #888; }
.close:hover { color: #e74c3c; }
````

---

## Experiment 18

**Aim:** Write CSS styles for print media (@media print) to ensure clean printing of the portfolio pages.

**`18_print_styles/index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Friendly Portfolio</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Aman Kumar</h1>
    <nav><a href="#">Home</a><a href="#">About</a><a href="#">Projects</a><a href="#">Contact</a></nav>
  </header>

  <main>
    <section>
      <h2>About Me</h2>
      <p>MCA student who builds responsive web applications with HTML, CSS, JavaScript, PHP and Python.</p>
    </section>
    <section>
      <h2>Projects</h2>
      <article class="project"><h3>Portfolio Website</h3><p>Multi-page responsive site. Source: <a href="https://github.com/example/portfolio">github.com/example/portfolio</a></p></article>
      <article class="project"><h3>Student System</h3><p>PHP and MySQL CRUD application. Source: <a href="https://github.com/example/students">github.com/example/students</a></p></article>
    </section>
    <button onclick="window.print()" class="print-btn">Print this page</button>
    <div class="ad-banner">Advertisement banner (hidden when printing)</div>
  </main>

  <footer>&copy; 2026 Aman Kumar</footer>
</body>
</html>
````

**`18_print_styles/style.css`**

````css
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: Arial, sans-serif; line-height: 1.6; background: #f4f6f8; color: #222; }
header { background: #2c3e50; color: #fff; padding: 15px 30px; }
nav a { color: #ecf0f1; margin-right: 15px; text-decoration: none; }
main { max-width: 800px; margin: 25px auto; padding: 0 20px; }
section { margin-bottom: 25px; }
.project { background: #fff; padding: 15px; margin: 10px 0; border-left: 4px solid #2c3e50; }
.print-btn { background: #2c3e50; color: #fff; border: none; padding: 10px 22px; border-radius: 5px; cursor: pointer; }
.ad-banner { background: #f1c40f; padding: 25px; text-align: center; margin-top: 20px; }
footer { text-align: center; padding: 15px; background: #2c3e50; color: #fff; }

/* ---------- Print styles ---------- */
@media print {
  @page { margin: 2cm; }

  body { background: #fff; color: #000; font-size: 12pt; font-family: Georgia, "Times New Roman", serif; }

  /* hide things that make no sense on paper */
  nav, .print-btn, .ad-banner, footer { display: none !important; }

  header { background: none; color: #000; padding: 0 0 10px; border-bottom: 2px solid #000; }
  main { max-width: 100%; margin: 0; padding: 0; }

  .project { background: none; border: 1px solid #999; border-left: 4px solid #000; page-break-inside: avoid; }
  h2, h3 { page-break-after: avoid; }

  /* show the URL after each link */
  a { color: #000; text-decoration: none; }
  a[href^="http"]::after { content: " (" attr(href) ")"; font-size: 10pt; color: #444; }
}
````

---

## Experiment 19

**Aim:** Create an interactive search filter bar in JavaScript that filters portfolio project cards dynamically as the user types.

**`19_search_filter/index.html`**

````html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project Search Filter</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <section class="projects">
    <h2>My Projects</h2>
    <input type="search" id="searchInput" placeholder="Search by title, tag or description..." autocomplete="off">
    <p id="resultCount" class="count"></p>

    <div class="grid" id="projectGrid">
      <article class="card" data-tags="php mysql crud"><h3>Student Management</h3><p>CRUD application using PHP and MySQL.</p><span>PHP</span><span>MySQL</span></article>
      <article class="card" data-tags="python flask api"><h3>Weather Dashboard</h3><p>Python app fetching live weather from an API.</p><span>Python</span><span>API</span></article>
      <article class="card" data-tags="html css responsive"><h3>Portfolio Website</h3><p>Responsive multi-page website with Flexbox and Grid.</p><span>HTML</span><span>CSS</span></article>
      <article class="card" data-tags="javascript game"><h3>Tic Tac Toe</h3><p>Browser game built with JavaScript.</p><span>JavaScript</span></article>
      <article class="card" data-tags="python mysql report"><h3>Sales Report Generator</h3><p>Generates summary reports from MySQL data.</p><span>Python</span><span>MySQL</span></article>
      <article class="card" data-tags="javascript css quiz"><h3>Quiz App</h3><p>Interactive quiz with score tracking and timer.</p><span>JavaScript</span><span>CSS</span></article>
    </div>
    <p id="noResults" class="no-results">No projects match your search.</p>
  </section>
  <script src="script.js"></script>
</body>
</html>
````

**`19_search_filter/script.js`**

````javascript
const input = document.getElementById('searchInput');
const cards = document.querySelectorAll('#projectGrid .card');
const noResults = document.getElementById('noResults');
const resultCount = document.getElementById('resultCount');

function filterProjects() {
  const query = input.value.trim().toLowerCase();
  let visible = 0;

  cards.forEach(card => {
    const text = (card.textContent + ' ' + card.dataset.tags).toLowerCase();
    const match = text.includes(query);
    card.classList.toggle('hidden', !match);
    if (match) visible++;
  });

  noResults.style.display = visible === 0 ? 'block' : 'none';
  resultCount.textContent = query ? `${visible} of ${cards.length} projects found` : `${cards.length} projects`;
}

input.addEventListener('input', filterProjects);   // filters on every keystroke
filterProjects();
````

**`19_search_filter/style.css`**

````css
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: Arial, sans-serif; background: #f4f6f8; }
.projects { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
.projects h2 { text-align: center; margin-bottom: 20px; }
#searchInput { display: block; width: 100%; max-width: 500px; margin: 0 auto 10px; padding: 12px 16px; border: 2px solid #ccc; border-radius: 25px; font-size: 1rem; }
#searchInput:focus { outline: none; border-color: #2c3e50; }
.count { text-align: center; color: #777; margin-bottom: 20px; font-size: 0.9rem; }
.grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 18px; }
.card { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
.card.hidden { display: none; }
.card h3 { color: #2c3e50; margin-bottom: 8px; }
.card p { color: #555; margin-bottom: 12px; }
.card span { display: inline-block; background: #eaf0f6; color: #2c3e50; padding: 3px 10px; border-radius: 12px; font-size: 0.8rem; margin-right: 5px; }
mark { background: #f1c40f; padding: 0 2px; }
.no-results { display: none; text-align: center; color: #e74c3c; margin-top: 25px; }
````

