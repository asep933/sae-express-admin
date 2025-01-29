# SAE Express

SAE Express is a web-based application developed using Laravel. This application is designed to provide expedition services with features for shipment management, package tracking, and user management.

## Main Features
- Shipment management
- Real-time package tracking
- User Multi authentication and authorization
- Admin dashboard for data management
- Third-party API integration (if needed)

## Installation

### System Requirements
Make sure your system meets the following requirements:
- PHP >= 8.0
- Composer
- MySQL
- Node.js & NPM (if using additional frontend features)

### Installation Steps
1. Clone the repository:
   ```sh
   git clone https://github.com/username/sae-express.git
   cd sae-express
   ```
2. Install dependencies with Composer:
   ```sh
   composer install
   ```
3. Create the `.env` file from the template:
   ```sh
   cp .env.example .env
   ```
4. Configure the database in the `.env` file
5. Generate the application key:
   ```sh
   php artisan key:generate
   ```
6. Run migrations and seed the database:
   ```sh
   php artisan migrate --seed
   ```
7. Start the local server:
   ```sh
   php artisan serve
   ```

## Usage
After installation is complete, the application can be accessed at `http://localhost:8000`. Use the account created during database seeding to log in as an admin or create a new account through the registration page.

## Deployment
Use a server that supports Laravel, such as Apache or Nginx. Some steps to take before deployment:
- Run `php artisan config:cache` to improve performance
- Ensure the `storage` and `bootstrap/cache` directories have the correct permissions
- Use a supervisor or another system to run the queue worker (if there are features that use queues)
