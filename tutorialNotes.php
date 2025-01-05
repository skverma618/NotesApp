php artisan config:publish filename  // to create new cinfig file

Laravel treat components folder a little different in views. We can use them like <x-layoutFile></x-layoutFile>.
x- specify that we are trying to get a component with the name following it.
Child of <x-layout> will be present in the $slot variable inside the layout.blade.php file.


composer require laravel/breez --dev
php artisan breeze:install
