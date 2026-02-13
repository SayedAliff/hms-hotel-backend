# HMS Hotel Backend

A Laravel 12 backend API for Hotel Management System (HMS).

## 🏨 Project Description

This is the backend API service for HMS (Hotel Management System), providing RESTful APIs for hotel operations including room management, customer management, reservations, payments, and restaurant billing.

## 🛠️ Tech Stack

- **Framework**: Laravel 12
- **Database**: MySQL
- **PHP**: 8.2+
- **Authentication**: Laravel Sanctum (planned)
- **API Documentation**: OpenAPI/Swagger (planned)

## 🔗 Related Repositories

- **Frontend**: [https://github.com/TareqJamilSarkar/HMS](https://github.com/TareqJamilSarkar/HMS)
- **Backend**: [https://github.com/SayedAliff/hms-hotel-backend](https://github.com/SayedAliff/hms-hotel-backend)

## 🚀 Local Setup

### Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL 8.0+
- Node.js (for asset compilation)

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/SayedAliff/hms-hotel-backend.git
   cd hms-hotel-backend
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure MySQL database**
   
   Update your `.env` file with your MySQL credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=hotel_app
   DB_USERNAME=your_mysql_user
   DB_PASSWORD=your_mysql_password
   ```

   > **Note**: The `.env` file is local to your machine and not committed to version control.

6. **Database setup (Optional)**
   
   If you have the `hotel_app.sql` dump file, you can import it:
   ```bash
   # Create the database
   mysql -u your_username -p -e "CREATE DATABASE hotel_app;"
   
   # Import the SQL dump
   mysql -u your_username -p hotel_app < hotel_app.sql
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

   The API will be available at: `http://localhost:8000`

## 📡 API Endpoints

### Base URL
- **Development**: `http://localhost:8000/api`
- **Production**: TBD

### ✅ Active Endpoints

#### Health Check
| Method | Endpoint | Description | Status |
|--------|----------|-------------|--------|
| GET | `/health` | Health check (alias) | ✅ Active |
| GET | `/v1/system/health` | Health check (canonical) | ✅ Active |

#### Room Status (for frontend dashboard)
| Method | Endpoint | Description | Status |
|--------|----------|-------------|--------|
| GET | `/room-statuses?date=YYYY-MM-DD` | Get computed room statuses | ✅ Active |
| GET | `/v1/room-statuses?date=YYYY-MM-DD` | Get computed room statuses (canonical) | ✅ Active |
| POST | `/room-statuses` | Update room status | ✅ Active |
| POST | `/v1/room-statuses` | Update room status (canonical) | ✅ Active |

#### Room Types
| Method | Endpoint | Description | Status |
|--------|----------|-------------|--------|
| GET | `/types` | Get all room types (paginated) | ✅ Active |
| GET | `/v1/types` | Get all room types (canonical) | ✅ Active |

#### Rooms
| Method | Endpoint | Description | Status |
|--------|----------|-------------|--------|
| GET | `/rooms` | Get all rooms (paginated, filterable) | ✅ Active |
| GET | `/v1/rooms` | Get all rooms (canonical) | ✅ Active |
| GET | `/rooms/{id}` | Get room details with relations | ✅ Active |
| GET | `/v1/rooms/{id}` | Get room details (canonical) | ✅ Active |

### 🔜 Planned Endpoints (return 501)

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/v1/customers` | Get all customers |
| GET | `/v1/transactions` | Get all transactions |
| GET | `/v1/payments` | Get all payments |
| GET | `/v1/restaurant-bills` | Get all restaurant bills |

## 🧪 Smoke Test (Quick Verification)

### Step 1: Verify routes are registered
```bash
php artisan route:list --path=api
```
You should see **26 routes** including:
- `api/health` → `HealthController@health`
- `api/v1/system/health` → `HealthController@health`
- `api/room-statuses` (GET) → `Api\RoomStatusApiController@index`
- `api/room-statuses` (POST) → `Api\RoomStatusApiController@update`
- `api/types` → `Api\TypeController@index`
- `api/rooms` → `Api\RoomController@index`
- `api/rooms/{id}` → `Api\RoomController@show`
- All of the above also under `api/v1/...`

### Step 2: Start server & test endpoints
```bash
php artisan serve
```

Then in another terminal:
```bash
# Health check (no DB needed)
curl -s http://localhost:8000/api/health | jq
# Expected: {"success":true,"message":"OK","data":{"status":"ok","service":"hms-hotel-backend"}}

# Room statuses (requires DB + hotel_app imported)
curl -s http://localhost:8000/api/room-statuses | jq
# Expected: {"success":true,"message":"OK","data":{"date":"...","statuses":{"1":"booked|normal_checkout",...}}}

# Room statuses with date filter
curl -s "http://localhost:8000/api/room-statuses?date=2026-02-13" | jq

# Update room status
curl -s -X POST http://localhost:8000/api/room-statuses \
  -H "Content-Type: application/json" \
  -d '{"room_id": 1, "status_key": "booked"}' | jq

# Types
curl -s http://localhost:8000/api/types | jq

# Rooms (paginated + filterable)
curl -s http://localhost:8000/api/rooms | jq
curl -s "http://localhost:8000/api/rooms?type_id=1" | jq
curl -s "http://localhost:8000/api/rooms?search=101" | jq

# Single room with relations
curl -s http://localhost:8000/api/rooms/1 | jq
```

### Troubleshooting
| Problem | Cause | Fix |
|---------|-------|-----|
| `Connection refused` | MySQL not running | Start XAMPP MySQL |
| `SQLSTATE[HY000] [1049] Unknown database` | DB not created | `mysql -u root -e "CREATE DATABASE hotel_app;"` then import SQL |
| `SQLSTATE[42S02] Base table not found` | Tables missing | Import: `mysql -u root hotel_app < hotel_app.sql` |
| `404 Not Found` on `/api/...` | API routes not loaded | Check `bootstrap/app.php` has `api:` line |
| Empty `statuses: {}` | No rooms in DB | Import `hotel_app.sql` |

## 🗄️ Database Schema

The database schema is based on an existing phpMyAdmin dump (`hotel_app.sql`) that includes the following tables:

- `users` - System users and staff
- `customers` - Hotel customers
- `types` - Room types (single, double, suite, etc.)
- `room_statuses` - Room status (available, occupied, maintenance, etc.)
- `rooms` - Hotel rooms
- `facilities` - Hotel facilities (WiFi, AC, etc.)
- `facility_room` - Many-to-many relationship between facilities and rooms
- `images` - Room and facility images
- `transactions` - Booking transactions
- `payments` - Payment records
- `restaurant_bills` - Restaurant billing
- `activity_log` - System activity logs
- `notifications` - User notifications

## 📋 Day 1 Progress (2-day deadline)

### ✅ Completed
- [x] Laravel 12 project setup in repository root
- [x] MySQL connection configuration in `.env.example`
- [x] JSON response helpers (`success()` / `error()`) in base Controller
- [x] Health endpoint (`/api/health`, `/api/v1/system/health`)
- [x] Room status API for frontend dashboard:
  - [x] `GET /api/room-statuses?date=...` - returns computed statuses
  - [x] `POST /api/room-statuses` - updates room status
- [x] Types API (`GET /api/types`)
- [x] Rooms API (`GET /api/rooms`, `GET /api/rooms/{id}`)
- [x] Eloquent models: Type, RoomStatus, Room, Image, Facility
- [x] Frontend compatibility aliases (non-versioned `/api/...` paths)
- [x] Fixed route groups (no more nesting issues)

### 🔜 Day 2 Tasks
- [ ] Implement Customers API
- [ ] Implement Transactions API
- [ ] Implement Payments API
- [ ] Implement Restaurant Bills API
- [ ] Add authentication with Laravel Sanctum
- [ ] Add validation request classes
- [ ] Unit and feature tests

## 🎯 Response Format

All API responses use a consistent JSON format:

### Success Response
```json
{
  "success": true,
  "message": "OK",
  "data": { ... }
}
```

### Error Response
```json
{
  "success": false,
  "message": "Error description",
  "errors": { ... }
}
```

---

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is proprietary software for HMS Hotel Management System.

---

**For frontend developers**: The following endpoints are ready for integration:
- `GET /api/health` - Health check
- `GET /api/room-statuses?date=YYYY-MM-DD` - Room statuses for dashboard
- `POST /api/room-statuses` - Update room status (`{room_id, status_key}`)
- `GET /api/types` - Room types
- `GET /api/rooms` - All rooms (with filters)
- `GET /api/rooms/{id}` - Single room details
