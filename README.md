# product-listing
list using laravel 5.4 ,angular 1, bootstrap 3



=> make changes in the .env file
for migrate to run make changes in the appServiceProvider.php

=> use Illuminate\Support\Facades\Schema;
public function boot()
{
    Schema::defaultStringLength(191);
}

laravel 5.4 used. php version 5.6, angular 1.3, bootstrap 3, 
also used angular 

=> to crate migrate for new table
	php artisan make:migration create_products_table

=> to add column in the existing table
	php artisan make:migration add_another_column_to_table --table=details

=>to create model
	php artisan make:model Article
=>templates folder is made by me its not the laravel's default folder.