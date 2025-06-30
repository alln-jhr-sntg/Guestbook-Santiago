# Allen Jheru Santiago (22013022410)- PHP Guestbook

A PHP-based guestbook web application powered by **MySQL** and running on **XAMPP**. This system allows users to post, edit, and delete entries stored securely in a database. The project demonstrates core PHP + MySQL development using modular includes and CRUD operations.

## 🚀 What's New in This Version

- ✨ **Database Integration**:
  - Switched from text file storage to **MySQL database**.
  - Guest entries are now securely stored and retrieved using SQL queries.

- ✨ **New Features**:
  - `edit.php`: Users can now **edit** guestbook entries directly from the interface.
  - `delete.php`: Users can **delete** entries with confirmation.
  - `nav.php`: Modular navigation bar added for a cleaner UI.
  - `config.php`: Centralized database configuration for scalability.

- 🔧 **Improvements**:
  - Improved layout and organization in `index.php`.
  - Updated styles in `css/style.css`.
  - Modular includes for cleaner, reusable code (`header.php`, `footer.php`, `functions.php`).

## 🛠 Technologies Used

- PHP
- HTML5 / CSS3
- JavaScript (for dark mode)
- No database – entries stored in a `.txt` file

## 🚀 How to Run

1. Place the project folder inside your local server directory:
   - For XAMPP: `htdocs/guestbook`
2. Import the SQL structure into phpMyAdmin or your MySQL client.
3. Set your database credentials in config.php.
4. Start Apache and MySQL using XAMPP Control Panel.
5. Open your browser and go to http://localhost/Guestbook-Santiago/index.php

## 💾 Data Storage (MySQL)

Guestbook entries are stored in a **MySQL database**. 

## 📷 Screenshots

Will be available in the future.

## 🧠 Notes

- This is a file-based project, not suitable for production as-is.
- No sanitization or CAPTCHA added yet – it’s best used as a learning tool.
- This project is now fully backed by MySQL, offering better scalability and security.
- You can extend this system by adding:
  - Input validation
  - User login system
  - Admin panel for managing entries
  - Pagination and filtering

## 📜 License

This project is for educational purposes and free to use or modify.
