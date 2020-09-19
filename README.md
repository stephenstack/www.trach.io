# My Trachy Project
Tracheostomy care app that enables logging and retrieval of accurate and real time care data for your patient with Tracheostomy needs.


## Track Interventions
Record interventions such as suctioning, O2 and desat events accuratley, without affecting patient care. Get alerts when care falls behind expectations.

## View Care History

Understand current patient needs by viewing recent events. Review long term patient care history to aid in accurate clinical decision making.

## Tracheostomy Care Insights
Gather holistical environment and ancilliary patient care data to help determine patterns and makre tactical and strategic decisions on patient care.

## Features

- [Laravel 6.2](https://laravel.com/docs/6.x) 
- Vue + VueRouter + Vuex + VueI18n + ESlint
- Pages with dynamic import and custom layouts
- Login, register, email verification and password reset
- Authentication with JWT
- [Tailwind CSS](https://tailwindcss.com/) + Font Awesome 5
- Multitenant SaaS

## Installation
- Edit `.env` and set your database connection details
- (When installed via git clone or download, run `php artisan key:generate` and `php artisan jwt:secret`)
- `php artisan migrate`
- `npm install`

## Usage

#### Development

```bash
# build and watch
npm run watch

# serve with hot reloading
npm run hot
```

#### Production

```bash
npm run production
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.
