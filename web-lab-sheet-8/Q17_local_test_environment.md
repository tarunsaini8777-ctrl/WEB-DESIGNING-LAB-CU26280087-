# Q17. Set up a local test environment to host and run the client website smoothly before presentation

## Option A – VS Code Live Server (easiest)
1. Install **Visual Studio Code**.
2. Install the extension **Live Server** (Ritwick Dey).
3. Open the project folder, right-click `index.html` → **Open with Live Server**.
4. The site opens at `http://127.0.0.1:5500` and reloads on every save.

## Option B – Python (no install if Python exists)
```bash
cd bakery/dist          # or the folder containing index.html
python -m http.server 8080
```
Open `http://localhost:8080`

## Option C – Node.js
```bash
cd bakery/dist
npx http-server -p 8080 -c-1
```
`-c-1` turns caching off so changes show immediately.

## Option D – XAMPP / Apache
1. Install XAMPP and start **Apache**.
2. Copy the project to `C:\xampp\htdocs\bakery`.
3. Open `http://localhost/bakery/`

## Test on your phone (same Wi-Fi)
1. Find your computer's IP: `ipconfig` (Windows) or `ifconfig` / `ip a` (Mac/Linux).
2. Start the server so it listens on all interfaces: `python -m http.server 8080 --bind 0.0.0.0`
3. On the phone open `http://<your-ip>:8080`.

## Pre-presentation checklist
- [ ] Server starts with one command
- [ ] All pages and links work (no 404 in DevTools → Network)
- [ ] No red errors in DevTools → Console
- [ ] Internet available for Google Maps and fonts
- [ ] Project also saved on a pen drive and pushed to GitHub (backup)
- [ ] Optional: publish free on GitHub Pages (Settings → Pages → Branch: main)
