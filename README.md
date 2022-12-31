# OnTrack
A site to connect patients with their dietician.

## Usage
Requires PHP and MySQL to run.

Create a new MySQL connection.

Create a schema with `Character Set` and `Collation` set to default.

Create a table called `user` with the following columns:
* `id` with type `int`
* `username` with type `text`
* `password` with type `text`
* `type` with type `int`
* `number` with type `int`
* `connection` with type `text`
* `goal` with type `text`
* `deadline` with type `text`
* `notes` with type `text`
* `breakfast` with type `text`
* `lunch` with type `text`
* `snack` with type `text`
* `dinner` with type `text`
* `comments` with type `text`
* `date` with type `text`
* `title` with type `text`
* `ingredients` with type `text`
* `calories` with type `text`
* `macronutrients` with type `text`

Clone the repository:
```
$ git clone https://github.com/nicoella/OnTrack
```

Update `config.php` with `[database]` replaced by your database name and `[password]` replaced by your database password.

Start a PHP server with `[port]` replaced by your port of choice:
```
$ php -S localhost:[port] -t OnTrack
```

Visit the site at `localhost:port`.
