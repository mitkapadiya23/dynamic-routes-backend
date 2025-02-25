# Laravel Nested Pages API

## Setup Instructions

### Prerequisites

-   PHP 8.x
-   Composer
-   Laravel 11.x
-   MySQL database

### Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/your-repo/nested-pages-api.git
    cd nested-pages-api
    ```
2. Install dependencies:
    ```sh
    composer install
    ```
3. Create and configure the `.env` file:

    ```sh
    cp .env.example .env
    ```

    Update database credentials in `.env` file.

4. Run database migrations:
    ```sh
    php artisan migrate --seed
    ```
5. Generate application key:
    ```sh
    php artisan key:generate
    ```
6. Start the development server:
    ```sh
    php artisan serve
    ```

## API Endpoints

### Pages API

#### Get all pages (with nested structure)

```http
GET /api/pages
```

#### Create a new page

```http
POST /api/pages
```

**Request Body:**

```json
{
    "title": "New Page",
    "slug": "new-page",
    "content": "Page content here",
    "parent_id": 4
}
```

#### Get a specific page by ID

```http
GET /api/pages/{id}
```

## Assumptions & Design Considerations

-   Each page has a unique `slug`.
-   Pages can have unlimited depth in the nested hierarchy.
-   The API response includes parent-child relationships.
-   Uses Laravel Eloquent relationships for tree structure.
