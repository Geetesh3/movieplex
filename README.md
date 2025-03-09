# MovieFlix - PHP Movie Streaming Website

A simple and modern movie streaming website built with PHP and MySQL.

## Features

- Movie streaming with multiple format support (MP4, M3U8, MKV, TS)
- Admin panel for movie management
- Featured movies section
- Responsive design
- Secure authentication

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)

## Installation

1. Clone or download this repository to your web server directory
2. Create a MySQL database and import `database.sql`
3. Configure database connection in `config/database.php`
4. Create an admin account in the database:
```sql
INSERT INTO admins (username, email, password) 
VALUES ('admin', 'admin@example.com', '$2y$10$YOUR_HASHED_PASSWORD');
```

## Project Structure

```
movieflix/
├── admin/              # Admin panel files
│   ├── css/
│   │   └── admin.css  # Admin styles
│   ├── index.php      # Admin dashboard
│   ├── login.php      # Admin login
│   └── logout.php     # Admin logout
├── config/
│   └── database.php   # Database configuration
├── css/
│   └── style.css      # Main website styles
├── database.sql       # Database structure
├── index.php          # Main website
└── README.md          # Documentation
```

## Usage

1. Access the website: `http://your-domain/`
2. Access admin panel: `http://your-domain/admin/login.php`
3. Login with admin credentials
4. Start adding movies with direct URLs

## Supported Video Formats

- MP4 (Direct video files)
- M3U8 (HLS streaming)
- MKV (Direct video files)
- TS (Transport Stream) 