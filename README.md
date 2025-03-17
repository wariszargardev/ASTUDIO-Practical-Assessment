
## 🚀 **Project Setup Instructions**

### **1️⃣ Clone the Repository**
```sh
git clone https://github.com/wariszargardev/ASTUDIO-Practical-Assessment.git
cd ASTUDIO-Practical-Assessment

composer install

cp .env.example .env

## DB Configuration

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password



php artisan key:generate

## Fresh migration
php artisan migrate:fresh
php artisan passport:client --personal

php artisan passport:install

## Create the Personal Access Client
php artisan passport:client --personal
```


# Postman API Collection - Assessment

## 🚀 **Setup Instructions**
- Import the following files into **Postman**:
    - `Assessment.postman_collection.json`
    - `Assessment.postman_environment.json`
- Select the **Assessment** environment in Postman.

### 2️⃣ **Set Up Environment Variables**
The environment file contains the following **auto-updating variables**:

| **Variable**      | **Description** |
|------------------|---------------------------------------------|
| `base_url`       | API Base URL (`http://astudio-practical-assessment.test/api/`) |
| `auth_token`     | Stores the user's authentication token (set automatically) |
| `user_id`        | Stores the logged-in user ID (set automatically) |
| `project_id`     | Stores the last created project ID (set automatically) |
| `time_sheet_id`  | Stores the last created timesheet ID (set automatically) |
| `attribute_id`   | Stores the last created attribute ID (set automatically) |

