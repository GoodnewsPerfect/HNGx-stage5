# HNGx CHROME EXTENSION API Documentation

Welcome to the CHROME EXTENSION API documentation Laravel application. This API allows you to upload, and Read Video.

## Table of Contents

- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [API Endpoints](#api-endpoints)
- [Request and Response Formats](#request-and-response-formats)
- [Sample Usage](#sample-usage)

## Getting Started

### Prerequisites

Before you start, make sure you have the following prerequisites installed on your system:

- PHP (>= 7.4)
- Composer
- Laravel (>= 8.x)
- Database (e.g., MySQL, PostgreSQL)

### Installation

1. Clone this repository:

   ```bash
   git clone https://github.com/emekaenyinnia/HNGx-stage-five.git
   cd HNGx-stage-five
   ```

2. Install PHP dependencies using Composer:

    ```bash
    composer install
    ```
3. Create a .env file by copying the .env.example file and configure your database settings:
    ```bash
    cp .env.example .env
    ```
    Configure the database config variables as follows:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=
    ```
4. Run the migrations:
    ```bash
    php artisan migrate
    ```
5. Start the development server:
    ```bash
    php artisan serve

    ```
    Laravel API is now up and running on {127.0.0.1:8000} which is the base url!

### API Endpoints

### Request and Response Formats
The API uses JSON for both requests and responses. The following table describes the JSON format for the requests and responses:

<table>
    <thead>
        <th> Requests </th>
        <th> Response </th>
    </thead>
    <tbody>
        <tr>
            <td>POST /api</td>
            <td>201 Create with the newly uploaded screen record in the response body</td>
        </tr>
        <tr>
            <td>GET /api/{name}</td>
            <td>200 OK retuns the record with the specified name in the response body.</td>
        </tr>
           <tr>
            <td>GET /api</td>
            <td>200 OK with an array of records in the response body.</td>
        </tr>
            <tr>
            <td>DELETE /api/{id}</td>
            <td>204 No Content</td>
        </tr>
    </tbody>
</table>

### Sample Usage

4. Api URL:
    ```bash
    https://hngx-stage-five.onrender.com
    ``` 
## Adding a screen record  (201 Created)

<img src="documentation/images/create.png" alt="Create new record" />

## Fetch a screen record (200 OK)

<img src="documentation/images/get.png" alt="fetch a record" />

## Remove a record (204 No Content)

<img src="documentation/images/delete.png" alt="remove a record" />

## Fetch record (200 OK)

<img src="documentation/images/viewAll.png" alt="fetch all records" />

