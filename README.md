## Overview
This application is a service booking system that allows users to book various services provided by the admin.

## Features
- Registration & Login system
- Admin can create and manage services
- Users can view services and make bookings
- Users can view their own bookings
- Admin can view all bookings
- Followed naming conventions based on RESTful design
- API documentation is provided below 

## How to Get the Project in Your System
Follow this step to get the project:

### 1. Clone the Project and Go to The Project Directory
```
git  clone  https://github.com/mhasanrabbi/service-booking.git
cd  service-booking
```

### 2. Install Dependencies
```
composer  install
```

### 3. Environment Setup
Copy the ```.env``` example file
```
cp  .env.example  .env
```
Generate Key
```
php  artisan  key:generate
```
Configure your database. provide your own database credentials
```
DB_DATABASE=your_db_name
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
```

### 4. Run Database Migration
For admin access. Run the migration with seed. It also seed some demo services also.
```
php  artisan  migrate --seed
```

### 5. Run Application
```
php  artisan  serve
```
Application will be run on: ```http://localhost:8000```

## Postman API Doc
- [Documentation](https://documenter.getpostman.com/view/25536181/2sB3BAMYVN)

## How to Test API Endpoint
After run ```php artisan serve```, application will be run on ```http://localhost:8000```
And for api test use route like this: ```http://localhost:8000/api/v1```

Note: You can use Postman to test the endpoints.

### Authntication Process
The following endpoints are used for registration and login. After logging in, you will receive a token — use this token in the request headers as follows: ```Authorization: Bearer token```

Registration: ```POST api/v1/register```

Login: ```POST api/v1/login```


<ins>Admin Credentials:</ins>

Email: ```admin@gmail.com``` and Passsword: ```Admin123#```
