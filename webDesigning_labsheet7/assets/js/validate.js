// Client-side validation for register, login and checkout forms.
// (Server-side validation in PHP is still the real gatekeeper.)
document.addEventListener('DOMContentLoaded', () => {
  const rules = {
    name:     v => v.trim().length >= 2 || 'Name must be at least 2 characters.',
    email:    v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v) || 'Enter a valid email address.',
    password: v => /^(?=.*[A-Za-z])(?=.*\d).{8,}$/.test(v) || 'Password needs 8+ characters with a letter and a number.',
    confirm:  (v, f) => v === f.querySelector('[name=password]').value || 'Passwords do not match.',
    ship_name:    v => v.trim().length >= 2 || 'Enter the recipient name.',
    ship_address: v => v.trim().length >= 5 || 'Enter a full street address.',
    ship_city:    v => v.trim().length >= 2 || 'Enter the city.',
    ship_zip:     v => /^[A-Za-z0-9 -]{4,10}$/.test(v) || 'Enter a valid postal code.',
    ship_phone:   v => /^[0-9+() -]{7,15}$/.test(v) || 'Enter a valid phone number.',
  };
  document.querySelectorAll('form[data-validate]').forEach(form => {
    const check = el => {
      const rule = rules[el.name];
      if (!rule) return true;
      // On the login form, only require a non-empty password (no strength rule).
      const res = (form.dataset.validate === 'login' && el.name === 'password')
        ? (el.value.length > 0 || 'Enter your password.') : rule(el.value, form);
      let fb = el.parentElement.querySelector('.invalid-feedback');
      if (!fb) { fb = document.createElement('div'); fb.className = 'invalid-feedback'; el.parentElement.appendChild(fb); }
      el.classList.toggle('is-invalid', res !== true);
      el.classList.toggle('is-valid', res === true);
      fb.textContent = res === true ? '' : res;
      return res === true;
    };
    form.addEventListener('submit', ev => {
      let ok = true;
      form.querySelectorAll('input[name]').forEach(el => { if (!check(el)) ok = false; });
      if (!ok) ev.preventDefault();
    });
    form.querySelectorAll('input[name]').forEach(el => el.addEventListener('blur', () => check(el)));
  });
});
