
# Writer-Editor Dashboard Application

This project is a Writer-Editor Dashboard Application built with Laravel, Inertia.js, and Vue.js. It allows writers to create and edit articles, while editors can manage articles, users, and companies.




## Features

- Article Management
- User Management (Editor only)
- Company Management (Editor only)
- File Storage: Integrated with Amazon S3 for secure file uploads


## Installation

Follow the steps below to set up the project locally.
Prerequisites

Ensure you have the following installed:
- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL
- AWS account for S3 storage (optional for production-like setup)
1. Clone the Repository
```bash
  https://github.com/alucard079/writer-editor-laravel-app.git
  cd writer-editor-laravel-app
```
2. Install PHP Dependencies
```bash
  composer install
```
3. Install PHP Dependencies
```bash
  npm install
```
4. Set Up the .env File
```bash
  cp .env.example .env
```
Update the .env file with your database and AWS credentials:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

AWS_ACCESS_KEY_ID=your_aws_access_key
AWS_SECRET_ACCESS_KEY=your_aws_secret_key
AWS_DEFAULT_REGION=ap-southeast-1
AWS_BUCKET=your_bucket_name
AWS_URL=https://your_bucket_name.s3.amazonaws.com
```
5. Generate the Application Key
```bash
  php artisan key:generate
```
6. Run Database Migrations and Seeders
```bash
  php artisan migrate
  php artisan db:seed
```
7. Running the Project Locally
```bash
  composer run dev
```
    
## Tech Stack

**Client:** VueJS, HTML, CSS, TailwindCSS, DaisyUI

**Server:** PHP, Laravel, Inertia JS, MySQL, AWS


## License

[MIT](https://choosealicense.com/licenses/mit/)

