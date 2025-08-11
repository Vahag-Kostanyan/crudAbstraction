# CRUD Abstraction for Laravel

A powerful and flexible CRUD abstraction layer for Laravel applications that simplifies the creation of RESTful APIs by providing a robust base structure for controllers, services, and requests.

## Features

- **Abstract CRUD Controller**: Ready-to-use base controller with common CRUD operations
- **Service Layer Pattern**: Clean separation of business logic using services
- **Request Validation**: Built-in request validation classes for each CRUD operation
- **Modular Structure**: Organized in modules for better code organization
- **Easy to Extend**: Simple inheritance model for customizing functionality
- **JSON Response Handling**: Standardized JSON response format

## Installation

1. Clone the repository:
```bash
git clone https://github.com/Vahag-Kostanyan/crudAbstraction.git
```

2. Install dependencies:
```bash
composer install
```

3. Set up your environment:
```bash
cp .env.example .env
php artisan key:generate
```

## Usage

### Creating a New CRUD Module

1. Create a new controller extending the base CrudController:

```php
namespace App\Modules\example\controllers;

use App\Models\Example;
use App\Modules\core\controllers\CrudController;

class ExampleController extends CrudController
{
    protected string $modelClass = Example::class;
}
```

### Customization

You can customize any of these properties in your controller:

- `$modelClass`: Your Eloquent model class
- `$searchField`: Fields that can be searched
- `$allowedIncludes`: Relations that can be included
- `$*RequestClass`: Custom request classes for validation
- `$*ServiceClass`: Custom service classes for business logic

## Directory Structure

```
app/
└── Modules/
    ├── core/
    │   ├── controllers/
    │   ├── interfaces/
    │   ├── requests/
    │   ├── services/
    │   └── traits/
    └── example/
        ├── controllers/
        ├── requests/
        └── services/
```

## Available Endpoints

Each controller automatically provides these RESTful endpoints:

- `GET /resource` - Index (List all)
- `GET /resource/{id}` - Show (Get one)
- `POST /resource` - Store (Create)
- `PUT /resource/{id}` - Update
- `DELETE /resource/{id}` - Destroy

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
