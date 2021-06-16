# Fortify-driven Laravel UI replacement

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vanthao03596/fortify-limitless.svg?style=flat-square)](https://packagist.org/packages/vanthao03596/fortify-limitless)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/vanthao03596/fortify-limitless/Check%20&%20fix%20styling?label=code%20style)](https://github.com/vanthao03596/fortify-limitless/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/vanthao03596/fortify-limitless.svg?style=flat-square)](https://packagist.org/packages/vanthao03596/fortify-limitless)


<p  align="center"><img  src="https://banners.beyondco.de/FortifyLimitless.png?theme=light&packageManager=composer+require&packageName=vanthao03596%2Ffortify-limitless&pattern=architect&style=style_1&description=Laravel+Fortify+driven+replacement+to+the+Laravel+UI+package&md=1&showWatermark=0&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg"></p>

# Introduction

**FortifyLimitless** is an unopinionated authentication starter, powered by [*Laravel Fortify*](https://github.com/laravel/fortify). It is completely unstyled -- on purpose -- and only includes a minimal amount of markup to get your project running quickly. This package can be used to start your project, or you can use the [*FortifyUi Preset Template*](https://github.com/zacksmash/fortify-ui-preset) which allows you to create your own preset that you can install with **FortifyUI**.

---

- [Installation](#installation)
- [Configuration](#configuration)
- [Features](#features)
  - [Email Verification](#features-email-verification)
  - [Password Confirmation](#features-password-confirmation)
  - [Two-Factor Authentication](#features-two-factor-auth)
  - [Update User Password/Profile](#features-password-profile)
- [FortifyLimitless Presets](#presets)

<a name="installation"></a>
## Installation

To get started, you'll need to install **FortifyLimitless** using Composer. This will install *Laravel Fortify* as well so, please make sure you **do not** have it installed, already.

```bash
composer require vanthao03596/fortify-limitless
```

Next, you'll need to run the install command:

```bash
php artisan fortify-limitless
```

This command will publish **FortifyLimitless's** views, add the `home` route to `web.php` and add the **FortifyLimitless** service provider to your `app/Providers` directory. This will also publish the service provider and config file for *Laravel Fortify*. Lastly, it will register both service providers in the `app.php` config file, under the providers array.

That's it, you're all setup! For advanced setup and configuration options, keep reading!

<a name="configuration"></a>
## Configuration

Add this to your `AppServiceProvider` or `FortifyServiceProvider`, in the `boot()` method.

```php
Fortify::loginView(function () {
    return view('auth.login');
});

Fortify::registerView(function () {
    return view('auth.register');
});

Fortify::requestPasswordResetLinkView(function () {
    return view('auth.forgot-password');
});

Fortify::resetPasswordView(function ($request) {
    return view('auth.reset-password', ['request' => $request]);
});

// Fortify::verifyEmailView(function () {
//     return view('auth.verify-email');
// });

// Fortify::confirmPasswordView(function () {
//     return view('auth.confirm-password');
// });

// Fortify::twoFactorChallengeView(function () {
//     return view('auth.two-factor-challenge');
// });
```

To register all views at once, you can use this instead:

```php
Fortify::viewPrefix('auth.');
```

Now, you should have all of the registered views required by *Laravel Fortify*, including basic layout and home views, as well as optional password confirmation, email verification and two-factor authentication views.

<a name="features"></a>
## Features

By default, **FortifyLimitless** is setup to handle the basic authentication functions (Login, Register, Password Reset) provided by *Laravel Fortify*.

<a name="features-email-verification"></a>
### Email Verification
To enable the email verification feature, you'll need to visit the **FortifyLimitless** service provider and uncomment `Fortify::verifyEmailView()`, to register the view. Then, go to the `fortify.php` config file and make sure `Features::emailVerification()` is uncommented. Next, you'll want to update your `User` model to include the following:

```php
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    ...
```

This allows you to attach the `verified` middleware to any of your routes, which is handled by the `verify.blade.php` file.

[More info about this can be found here.](https://github.com/laravel/fortify/blob/1.x/README.md#email-verification)

<a name="features-password-confirmation"></a>
### Password Confirmation
To enable the password confirmation feature, you'll need to visit the **FortifyLimitless** service provider and uncomment `Fortify::confirmPasswordView()`, to register the view. This allows you to attach the `password.confirm` middleware to any of your routes, which is handled by the `password-confirm.blade.php` file.

<a name="features-two-factor-auth"></a>
### Two-Factor Authentication
To enable the two-factor authentication feature, you'll need to visit the **FortifyLimitless** service provider and uncomment `Fortify::twoFactorChallengeView()`, to register the view. Then, go to the `fortify.php` config file and make sure `Features::twoFactorAuthentication` is uncommented. Next, you'll want to update your `User` model to include the following:

```php
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;
    ...
```

That's it! Now, you can log into your application and enable or disable two-factor authentication.

<a name="features-password-profile"></a>
### Update User Password/Profile
To enable the ability to update user passwords and/or profile information, go to the `fortify.php` config file and make sure these features are uncommented:

```php
Features::updateProfileInformation(),
Features::updatePasswords(),
```

<a name="presets"></a>
## FortifyLimitless Presets

**FortifyLimitless** encourges make your own presets, with your favorite frontend libraries and frameworks. To get started, visit the [*Fortify UI Preset Template*](https://github.com/zacksmash/fortify-ui-preset) repository, and click the "Use Template" button.


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [phamthao](https://github.com/vanthao03596)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
