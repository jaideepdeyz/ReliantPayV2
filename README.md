 

# TODO for fresh deployment
- php artisan migrate:fresh
- php artisan db:seed
- ** No need to follow TODO for Affiliates below

<!-- # TODO for Affilates
- php artisan migrate
- login to the admin panel
- Add a new Affilate with the name called ORGANIC
- add a new column to organizations called affilate_id and set it to the id of the new affilate as default value -->


# ERD
php artisan generate:erd

# DB Seeding
php artisan db:seed (for running all seeders)
php artisan db:seed --class=<SeederName> (for running specific seeder)
