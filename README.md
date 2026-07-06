# SP_AA – Secure Programming Assignment

## Course

**SECR4483 / SCSR4483 – Secure Programming**

## Project Overview

This project is a secure refactoring of the vulnerable **MediChain E-MedicVault** case study. The original source code contained multiple security vulnerabilities, including:

* SQL Injection
* Cross-Site Scripting (XSS)
* Weak password hashing (MD5)
* Improper input validation
* Insecure AES-128-ECB encryption with a hardcoded key

The project demonstrates secure coding practices by implementing:

* PDO Prepared Statements
* `htmlspecialchars()` output encoding
* Argon2id password hashing
* AES-256-GCM authenticated encryption
* PHPUnit automated testing

---

## Project Structure

```text
SP_AA/
│
├── src/                # Secure source code
├── tests/              # PHPUnit test cases
├── GUI_test/           # Simple web interface (localhost)
├── vendor/             # Composer dependencies
├── composer.json
├── phpunit.xml
├── schema.sql
└── README.md
```

---

## Requirements

* PHP 8.2 or above
* Composer
* XAMPP (Apache & MySQL)
* PHPUnit

---

## Installation

Install project dependencies:

```bash
composer install
```

Generate Composer autoload files:

```bash
composer dump-autoload
```

---

## Running the Web Interface

1. Start **Apache** and **MySQL** in XAMPP.
2. Import `schema.sql` into MySQL.
3. Configure the database connection in `db_config.php` if necessary.
4. Open the application in your browser:

```text
http://localhost/SP_AA/GUI_test/
```

The GUI provides:

* Patient search demonstration
* Authentication demonstration

---

## Running PHPUnit Tests

Execute the automated test suite:

```bash
vendor\bin\phpunit
```

Example successful output:

```text
OK (8 tests, 9 assertions)
```

---

## Security Improvements

| Legacy Implementation | Secure Implementation           |
| --------------------- | ------------------------------- |
| Raw SQL Concatenation | PDO Prepared Statements         |
| Reflected XSS         | `htmlspecialchars()`            |
| MD5 Password Hash     | Argon2id                        |
| AES-128-ECB           | AES-256-GCM                     |
| Hardcoded Key         | Environment-based configuration |
| Weak Validation       | `mb_strlen()` UTF-8 validation  |

---

## Author

**Muhammad Abduh Bin Abdul Ba'ari**
Matric No.: **A22EC0199**

Universiti Teknologi Malaysia (UTM)
