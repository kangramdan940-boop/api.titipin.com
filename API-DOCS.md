# API Documentation — api.titipin.com

## Base URL

- **Dev:** `http://localhost:8001/api`
- **Prod:** `https://api.titipin.com/api`

## Auth

Token-based (Laravel Sanctum). Include in header: `Authorization: Bearer {token}`

---

## Endpoints

### Auth (Public)

| Method | Endpoint | Body | Response |
|--------|----------|------|----------|
| POST | `/auth/send-otp` | `{identifier, type: "whatsapp"|"email"}` | `{message, expires_in, code?}` |
| POST | `/auth/verify-otp` | `{identifier, type, code}` | `{token, user}` |
| POST | `/auth/register` | `{name, phone, email}` | `{user, code?}` |
| POST | `/auth/logout` 🔒 | — | `{message}` |

### Products (Public)

| Method | Endpoint | Params | Response |
|--------|----------|--------|----------|
| GET | `/products` | `?category=&event=&search=&per_page=` | Paginated products |
| GET | `/products/{slug}` | — | Single product |

### Categories (Public)

| Method | Endpoint | Response |
|--------|----------|----------|
| GET | `/categories` | Array of categories with product count |

### Events (Public)

| Method | Endpoint | Response |
|--------|----------|----------|
| GET | `/events` | Array of events (sorted: active first) |
| GET | `/events/{slug}` | Event with products |

### Cart 🔒

| Method | Endpoint | Body | Response |
|--------|----------|------|----------|
| GET | `/cart` | — | User's cart items |
| POST | `/cart` | `{product_id, quantity?, notes?}` | Created cart item |
| PUT | `/cart/{id}` | `{quantity}` | Updated cart item |
| DELETE | `/cart/{id}` | — | `{message}` |

### Orders 🔒

| Method | Endpoint | Body/Params | Response |
|--------|----------|-------------|----------|
| GET | `/orders` | `?status=` | Paginated user orders |
| GET | `/orders/{id}` | — | Order detail with items |
| POST | `/orders` | `{address_id?, notes?}` | Created order (clears cart) |

### User 🔒

| Method | Endpoint | Body | Response |
|--------|----------|------|----------|
| GET | `/user/profile` | — | User with addresses |
| PUT | `/user/profile` | `{name?, email?}` | Updated user |
| GET | `/user/addresses` | — | User's addresses |
| POST | `/user/addresses` | `{label, name, phone, address, city, province, postal_code, is_default?}` | Created address |

---

## Quick Start

```bash
cd /Applications/XAMPP/xamppfiles/htdocs/api.titipin.com

# Run server
php artisan serve --port=8001

# Fresh database + seed
php artisan migrate:fresh --seed

# Test
curl http://localhost:8001/api/products
curl http://localhost:8001/api/categories
curl http://localhost:8001/api/events
```

## Example: Full Auth Flow

```bash
# 1. Send OTP
curl -X POST http://localhost:8001/api/auth/send-otp \
  -H "Content-Type: application/json" \
  -d '{"identifier":"081234567890","type":"whatsapp"}'
# Response: {"message":"OTP sent","code":"123456"}

# 2. Verify OTP → get token
curl -X POST http://localhost:8001/api/auth/verify-otp \
  -H "Content-Type: application/json" \
  -d '{"identifier":"081234567890","type":"whatsapp","code":"123456"}'
# Response: {"token":"1|abc...","user":{...}}

# 3. Use token for authenticated requests
curl http://localhost:8001/api/cart \
  -H "Authorization: Bearer 1|abc..."
```

## Database

SQLite (default, file: `database/database.sqlite`)

To switch to MySQL, edit `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=titipin
DB_USERNAME=root
DB_PASSWORD=
```

## Fee Calculation Logic

```
price < 500k     → flat Rp 50.000
500k - 2M        → 10%
2M - 10M         → 7%
> 10M            → 5%
```
