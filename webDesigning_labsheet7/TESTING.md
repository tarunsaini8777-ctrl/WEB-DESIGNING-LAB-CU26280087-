# Task 20 – End-to-end test plan (browsing → order confirmation)

Setup: import `database.sql`, edit DB credentials in `config.php`, serve the folder
(`php -S localhost:8000` from the project folder, or copy to `htdocs/bookstore`).
Admin login: `admin@bookstore.test` / `Admin@123` (change after first login).

| # | Step | Expected result | Pass? |
|---|------|-----------------|-------|
| 1 | Open `/index.php` | Hero, promo strip, featured books, category pills, grid of 8 books, pagination | |
| 2 | Click page “2” | Next 8 books shown; page link highlighted | |
| 3 | Search “php” | Only “Learn PHP the Practical Way” listed | |
| 4 | Search by author “Lila” / click category “Science” | Matching books only; filter + search combine | |
| 5 | Open a book | Detail page loads via `book.php?id=N`; `?id=9999` gives “not found” | |
| 6 | Click **Add** while logged out | Item added to session cart; badge count rises | |
| 7 | Try adding more than stock (e.g. 30 copies of a 25-stock book) | Warning “Only 25 copies available”; cart not over stock | |
| 8 | Out-of-stock book (“Letters from the Deep”) | Shows *Out of stock*, no add button | |
| 9 | Cart: change quantity, remove an item | Totals recalculate; qty capped at stock | |
| 10 | Checkout while logged out | Redirected to login, returns to checkout after login | |
| 11 | Register with weak password / mismatched passwords | JS inline errors; PHP also rejects if JS disabled | |
| 12 | Register valid user, log in | “Welcome back”; navbar shows name; password stored hashed in DB | |
| 13 | Checkout with empty/invalid fields | Client and server validation messages | |
| 14 | Checkout with valid details | Order created, stock reduced, cart cleared, redirected to invoice | |
| 15 | Invoice page | Shows items, total, shipping, status “Pending”; other users get “not found” | |
| 16 | My Orders | New order listed with status | |
| 17 | Add review (5★ + comment) on a book | Shows on page with average rating; re-submitting updates it | |
| 18 | Wishlist toggle | Appears in `/wishlist.php`; can add to cart / remove | |
| 19 | Admin: add book, change price & stock | Visible on storefront immediately | |
| 20 | Admin: Orders → set to Shipped / Delivered | Customer’s order history shows new status | |
| 21 | Admin: Sales reports | Revenue, order count, top books, status breakdown match orders | |
| 22 | SQL injection: search `' OR 1=1 --` / `book.php?id=1 OR 1=1` | No error, no extra rows (prepared statements) | |
| 23 | XSS: review comment `<script>alert(1)</script>` | Displayed as text, not executed | |
| 24 | Visit `/admin/` as customer | Redirected to login with “Admin access only” | |
