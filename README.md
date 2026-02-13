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

### System Endpoints
| Method | Endpoint | Description | Status |
|--------|----------|-------------|--------|
| GET | `/v1/system/health` | Health check | ✅ Active |

### Planned API Endpoints

> **Note**: The following endpoints are planned but not yet implemented. They will return `501 Not Implemented`.

#### Room Management
| Method | Endpoint | Description | Status |
|--------|----------|-------------|--------|
| GET | `/v1/types` | Get room types | 🔜 Planned |
| POST | `/v1/types` | Create room type | 🔜 Planned |
| GET | `/v1/types/{id}` | Get room type details | 🔜 Planned |
| PUT | `/v1/types/{id}` | Update room type | 🔜 Planned |
| DELETE | `/v1/types/{id}` | Delete room type | 🔜 Planned |

#### Room Status Management
| Method | Endpoint | Description | Status |
|--------|----------|-------------|--------|
| GET | `/v1/room-statuses` | Get room statuses | 🔜 Planned |
| POST | `/v1/room-statuses` | Create room status | 🔜 Planned |
| GET | `/v1/room-statuses/{id}` | Get room status details | 🔜 Planned |
| PUT | `/v1/room-statuses/{id}` | Update room status | 🔜 Planned |
| DELETE | `/v1/room-statuses/{id}` | Delete room status | 🔜 Planned |

#### Rooms Management
| Method | Endpoint | Description | Status |
|--------|----------|-------------|--------|
| GET | `/v1/rooms` | Get all rooms | 🔜 Planned |
| POST | `/v1/rooms` | Create new room | 🔜 Planned |
| GET | `/v1/rooms/{id}` | Get room details | 🔜 Planned |
| PUT | `/v1/rooms/{id}` | Update room | 🔜 Planned |
| DELETE | `/v1/rooms/{id}` | Delete room | 🔜 Planned |

#### Customer Management
| Method | Endpoint | Description | Status |
|--------|----------|-------------|--------|
| GET | `/v1/customers` | Get all customers | 🔜 Planned |
| POST | `/v1/customers` | Create new customer | 🔜 Planned |
| GET | `/v1/customers/{id}` | Get customer details | 🔜 Planned |
| PUT | `/v1/customers/{id}` | Update customer | 🔜 Planned |
| DELETE | `/v1/customers/{id}` | Delete customer | 🔜 Planned |

#### Transaction Management
| Method | Endpoint | Description | Status |
|--------|----------|-------------|--------|
| GET | `/v1/transactions` | Get all transactions | 🔜 Planned |
| POST | `/v1/transactions` | Create new transaction | 🔜 Planned |
| GET | `/v1/transactions/{id}` | Get transaction details | 🔜 Planned |
| PUT | `/v1/transactions/{id}` | Update transaction | 🔜 Planned |
| DELETE | `/v1/transactions/{id}` | Delete transaction | 🔜 Planned |

#### Payment Management
| Method | Endpoint | Description | Status |
|--------|----------|-------------|--------|
| GET | `/v1/payments` | Get all payments | 🔜 Planned |
| POST | `/v1/payments` | Process payment | 🔜 Planned |
| GET | `/v1/payments/{id}` | Get payment details | 🔜 Planned |
| PUT | `/v1/payments/{id}` | Update payment | 🔜 Planned |
| DELETE | `/v1/payments/{id}` | Delete payment | 🔜 Planned |

#### Restaurant Billing
| Method | Endpoint | Description | Status |
|--------|----------|-------------|--------|
| GET | `/v1/restaurant-bills` | Get all restaurant bills | 🔜 Planned |
| POST | `/v1/restaurant-bills` | Create new bill | 🔜 Planned |
| GET | `/v1/restaurant-bills/{id}` | Get bill details | 🔜 Planned |
| PUT | `/v1/restaurant-bills/{id}` | Update bill | 🔜 Planned |
| DELETE | `/v1/restaurant-bills/{id}` | Delete bill | 🔜 Planned |

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

## 📋 Status / Changelog

### ✅ Completed
- [x] Laravel 12 project setup in repository root
- [x] MySQL connection configuration in `.env.example`
- [x] Basic API health endpoint (`/api/v1/system/health`)
- [x] Initial API route structure with route groups
- [x] Placeholder routes for all planned modules
- [x] Project documentation and setup instructions

### 🔜 Next Steps
- [ ] Create Eloquent models for database tables
- [ ] Implement authentication using Laravel Sanctum
- [ ] Create controllers for each API module
- [ ] Add API validation and request classes
- [ ] Implement proper error handling and responses
- [ ] Add API documentation with Swagger/OpenAPI
- [ ] Unit and feature tests
- [ ] Database seeders for testing

### 🎯 Upcoming Features
- [ ] Room availability checking
- [ ] Reservation system
- [ ] Payment integration
- [ ] Email notifications
- [ ] Activity logging
- [ ] Dashboard analytics APIs
- [ ] File upload for images
- [ ] Real-time availability updates

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

**For frontend developers**: Please refer to the API endpoints section above for integration. The health endpoint is ready for testing. All other endpoints will return `501 Not Implemented` until the corresponding controllers are implemented.

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
