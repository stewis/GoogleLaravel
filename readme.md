# Information

This is a code example using the below Laravel techniques:

- Jobs
- Observers
- Basic API
- Libraries/plugin
- Models
- FormRequests
- Migrations
- Database Seeder

The example also includes a example basic jQuery plugin whic implements the following

- GoogleMaps APIs  (location and directions)
- Requesting data from remote API and processing json

# Front end screen shot

<img src="https://i.imgur.com/5su4xpr.jpg" />

# Install

To install project clone this repository using git clone

```
git clone https://github.com/stewis/GoogleLaravel.git
```

next use compoer and install required packages

```
composer install
```

Next modify your env file updating your mysql details  Note:  MySQL 5.7 is required.

Add the following line to your env file:

```
GOOGLE_API=API_KEY_HERE
```

Note we requirer the following google maps API's

- Geocoding API
- Maps JavaScript API
- Directions API

Next run migrations

```
php artisan migrate
```

Youc an seed the database with the following command

```
php artisan db:seed
```

This will insert 5 fake resturants with 1 to 3 addresses and create the spatial data for these.

Please note coordinates data is only created when the address model is created or updated.  The observer is not triggered when adding directly into the database.


# Admin Interface

You can add your own locations using the backend interface located at /backend

# Compatability

This should work in all major browsers but please not firefox appears to perform slower for some reason...  I should really add a loading indicator. 
