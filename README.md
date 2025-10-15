# photography-portfolio-cherished-shots-
A full-featured PHP/MySQL photography platform with admin panel. Features dynamic gallery, photographer profiles, contact system, and content management. Secure authentication, responsive design, and image upload capabilities.

### 🌐 Frontend
- Dynamic image gallery with search & sort
- Photographer profiles & portfolios  
- Contact & booking system
- Responsive design
- About Us section

### ⚙️ Admin Panel
- Gallery management (add/delete images)
- Photographer profile management
- Contact request handling
- Content management system
- Secure authentication

## 🚀 Quick Start

### Prerequisites
- PHP 7.4+
- MySQL 5.7+
- Web server (Apache/Nginx)

### Installation
1. Clone the repository:
```bash
git clone https://github.com/yourusername/cherished-shots.git
Import database:

### SQL
CREATE DATABASE cherished_shots;
-- Import provided SQL file
Configure database connection in PHP files:

php
$db_host = 'localhost';
$db_username = 'root'; 
$db_password = '';
$db_name = 'cherished_shots';
Set up web server to point to project directory

🗄️ Database Schema
1. users - Admin accounts
2. gallery - Image metadata
3. photographers - Photographer profiles
4. contact_requests - Customer inquiries
5. about_us - Company info

🔐 Security
Prepared statements
Session authentication
Input validation
Secure file uploads

👥 Usage
Visitors: Browse gallery, view profiles, submit inquiries
Admins: Login at /admin_panel.php to manage content

🤝 Contributing
Contributions welcome! Please feel free to submit pull requests.
