# IncidentsDR

IncidentsDR is a PHP web application that lets users report, manage, and visualize real-world incidents in the Dominican Republic on an interactive map.

---

## Table of Contents

* [Features](#features)
* [Requirements](#requirements)
* [Quick Start](#quick-start)
  * [Clone the repository](#clone-the-repository)
  * [Install dependencies](#install-dependencies)
  * [`.env` configuration](#env-configuration)
  * [Database setup](#database-setup)
  * [Run locally](#run-locally)
* [Email notifications](#email-notifications)
* [Roles & Permissions](#roles--permissions)
* [Test accounts](#test-accounts)
* [Troubleshooting](#troubleshooting)
* [Contributing](#contributing)
* [Authors](#authors)
* [License](#license)

---

## Features

* User registration and authentication (Google / Microsoft).
* Map and list views showing incidents with label icons.
* Search and filters.
* Click-to-open incident modal with full details.
* Role-based dashboards for reporters, validators, and administrators.
* Administrative topology modeling (province → municipality → neighborhood).
* Simple local deployment using PHP's built-in development server.

---

## Requirements

* PHP 8.0 or newer
* Composer
* MySQL

---

## Quick Start

### Clone the repository

```bash
git clone <repo-url>
cd <repo-folder>
```

### Install dependencies

Use system terminal (recommended):

```bash
cd src
composer require google/apiclient league/oauth2-client vlucas/phpdotenv phpmailer/phpmailer
```

---

## `.env` configuration

Create a `.env` file at `src/config/.env`, include all keys shown below. Optional values may be left empty, but the keys should exist.

```env
# Database (required)
HOST='YOUR_DB_HOST'
USER='YOUR_DB_USER'
PASS='YOUR_DB_PASSWORD'

# Email (optional)
MAIL_USER='YOUR_GOOGLE_EMAIL'
MAIL_PASS='YOUR_APP_PASSWORD'

# Google OAuth (optional)
GOOGLE_CLIENT_ID='YOUR_GOOGLE_CLIENT_ID'
GOOGLE_CLIENT_SECRET='YOUR_GOOGLE_CLIENT_SECRET'

# Microsoft OAuth (optional)
MICROSOFT_CLIENT_ID='YOUR_MICROSOFT_CLIENT_ID'
MICROSOFT_CLIENT_SECRET='YOUR_MICROSOFT_CLIENT_SECRET'
```

### How to obtain credentials

**Email (app password):**

1. Enable 2-Step Verification for `MAIL_USER` at [https://myaccount.google.com/security](https://myaccount.google.com/security).
2. Generate an App Password at [https://myaccount.google.com/apppasswords](https://myaccount.google.com/apppasswords) and paste it into `MAIL_PASS`.

**Google OAuth:**

1. Create or select a project in [Google Cloud Console](https://console.cloud.google.com/).
2. Go to **APIs & Services** > **Credentials** and create **OAuth client ID**.
3. Choose **Web application** as the Application type and add the authorized redirect URI:

    ```md
    http://localhost:1111/auth/GoogleController.php
    ```

4. Copy **Client ID** and **Client secret** into `.env`.

**Microsoft OAuth:**

1. Register an app in [Azure Portal](https://portal.azure.com/) > **Microsoft Entra ID** > **App registrations**.
2. Add an authorized redirect URI:

    ```md
    http://localhost:1111/auth/MicrosoftCallbackController.php
    ```

3. Copy **Application (client) ID**, create a client secret under **Certificates & secrets** and paste into `.env`.

---

## Database setup

From the `src` directory, run the DB install script:

```bash
php db/install.php
```

> This script will create required tables and sample data.

---

## Run locally

Start the built-in PHP server from the `src` directory:

```bash
php -S localhost:1111 -t public
```

Open your browser at: `http://localhost:1111`

---

## Email notifications

* Password reset uses an email verification code flow.
* Ensure `MAIL_USER` and `MAIL_PASS` are set in `.env` for email functionality.

---

## Roles & Permissions

Four main roles exist in the system:

### `default`

* Access main lobby, Map and List pages.
* Open incident detail modal.
* Comment on incidents.
* Suggest corrections for incidents.

### `reporter`

* All `default` permissions.
* Reporter dashboard after login.
* Create incidents and edit/delete their **unapproved** incidents.
* View a list of their reported incidents.

### `validator`

* All `default` permissions.
* Validator dashboard after login.
* Review and approve/reject unapproved incidents and corrections.

### `admin`

* Full access to the system.
* Admin dashboard after login.
* Assign roles, manage labels, provinces, municipalities, neighborhoods.
* Manage all incidents and user accounts.

---

## Test accounts

Four sample users are included for testing. Password for all sample accounts: **`123DR`**

* [carloslopez@email.com](mailto:carloslopez@email.com) (`default`)
* [reporter1@gmail.com](mailto:reporter1@gmail.com) (`reporter`)
* [validator1@gmail.com](mailto:validator1@gmail.com) (`validator`)
* [admin1@gmail.com](mailto:admin1@gmail.com) (`admin`)

---

## Troubleshooting

* **Database connection error:** Verify `HOST`, `USER`, `PASS` in `src/config/.env` and ensure MySQL is running and accepting connections.
* **SQL script errors:** Confirm the DB user has the required privileges to create tables and insert data.
* **OAuth redirect issues:** Confirm redirect URIs in the provider console match exactly.
* **Emails not sent:** Verify that `MAIL_USER` and `MAIL_PASS` are correct and that the account's security settings allow SMTP or app-password usage.
* **Composer problems in VS Code terminal:** Use the system terminal (`cmd.exe`, Terminal.app, or your preferred shell).

---

## Contributing

Contributions are welcome. Suggested workflow:

1. Fork the repository.
2. Create a feature branch: `feature/my-change`.
3. Commit, push, and open a pull request describing the change and reason.

---

## Authors

* Roniel Antonio Sabala Germán
* Jeremy Reyes González
* Abel Eduardo Martínez Robles

---

## License

This project is available under the **MIT License**.
