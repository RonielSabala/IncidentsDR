# IncidentsDR

IncidentsDR is a web application built with PHP that lets users report, manage, and visualize real-world incidents of the Dominican Republic (DR) on an interactive map.

---

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Quick Installation](#quick-installation)
- [`.env` Configuration](#env-configuration)
- [Database Setup](#database-setup)
- [Run Locally](#run-locally)
- [Email Notifications](#email-notifications)
- [Roles & Permissions](#roles--permissions)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [Authors](#authors)
- [License](#license)

---

## Features

- User registration and authentication with **Google**/**Microsoft**.
- **Map**/**List** view with incidents displayed as icons based on their label name.
- **Search bar** that filters results in both the Map and the List views.
- **Last 24h** filter button to display incidents reported within the current day.
- **Incident modal**: clicking an incident opens a modal with the incident data.
- **Role-based dashboards** and views for reporters, validators, and administrators.
- Models the administrative hierarchy of the DR (province → municipality → neighborhood).
- Simple local deployment using the built-in PHP development server.

---

## Requirements

- MySQL
- PHP 8 or newer
- Composer

---

## Quick Installation

1. Clone the repository:

    ```bash
    git clone <repo-url>
    cd <repo-folder>
    ```

2. Install required packages:

    ```bash
    cd src
    composer require google/apiclient league/oauth2-client vlucas/phpdotenv phpmailer/phpmailer
    ```

---

## `.env` Configuration

Add a `.env` file at `src/config/` with the variables below. Optional variables may be left empty but the keys should exist.

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
GOOGLE_CLIENT_SECRET='YOUR_GOOGLE_CLIENT_SECRET

# Microsoft OAuth (optional)
MICROSOFT_CLIENT_ID='YOUR_MICROSOFT_CLIENT_ID'
MICROSOFT_CLIENT_SECRET='YOUR_MICROSOFT_CLIENT_SECRET'
```

### How to get credentials

#### **Email**

1. Go to [Google Account Security settings](https://myaccount.google.com/security) and enable 2-Step Verification on the Google account you will use for `MAIL_USER`.
2. Go to [App Passwords](https://myaccount.google.com/apppasswords), generate an app password and paste it into `MAIL_PASS`.

#### **Google OAuth**

1. Go to [Google Cloud Console](https://console.cloud.google.com/) and create/select a project.
2. Go to **APIs & Services** > **Credentials** and create an **OAuth client ID**.
3. Choose **Web application** as the Application type and add the authorized redirect URI:

    ```md
    http://localhost:1111/auth/GoogleController.php
    ```

4. Paste `Client ID` & `Client secret` into the `.env` file.

#### **Microsoft OAuth**

1. Go to [Azure Portal](https://portal.azure.com/) > **Microsoft Entra ID** > **App registrations** and register a new application.
2. Add the authorized redirect URI:

    ```md
    http://localhost:1111/auth/MicrosoftCallbackController.php
    ```

3. Copy the `Application (client) ID` and create a client secret under **Certificates & secrets**.
4. Paste these values into the `.env` file.

---

## Database Setup

Run the installer script to create the required database tables:

```bash
# From src/
php db/install.php
```

---

## Run Locally

Start the PHP development server:

```bash
# From src/
php -S localhost:1111 -t public
```

Open your browser at:
`http://localhost:1111`

---

## Email Notifications

Users can reset their password via **email verification code**:

- A reset request sends a code to the registered email.
- The user enters the code to set a new password.

> Requires email variables in `.env`.

---

## Roles & Permissions

The system defines four roles, each with its own views and permissions:

### `default`

- Access to the main lobby.
- Can view the Map and List pages.
- Can open incident detail modals.
- Can comment on incidents.

### `reporter`

- All `default` permissions.
- Redirected after login to a Reporter dashboard.
- Can create incidents.
- Can edit and delete **only their own unapproved incidents**.
- Can view a list of their reported incidents.

### `validator`

- All `default` permissions.
- Redirected after login to a Validator dashboard.
- Can review, approve, or reject unapproved incidents.

### `admin`

- Full system access.
- Can assign roles to users.
- Can manage labels, provinces, municipalities, and neighborhoods.
- Can manage all incidents and users.

---

## Troubleshooting

- **Database connection error**: Verify `HOST`, `USER`, and `PASS` and ensure MySQL is running.
- **SQL script errors**: Confirm `USER` has the corresponding permissions.
- **OAuth redirect issues**: Confirm redirect URIs match exactly.
- **Emails not sent**: Check app password configuration and account security settings.

---

## Contributing

Contributions are welcome. Suggested workflow:

1. Fork the repository.
2. Create a feature branch: `feature/my-change`.
3. Commit changes and open a pull request describing the change and reason.

---

## Authors

- Roniel Antonio Sabala Germán
- Jeremy Reyes González
- Abel Eduardo Martínez Robles

---

## License

This project is available under the **MIT License**.
