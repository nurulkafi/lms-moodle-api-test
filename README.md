
# Studi Kasus: Pengelolaan LMS melalui API Moodle


## Tech Stack

**Laravel**

**MoodleRest**

**Mazer (Admin Template)**
## Features

- Create User (Sign Up)
- Create Course
- Get Course
- Search Course


## Installation

Clone project

```bash
  https://github.com/nurulkafi/lms-moodle-api-test
```

Change env.example to .env 

Fill Moodle Server And Moodle Token 
```bash
  MOODLE_SERVER_ADDRESS=https://example.com/webservice/rest/server.php
  MOODLE_TOKEN=your_token
```

Run

```bash
  composer install
```

Run The Project


```bash
  php artisan serve
```