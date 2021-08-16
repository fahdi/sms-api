# SMS API using twilio

## Install

```
composer install
```

## Start App

```php -S localhost:8080 -t public public/index.php```

Should be available at http://localhost:8080/

# Send SMS

 Send POST requests to  http://localhost:8080/send-sms with body as follows

```
{
    "phone": "+9233495XXXXX",
    "message":"Example SMS text!",
    "client": "9765487"
}
```
