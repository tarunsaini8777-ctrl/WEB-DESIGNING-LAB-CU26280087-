document.addEventListener('DOMContentLoaded', () => {
  const $ = (s, c = document) => c.querySelector(s);
  const $$ = (s, c = document) => [...c.querySelectorAll(s)];

  /* Task 4: hamburger menu toggle */
  const burger = $('.hamburger'), links = $('.nav-links');
  burger.addEventListener('click', () => {
    const open = links.classList.toggle('open');
    burger.classList.toggle('open', open);
    burger.setAttribute('aria-expanded', open);
  });

  /* Task 7: dark/light toggle — swaps data-theme which redefines :root variables */
  const root = document.documentElement, sw = $('.theme-switch');
  sw.addEventListener('click', () => {
    const next = root.dataset.theme === 'dark' ? 'light' : 'dark';
    root.dataset.theme = next;
    try { localStorage.setItem('theme', next); } catch (e) {}
  });

  /* Task 9: smooth scrolling for in-page anchor links (JS) */
  $$('a[href^="#"]').forEach(a => a.addEventListener('click', e => {
    const id = a.getAttribute('href');
    const target = id.length > 1 ? $(id) : document.body;
    if (!target) return;
    e.preventDefault();
    const y = id.length > 1 ? target.getBoundingClientRect().top + window.scrollY - 70 : 0;
    window.scrollTo({ top: y, behavior: 'smooth' });
    links.classList.remove('open'); burger.classList.remove('open');
  }));

  /* Task 13: back-to-top button */
  const top = $('#backToTop');
  window.addEventListener('scroll', () => top.classList.toggle('visible', window.scrollY > 300));
  top.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

  /* Task 15: counter animation when scrolled into view */
  const counters = $$('[data-target]');
  if (counters.length) {
    const io = new IntersectionObserver((entries, obs) => entries.forEach(en => {
      if (!en.isIntersecting) return;
      const el = en.target, target = +el.dataset.target, dur = 1800, t0 = performance.now();
      const tick = now => {
        const p = Math.min((now - t0) / dur, 1);
        el.textContent = Math.floor(p * target) + (el.dataset.suffix || '');
        if (p < 1) requestAnimationFrame(tick);
      };
      requestAnimationFrame(tick);
      obs.unobserve(el);
    }), { threshold: .5 });
    counters.forEach(c => io.observe(c));
  }

  /* Task 10: FAQ accordion */
  $$('.faq-item').forEach(item => {
    const q = $('.faq-q', item), a = $('.faq-a', item);
    q.addEventListener('click', () => {
      const open = item.classList.toggle('open');
      a.style.maxHeight = open ? a.scrollHeight + 'px' : 0;
      q.setAttribute('aria-expanded', open);
    });
  });

  /* Task 11: testimonials slider driven by a JS array */
  const slider = $('#slider');
  if (slider) {
    const testimonials = [
      { text: 'Delivered a polished, accessible site two days ahead of schedule.', who: 'Priya S., Product Manager' },
      { text: 'Clean code, great communication, and a design that just works on every device.', who: 'Rahul M., Startup Founder' },
      { text: 'Our traffic doubled after the redesign. Highly recommended.', who: 'Ananya K., Marketing Lead' },
      { text: 'A rare developer who cares about both pixels and performance.', who: 'David L., Engineering Manager' }
    ];
    const dots = $('#sliderDots');
    testimonials.forEach((t, i) => {
      slider.insertAdjacentHTML('beforeend', `<div class="slide"><blockquote>“${t.text}”</blockquote><cite>— ${t.who}</cite></div>`);
      dots.insertAdjacentHTML('beforeend', `<button aria-label="Testimonial ${i + 1}"></button>`);
    });
    const slides = $$('.slide', slider), dotBtns = $$('button', dots);
    let idx = 0, timer;
    const show = i => {
      idx = (i + slides.length) % slides.length;
      slides.forEach((s, n) => s.classList.toggle('active', n === idx));
      dotBtns.forEach((d, n) => d.classList.toggle('active', n === idx));
    };
    const auto = () => { clearInterval(timer); timer = setInterval(() => show(idx + 1), 4500); };
    dotBtns.forEach((d, n) => d.addEventListener('click', () => { show(n); auto(); }));
    show(0); auto();
  }

  /* Task 17: modal */
  const modal = $('#modal');
  if (modal) {
    const close = () => modal.classList.remove('show');
    $('#openModal').addEventListener('click', () => modal.classList.add('show'));
    $('.modal-close', modal).addEventListener('click', close);
    modal.addEventListener('click', e => { if (e.target === modal) close(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') close(); });
  }

  /* Task 19: live search filter for project cards */
  const search = $('#search');
  if (search) {
    const cards = $$('#projectCards .card'), none = $('.no-results');
    search.addEventListener('input', () => {
      const q = search.value.trim().toLowerCase();
      let shown = 0;
      cards.forEach(c => {
        const match = c.textContent.toLowerCase().includes(q);
        c.style.display = match ? '' : 'none';
        if (match) shown++;
      });
      none.style.display = shown ? 'none' : 'block';
    });
  }

  /* Task 6: contact form validation */
  const form = $('#contactForm');
  if (form) {
    const rules = {
      name: v => v.trim() ? '' : 'Please enter your name.',
      email: v => !v.trim() ? 'Please enter your email.' : /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v) ? '' : 'Please enter a valid email address.',
      message: v => v.trim() ? '' : 'Please enter a message.'
    };
    const check = f => {
      const msg = rules[f.name](f.value);
      f.closest('.field').classList.toggle('invalid', !!msg);
      $('.error', f.closest('.field')).textContent = msg;
      return !msg;
    };
    $$('input,textarea', form).forEach(f => f.addEventListener('input', () => check(f)));
    form.addEventListener('submit', e => {
      e.preventDefault();
      const ok = $$('input,textarea', form).map(check).every(Boolean);
      const success = $('.form-success');
      success.style.display = ok ? 'block' : 'none';
      if (ok) form.reset();
    });
  }
});
