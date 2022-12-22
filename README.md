## About
Water tank application is a simple application that helps to keep track of water levels in the tank.
In the event the water level drops down lower than a specified quantity,
an alarm is set to the phone numbers added in the system.

## Installation

Install appliction using below instructions.

- Run following commands in your terminal
```bash
  git clone https://github.com/camaraousman/water_tank.git
  cd water_tank
  composer update
  cp .env.example .env
  php artisan key:generate
  php artisan migrate --seed
  php artisan serve
```

- in your browser, open
```bash
  http://127.0.0.1:8000/
```
