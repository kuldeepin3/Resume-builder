# 📄 Resume Builder Pro

Resume Builder Pro is a modern, feature-rich web application designed to help job seekers draft, customize, and export professional, high-impact resumes in minutes. It features beautifully designed templates, a dynamic real-time live preview editor, and an integrated **Gemini AI Resume Editor** to polish bullet points into quantifiable accomplishments.

---

## ✨ Features

- **💡 Gemini AI Resume Assistant**: Turn basic bullet points and job descriptions into professional, action-oriented resume achievements instantly.
- **🎨 Stunning Premium Templates**: Choose between beautiful, professionally designed styles including *Elegant Timeline* and *Bold Creative*.
- **👁️ Real-Time Live Preview**: See modifications immediately as you type.
- **🔒 Secure Authentication System**: Full user registration and secure sign-in system with password hashing (`bcrypt`) and MySQL persistence.
- **📑 Multi-Entry Dynamic Fields**: Easily add, edit, or remove multiple education degrees, certifications, work experiences, projects, and achievements dynamically.
- **📥 Instant PDF Export**: High-fidelity PDF generation using `html2pdf.js` with clickable hyperlinks ready to send to employers.

---

## 🛠️ Tech Stack

- **Frontend**: HTML5, Vanilla CSS3 (Custom Glassmorphic design and gradients), Modern JavaScript (ES6+)
- **Backend**: PHP (Session management, validation, secure endpoints)
- **Database**: MySQL (MariaDB)
- **AI Integration**: Google Gemini API (integrated with exponential backoff handlers)
- **Libraries**: FontAwesome v7 (icons), `html2pdf.js` (PDF exports), Google Fonts (Poppins, Roboto, Merriweather)

---

## 🚀 Local Installation & Setup

### Prerequisites
- **XAMPP / WampServer** (with PHP 8.0+ and MySQL enabled)
- **Git**

### Step-by-Step Setup

1. **Clone the Repository**
   ```bash
   git clone https://github.com/kuldeepin3/Resume-builder.git
   cd Resume-builder
   ```

2. **Configure the Database**
   - Start Apache and MySQL in XAMPP.
   - Go to [phpMyAdmin](http://localhost/phpmyadmin) and create a database named `login`.
   - Create the `user` table using the following schema:
     ```sql
     CREATE TABLE `user` (
       `Id` int(11) NOT NULL AUTO_INCREMENT,
       `firstName` varchar(50) NOT NULL,
       `lastName` varchar(50) NOT NULL,
       `email` varchar(100) NOT NULL UNIQUE,
       `password` varchar(255) NOT NULL,
       PRIMARY KEY (`Id`)
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
     ```

3. **Verify Database Connection**
   Check `connect.php` to ensure MySQL connection details match your local server:
   ```php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "login";
   ```

4. **Run the Server**
   Run the built-in PHP development server inside the project root:
   ```bash
   php -S 127.0.0.1:8000
   ```

5. **Access the App**
   Open your browser and navigate to:
   👉 **[http://127.0.0.1:8000/home.html](http://127.0.0.1:8000/home.html)**

---

## 🔒 Security Features

- **Password Security**: All user passwords are encrypted using PHP's robust `password_hash` with `PASSWORD_DEFAULT` (bcrypt).
- **SQL Injection Prevention**: Inputs are safely sanitized using `mysqli_real_escape_string` before database querying.
- **Relatively Portable Routing**: All URLs and redirection targets use robust relative routing rather than hardcoded environment ports.
