# HNGx Chrome Extension API

Welcome to the Chrome Extension API documentation Laravel application. This API allows you to upload a video and get url to the video and also the transcription of the video, Delete a video record and also get all video records.

## Table of Contents

- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [API Endpoints](#api-endpoints)
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
   git clone https://github.com/GoodnewsPerfect/HNGx-stage5
   cd HNGx-stage5 
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
    Laravel Chrome Extension API is now up and running on {127.0.0.1:8000} which is the base url!

### Sample Usage

## Uploading a new video (201 Created)

<img src="documentation/postVideo.png" alt="Upload a new video
## Fetch all video records (200 OK)

<img src="documentation/get all.png" alt="Fetch all record" />

## Remove a video record (204 No Content)

<img src="documentation/deleteRecord.png" alt="remove a user" />