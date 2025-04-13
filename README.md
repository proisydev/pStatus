<p align="center"><a href="https://proisy.dev" title="Proisy's Portfolio" target="_blank"><img src="https://avatars.githubusercontent.com/u/204402355?v=4" width="100" alt="proisydev's Logo" style="border-radius: 50%; margin-top: 15px;"></a></p>

## About This Project

**pStatus** is a modern Laravel-based web application designed to monitor and display the status of various web services. It provides a user-friendly interface, real-time monitoring, and customizable features to suit developers and system administrators.

## Features

-   **Real-Time Monitoring**: Displays the status of services (online, offline, or degraded).
-   **Detailed Service Information**: Includes uptime ratio, operational periods, and service details.
-   **Integrated API**: Fetches data from configurable external APIs.
-   **Customizable UI**: Built with TailwindCSS for easy customization.
-   **Secure Configuration**: Protect sensitive data with environment-based settings.
-   **Scalable Architecture**: Designed to handle multiple services and high traffic efficiently.
-   **Error Handling**: Displays user-friendly error messages for API issues.

## Installation

### Prerequisites

-   **PHP** >= 8.2
-   **Composer**
-   **Node.js** and **npm**
-   **Web Server** (Apache or Nginx)
-   **Database** (MySQL or SQLite)

### Local Development Setup

1. **Clone the repository**:

    ```bash
    git clone https://github.com/proisydev/pStatus.git
    cd pStatus
    ```

2. **Install PHP dependencies**:

    ```bash
    composer install
    ```

3. **Install JavaScript dependencies**:

    ```bash
    npm install
    ```

4. **Set up the environment**:
   Copy the `.env.example` file to `.env` and configure the necessary variables:

    ```bash
    cp .env.example .env
    ```

5. **Generate the application key**:

    ```bash
    php artisan key:generate
    ```

6. **Run database migrations**:

    ```bash
    php artisan migrate
    ```

7. **Compile assets**:

    ```bash
    npm run dev
    ```

8. **Start the local server**:
    ```bash
    php artisan serve
    ```

---

### Production Deployment

To install this project on a shared hosting environment such as cPanel, follow these steps:

0. Compile assets with `npm run mix`.
1. Upload all project files to your hosting server (e.g., the "laravel" folder) and create another folder for your public files (e.g., the "web" folder).
2. Configure the `.env` file with the following settings:
    - `DB_CONNECTION`: Database type (e.g., `mysql`).
    - `DB_HOST`: Database host.
    - `DB_PORT`: Database port.
    - `DB_DATABASE`: Database name.
    - `DB_USERNAME`: Database username.
    - `DB_PASSWORD`: Database password.
    - `API_STATUS_URL`: The domain of [ProxyAPI.status](https://github.com/proisydev/ProxyAPI.status) used to retrieve the API status.
3. Run the database migrations using the command:
    ```bash
    php artisan migrate
    ```
4. Set the appropriate permissions for the storage and cache directories.
5. In your console, type:
    ```bash
    ln -s $HOME/public_html/pstatus/laravel/storage/app/public $HOME/public_html/pstatus/web/storage
    ```
    to create a symlink.
6. Edit your `index.php` file and add `__DIR__.'/../laravel/'` before the location folder path.
7. Move all `public` files except `mix-manifest.json` to your `web` folder.

The cPanel folder hierarchy should look like this:

-   pstatus/
    -   web/ [contains all public files]
    -   laravel/ [contains the Laravel project and vendor folder]

[If you need a video tutorial, you can watch it here: https://www.youtube.com/watch?v=UPCMtfIaGpA]

_Note: The cPanel installation requires the `vendor` folder to be inside your Laravel folder._

## Getting Started

To get started with this project, clone the repository and follow the installation steps. For local development, ensure you have the required software installed.

---

## Contributing

We welcome contributions to this project! If you would like to contribute, please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bugfix.
3. Submit a pull request with a detailed description of your changes.

## Security Vulnerabilities

If you discover a security vulnerability, please report it by sending an email to [security@pstatus.fr](mailto:security@pstatus.fr). We will address all security issues promptly.

## License

This project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT), originally created by [@proisydev](https://github.com/proisydev).
