# IncidentsDR

A PHP web application that lets users report, manage, and visualize real-world incidents of the Dominican Republic (DR) on an interactive map.

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

- User registration and authentication with **Google** / **Microsoft**.
- **Map** / **list view** with incidents displayed as icons based on their label name.
- **Search bar** that filters results in both the Map and the List views.
- **Last 24h** filter button to display incidents reported within the current day.
- Incident detail **modal**: clicking an incident opens a modal with the incidnet data.
- **Role-based dashboards** and views for reporters, validators, and administrators.
- Models the administrative hierarchy for the Dominican Republic (province → municipality → neighborhood).
- Simple local deployment using the built-in PHP development server.

---

## Requirements

- PHP 8.4.7 or newer
- MySQL
- Composer

---

## Quick Installation

1. Clone the repository:

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

How to get `MAIL_PASS`:

1. Go to Google Account Security settings: [https://myaccount.google.com/security](https://myaccount.google.com/security)
2. Enable 2-Step Verification for the account you will use in `MAIL_USER`.
3. Generate an App Password and copy it into `MAIL_PASS`.

### Google OAuth (optional)

```env
GOOGLE_CLIENT_ID='YOUR_GOOGLE_CLIENT_ID'
GOOGLE_CLIENT_SECRET='YOUR_GOOGLE_CLIENT_SECRET'
```

- Redirect URI:

```bash
http://localhost:1111/auth/GoogleCallbackController.php
```

How to get your Google `CLIENT_ID` & `CLIENT_SECRET`:

1. Open Google Cloud Console: [https://console.cloud.google.com/](https://console.cloud.google.com/)
2. Go to **APIs & Services → Credentials** and create an **OAuth Client ID** (type: Web application).
3. Add the Redirect URI shown above and copy the `CLIENT_ID` and `CLIENT_SECRET` into the `.env` file.

### Microsoft OAuth (optional)

```env
MICROSOFT_CLIENT_ID='YOUR_MICROSOFT_CLIENT_ID'
MICROSOFT_CLIENT_SECRET='YOUR_MICROSOFT_CLIENT_SECRET'
```

- Redirect URI:

```md
http://localhost:1111/auth/MicrosoftCallbackController.php
```

How to get your Microsoft `CLIENT_ID` & `CLIENT_SECRET`:

1. Open the Azure Portal: [https://portal.azure.com/](https://portal.azure.com/)
2. Go to **Azure Active Directory → App registrations** and register a new application.
3. Add the Redirect URI shown above, copy the `Application (client) ID`, and create a client secret under **Certificates & secrets**. Paste these values into the `.env` file.

---

## Database Setup

Run the installer script to create the required database tables:

```bash
# From the repository root:
php src/db/install.php
```

---

## Run Locally

Start the PHP development server from the `src/` folder:

```bash
cd src
php -S localhost:1111 -t public
```

Open your browser at:
`http://localhost:1111`

---

## Email Notifications

Users can reset their password via **email verification code**:

- A reset request sends a code to the registered email.
- The user enters the code to set a new password.

> Requires email configuration (`MAIL_USER` and `MAIL_PASS`) in `.env`.

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
- Can view a CRUD list of their reported incidents.

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
- **SQL script errors**: Confirm the DB user has permission to create databases and tables.
- **OAuth redirect issues**: Redirect URIs must match exactly.
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
