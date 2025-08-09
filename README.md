# Login System with MySQL and XAMPP

This is a complete PHP login system with MySQL database connection using XAMPP.

## Files Structure:
- `index.php` - Login page
- `register.php` - Registration page
- `dashboard.php` - User dashboard (after login)
- `login.php` - Login processing script
- `register_process.php` - Registration processing script
- `logout.php` - Logout script
- `config.php` - Database configuration
- `setup.php` - Database setup script
- `README.md` - This file

## Setup Instructions:

### 1. Start XAMPP Services
- Open XAMPP Control Panel
- Start **Apache** service
- Start **MySQL** service

### 2. Place Files in XAMPP Directory
- Copy all files to `C:\xampp\htdocs\login-by-sql\`
- Or create a new folder in htdocs with your preferred name

### 3. Setup Database
- Open your browser
- Go to `http://localhost/login-by-sql/setup.php`
- This will create the database and users table automatically
- A test user will be created:
  - Username: `testuser`
  - Password: `testpass`

### 4. Access the Application
- Go to `http://localhost/login-by-sql/`
- You can login with the test user or register a new account

## Features:
- ✅ User registration with validation
- ✅ Secure password hashing
- ✅ User login with session management
- ✅ Dashboard for logged-in users
- ✅ Logout functionality
- ✅ Error and success message display
- ✅ Responsive design
- ✅ SQL injection protection using prepared statements

## Database Configuration:
- Server: localhost
- Username: root
- Password: (empty - default XAMPP)
- Database: login_system
- Table: users

## Security Features:
- Password hashing using PHP's `password_hash()`
- SQL injection protection with prepared statements
- Input validation and sanitization
- Session management for user authentication

## Test the System:
1. Register a new user account
2. Login with your credentials
3. Access the dashboard
4. Logout when done

Enjoy your secure login system!
