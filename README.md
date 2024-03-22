# Firefly Filament Blog
The Filament Blog Plugin is a feature-rich plugin designed to enhance your blogging experience on your website. It comes with a variety of powerful features to help you manage and customize your blog posts effectively.

## Features

- **Easy Installation:** Simple and straightforward installation process.
- **User-Friendly Interface:** Intuitive and user-friendly interface for easy management of blog posts.
- **SEO Meta Extension:** Enhance your blog's search engine optimization with built-in meta tag customization.
- **Post Scheduled for Future:** Schedule your blog posts to be published at a future date and time.
- **Social Media Share Feature:** Allow users to easily share your blog posts on social media platforms.
- **Comment Feature:** Enable comments on your blog posts to encourage engagement and discussion.
- **Newsletter Subscription:** Integrate newsletter subscription forms to grow your email list.
- **New Post Published Notification:** Notify subscribers when a new blog post is published.
- **Category Search:** Categorize your blog posts for easy navigation and search.

## Installation
If your project is not already using Filament, you can install it by running the following commands:
```bash
composer require filament/filament:"^3.2" -W
```
```bash
php artisan filament:install --panels
```
Install the Filament Blog Plugin by running the following command:
 ```bash
composer require firefly/filament-blog
```

## Usage
After composer require, you can start using the Filament Blog Plugin by run the following command:

```bash
php artisan filament-blog:install
```
This command will publish `filamentblog.php` config file and `create_blog_tables.php.stub` migration file.
````php
<?php
/**
 * |--------------------------------------------------------------------------
 * | Set up your blog configuration
 * |--------------------------------------------------------------------------
 * |
 * | This file is for storing the configuration of your blog.
 * | The route configuration is for setting up the route prefix and middleware.
 * | The user configuration is for setting up the user model and columns.
 * | The seo configuration is for setting up the default meta tags for the blog.
 * | The recaptcha configuration is for setting up the recaptcha for the blog.
 * |
 * /
 */

return [
    'route' => [
        'prefix' => 'blogs',
        'middleware' => ['web'],
        'login' => [
            'name' => 'filament.admin.auth.login',
        ],
    ],
    'user' => [
        'model' => \Firefly\FilamentBlog\Models\User::class,
        'foreign_key' => 'user_id',
        'columns' => [
            'name' => 'name',
            'avatar' => 'profile_photo_path', // column name or false
        ],
    ],
    'seo' => [
        'meta' => [
            'title' => 'Filament Blog',
            'description' => 'This is filament blog seo meta description',
            'keywords' => [],
        ],
    ],

    'recaptcha' => [
        'enabled' => false, // true or false
        'site_key' => env('RECAPTCHA_SITE_KEY'),
        'secret_key' => env('RECAPTCHA_SECRET_KEY'),
    ],
];
````
Before running the migration, you can modify the `filamentblog.php` config file to suit your needs.

## What if you have already a User model?
- If you already have a User model, you can modify the `filamentblog.php` config file to use your User model.
- Make sure the name column is the user's name column.
- If you have already `profile_photo_path` column in your User model, you can set it to `false` in the `filamentblog.php` config file.
- If you want to change foreign_key column name, you can modify the `filamentblog.php` config file.

### Migrate the database
After modifying the `filamentblog.php` config file, you can run the migration by running the following command:
```bash
php artisan migrate
```
### Storage Link
After running the migration, you can create a symbolic link to the storage directory by running the following command:
```bash
php artisan storage:link
```
### Attach filament blog panel to the dashboard
You can attach the Filament Blog panel to the dashboard by adding the following code to your panel provider:
Add firefly/filament-blog to your panel passing the class to your `plugins()` method.

```php
use Firefly\FilamentBlog\Blog;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            Blog::make()
        ])
}
```

### Manage user relationship
If you want to manage the user relationship, you can modify the `User` model to have a relationship with the `Post` model.
```php
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Firefly\FilamentBlog\Traits\HasBlog;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasBlog;
}
```
### Allow user to comment
If you want to allow users to comment on blog posts, you can modify the `User` model to add a method `canComment()`.

```php
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Firefly\FilamentBlog\Traits\HasBlog;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
   public function canComment(): bool
    {
        // your conditional logic here
        return true;
    }
    
}
```
Now you can start using the Filament Blog Plugin to manage your blog posts effectively.
```yourdomain.com/blogs```
You can change the route prefix in the `filamentblog.php` config file.