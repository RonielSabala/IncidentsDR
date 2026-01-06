# IncidentsDR

A PHP web application that lets users report, manage, and visualize real-world incidents on an interactive map focused on the Dominican Republic. The system models the country’s administrative hierarchy (provinces → municipalities → neighborhoods/barrio), supports user authentication, geospatial queries, and email notifications.

---

## Table of Contents

* [Features](#features)
* [Requirements](#requirements)
* [Quick Installation](#quick-installation)
* [`.env` Configuration](#env-configuration)
* [Database Setup](#database-setup)
* [Run Locally](#run-locally)
* [External Authentication (Google / Microsoft)](#external-authentication-google--microsoft)
* [Email Notifications (optional)](#email-notifications-optional)
* [Troubleshooting](#troubleshooting)
* [Contributing](#contributing)
* [Authors](#authors)
* [License](#license)

---

## Features

* User registration and authentication (including Google and Microsoft sign-in).
* Report incidents with geolocation and view them on an interactive map.
* Basic incident management: create, edit, delete, and list incidents.
* Simple local deployment using the built-in PHP development server.

---

## Requirements

* PHP 7.4 or newer
* MySQL
* Composer

---

## Quick Installation

1. Clone the repository and move to the `src/` folder:

```bash
git clone <repo-url>
cd <repo-folder>
```

2. Install required packages (run from the `src/` directory):

```bash
composer require google/apiclient
composer require league/oauth2-client
composer require vlucas/phpdotenv
```

---

## `.env` Configuration

Create a `.env` file at `src/config/.env` with the variables below. Optional variables may be left empty but must exist.

### Database (required)

```env
HOST='YOUR_DB_HOST'
USER='YOUR_DB_USER'
PASS='YOUR_DB_PASSWORD'
```

### Email (optional)

```env
MAIL_USER='YOUR_GOOGLE_EMAIL'
MAIL_PASS='YOUR_APP_PASSWORD'
```

**How to get `MAIL_PASS` (Google App Password):**

1. Go to Google Account Security settings: [https://myaccount.google.com/security](https://myaccount.google.com/security)
2. Enable 2-Step Verification for the account you will use in `MAIL_USER`.
3. In "App passwords" generate a new app password and paste it into `MAIL_PASS`.

### Google OAuth (optional)

```env
GOOGLE_CLIENT_ID='YOUR_GOOGLE_CLIENT_ID'
GOOGLE_CLIENT_SECRET='YOUR_GOOGLE_CLIENT_SECRET'
```

**Suggested local Redirect URI:**

```
http://localhost:1111/auth/GoogleCallbackController.php
```

### Microsoft OAuth (optional)

```env
MICROSOFT_CLIENT_ID='YOUR_MICROSOFT_CLIENT_ID'
MICROSOFT_CLIENT_SECRET='YOUR_MICROSOFT_CLIENT_SECRET'
```

**Suggested local Redirect URI:**

```
http://localhost:1111/auth/MicrosoftCallbackController.php
```

---

## Database Setup

Run the installer script to create the required database tables:

```bash
php src/db/install.php
```

> Make sure your database credentials in `src/config/.env` are correct before running the installer.

---

## Run Locally

Start the PHP development server from the `src/` folder:

```bash
php -S localhost:1111 -t public
```

Open your browser at `http://localhost:1111`.

---

## External Authentication (Google / Microsoft)

### Google

1. Open Google Cloud Console: [https://console.cloud.google.com/](https://console.cloud.google.com/)
2. Go to **APIs & Services → Credentials** and create an **OAuth Client ID** (type: Web application).
3. Add the Redirect URI shown above and copy the `CLIENT_ID` and `CLIENT_SECRET` into your `.env` file.

### Microsoft (Azure)

1. Open the Azure Portal: [https://portal.azure.com/](https://portal.azure.com/)
2. Go to **Azure Active Directory → App registrations** and register a new application.
3. Add the Redirect URI shown above, copy the `Application (client) ID`, and create a client secret under **Certificates & secrets**. Paste these values into the `.env` file.

---

## Email Notifications (optional)

The app can send email notifications using a Gmail account and an app password. Ensure:

* `MAIL_USER` and `MAIL_PASS` are set in `src/config/.env`.
* Two-step verification is enabled on the Gmail account.

---

## Troubleshooting

* **Database connection error**: Verify `HOST`, `USER`, and `PASS` in `src/config/.env` and confirm the MySQL server is running.
* **OAuth redirect issues**: Ensure the Redirect URI in the OAuth provider settings matches exactly the one in your app.
* **Email not sent**: Confirm the app password (`MAIL_PASS`) is correct and there are no account restrictions.

---

## Contributing

Contributions are welcome. To contribute:

1. Fork the repository.
2. Create a feature branch: `feature/my-change`.
3. Open a pull request describing your changes.

---

## Authors

* Roniel Antonio Sabala Germán
* Jeremy Reyes González
* Abel Eduardo Martínez Robles

---

## License

This project is released under the **MIT License**.
