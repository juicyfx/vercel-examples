# Front-end user plugin

[![Build Status](https://img.shields.io/travis/rainlab/user-plugin.svg?branch=master)](https://travis-ci.org/rainlab/user-plugin)
[![MIT License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/rainlab/user-plugin/blob/master/LICENCE.md)

Front-end user management for October CMS.

## Requirements

This plugin requires the [Ajax Framework](https://octobercms.com/docs/cms/ajax) to be included in your layout/page in order to handle form requests.

## Managing users

Users are managed on the Users tab found in the back-end. Each user provides minimal data fields - **Name**, **Surname**, **Email** and **Password**. The Name can represent either the person's first name or their full name, making the Surname field optional, depending on the complexity of your site.

Below the **Email** field is an checkbox to block all outgoing mail sent to the user. This is a useful feature for accounts with an email address that is bouncing mail or has reported spam. When checked, no mail will ever be sent to this address, except for the mail template used for resetting the password.

## Plugin settings

This plugin creates a Settings menu item, found by navigating to **Settings > Users > User settings**. This page allows the setting of common features, described in more detail below.

#### Registration

Registration to the site is allowed by default. If you are running a closed site, or need to temporarily disable registration, you may disable this feature by switching **Allow user registration** to the OFF setting.

#### Activation

Activation is a process of vetting a user who joins the site. By default, users are activated automatically when they register and an activated account is required to sign in.

The **Activation mode** specifies the activation workflow:

- **Automatic**: This mode will automatically activate a user when they first register. This is the same as disabling activation entirely and is the default setting.
- **User**: The user can activate their account by responding to a confirmation message sent to their nominated email address.
- **Administrator**: The user can only be activated by an administrator via the back-end area.

You can allow users to sign in without activating by switching **Sign in requires activation** to the OFF setting. This is useful for minimising friction when registering, however with this approach it is often a good idea to disable any "identity sensitive" features until the user has been activated, such as posting content. Alternatively, you could implement a grace period that deletes users (with sufficient warning!) who have not activated within a given period of time.

Users have the ability to resend the activation email by clicking **Send the verification email again** found in the Account component.

#### Sign in

By default a User will sign in to the site using their email address as a unique identifier. You may use a unique login name instead by changing the **Login attribute** value to Username. This will introduce a new field called **Username** for each user, allowing them to specify their own short name or alias for identification. Both the Email address and Username must be unique to the user.

If a user experiences too many failed sign in attempts, their account will be temporarily suspended for a period of time. This feature is enabled by default and will suspend an account for 15 minutes after 5 failed sign in attempts, for a given IP address. You may disable this feature by switching **Throttle attempts** to the OFF setting.

As a security precaution, you may restrict users from having sessions across multiple devices at the same time. Enable the **Prevent concurrent sessions** setting to use this feature. When a user signs in to their account, it will automatically sign out the user for all other sessions.

#### Notifications

When a user is first activated -- either by registration, email confirmation or administrator approval -- they are sent a welcome email. To disable the welcome email, select "Do not send a notification" from the **Welcome mail template** dropdown. The default message template used is `rainlab.user::mail.welcome` and you can customize this by selecting **Mail > Mail Templates** from the settings menu.

## Extended features

For extra functionality, consider also installing the [User Plus+ plugin](http://octobercms.com/plugin/rainlab-userplus) (`RainLab.UserPlus`).

## Session component

The session component should be added to a layout that has registered users. It has no default markup.

### User variable

You can check the logged in user by accessing the **{{ user }}** Twig variable:

    {% if user %}
        <p>Hello {{ user.name }}</p>
    {% else %}
        <p>Nobody is logged in</p>
    {% endif %}

### Signing out

The Session component allows a user to sign out of their session.

    <a data-request="onLogout" data-request-data="redirect: '/good-bye'">Sign out</a>

### Page restriction

The Session component allows the restriction of a page or layout by allowing only signed in users, only guests or no restriction. This example shows how to restrict a page to users only:

    title = "Restricted page"
    url = "/users-only"

    [session]
    security = "user"
    redirect = "home"

The `security` property can be user, guest or all. The `redirect` property refers to a page name to redirect to when access is restricted.

### Route restriction

Access to routes can be restricted by applying the `AuthMiddleware`.

    Route::group(['middleware' => 'RainLab\User\Classes\AuthMiddleware'], function () {
        // All routes here will require authentication
    });

## Account component

The account component provides a user sign in form, registration form, activation form and update form. To display the form:

    title = "Account"
    url = "/account/:code?"

    [account]
    redirect = "home"
    paramCode = "code"
    ==
    {% component 'account' %}

If the user is logged out, this will display a sign in and registration form. Otherwise, it will display an update form. The `redirect` property is the page name to redirect to after the submit process is complete. The `paramCode` is the URL routing code used for activating the user, only used if the feature is enabled.

## Reset Password component

The reset password component allows a user to reset their password if they have forgotten it.

    title = "Forgotten your password?"
    url = "/forgot-password/:code?"

    [resetPassword]
    paramCode = "code"
    ==
    {% component 'resetPassword' %}

This will display the initial restoration request form and also the password reset form used after the verification email has been received by the user. The `paramCode` is the URL routing code used for resetting the password.

## Using a login name

By default the User plugin will use the email address as the login name. To switch to using a user defined login name, navigate to the backend under System > Users > User Settings and change the Login attribute under the Sign in tab to be **Username**. Then simply ask for a username upon registration by adding the username field:

    <form data-request="onRegister">
        <label>Full Name</label>
        <input name="name" type="text" placeholder="Enter your full name">

        <label>Email</label>
        <input name="email" type="email" placeholder="Enter your email">

        <label>Username</label>
        <input name="username" placeholder="Pick a login name">

        <label>Password</label>
        <input name="password" type="password" placeholder="Choose a password">

        <button type="submit">Register</button>
    </form>

We can add any other additional fields here too, such as `phone`, `company`, etc.

## Password length requirements

By default, the User plugin requires a minimum password length of 8 characters for all users when registering or changing their password. You can change this length requirement by going to backend and navigating to System > Users > User Settings. Inside the Registration tab, a **Minimum password length** field is provided, allowing you to increase or decrease this limit to your preferred length.

## Error handling

### Flash messages

This plugin makes use of October's [`Flash API`](http://octobercms.com/docs/markup/tag-flash). In order to display the error messages, you need to place the following snippet in your layout or page.

    {% flash %}
        <div class="alert alert-{{ type == 'error' ? 'danger' : type }}">{{ message }}</div>
    {% endflash %}

### AJAX errors

The User plugin displays AJAX error messages in a simple ``alert()``-box by default. However, this might scare non-technical users. You can change the default behavior of an AJAX error from displaying an ``alert()`` message, like this:

    <script>
        $(window).on('ajaxErrorMessage', function(event, message){

            // This can be any custom JavaScript you want
            alert('Something bad happened, mate, here it is: ' + message);

            // This will stop the default alert() message
            event.preventDefault();

        })
    </script>

### Checking if a login name is already taken

Here is a simple example of how you can quickly check if an email address / username is available in your registration forms. First, inside the page code, define the following AJAX handler to check the login name, here we are using the email address:

    public function onCheckEmail()
    {
        return ['isTaken' => Auth::findUserByLogin(post('email')) ? 1 : 0];
    }

For the email input we use the `data-request` and `data-track-input` attributes to call the `onCheckEmail` handler any time the field is updated. The `data-request-success` attribute will call some jQuery code to toggle the alert box.

    <div class="form-group">
        <label>Email address</label>
        <input
            name="email"
            type="email"
            class="form-control"
            data-request="onCheckEmail"
            data-request-success="$('#loginTaken').toggle(!!data.isTaken)"
            data-track-input />
    </div>

    <div id="loginTaken" class="alert alert-danger" style="display: none">
        Sorry, that login name is already taken.
    </div>

## Overriding functionality

Here is how you would override the `onSignin()` handler to log any error messages. Inside the page code, define this method:

    function onSignin()
    {
        try {
            return $this->account->onSignin();
        }
        catch (Exception $ex) {
            Log::error($ex);
        }
    }

Here the local handler method will take priority over the **account** component's event handler. Then we simply inherit the logic by calling the parent handler manually, via the component object (`$this->account`).

## Auth facade

There is an `Auth` facade you may use for common tasks, it primarily inherits the `October\Rain\Auth\Manager` class for functionality.

You may use `Auth::register` to register an account:

    $user = Auth::register([
        'name' => 'Some User',
        'email' => 'some@website.tld',
        'password' => 'changeme',
        'password_confirmation' => 'changeme',
    ]);

The second argument can specify if the account should be automatically activated:

    // Auto activate this user
    $user = Auth::register([...], true);

The `Auth::check` method is a quick way to check if the user is signed in.

    // Returns true if signed in.
    $loggedIn = Auth::check();

To return the user model that is signed in, use `Auth::getUser` instead.

    // Returns the signed in user
    $user = Auth::getUser();

You may authenticate a user by providing their login and password with `Auth::authenticate`.

    // Authenticate user by credentials
    $user = Auth::authenticate([
        'login' => post('login'),
        'password' => post('password')
    ]);

The second argument is used to store a non-expire cookie for the user.

    $user = Auth::authenticate([...], true);

You can also authenticate as a user simply by passing the user model along with `Auth::login`.

    // Sign in as a specific user
    Auth::login($user);

The second argument is the same.

    // Sign in and remember the user
    Auth::login($user, true);

You may look up a user by their login name using the `Auth::findUserByLogin` method.

    $user = Auth::findUserByLogin('some@email.tld');

## Guest users

Creating a guest user allows the registration process to be deferred. For example, making a purchase without needing to register first. Guest users are not able to sign in and will be added to the user group with the code `guest`.

Use the `Auth::registerGuest` method to create a guest user, it will return a user object and can be called multiple times. The unique identifier is the email address, which is a required field.

    $user = Auth::registerGuest(['email' => 'person@acme.tld']);

When a user registers with the same email address using the `Auth::register` method, they will inherit the existing guest user account.

    // This will not throw an "Email already taken" error
    $user = Auth::register([
        'email' => 'person@acme.tld',
        'password' => 'changeme',
        'password_confirmation' => 'changeme',
    ]);

> **Important**: If you are using guest accounts, it is important to disable sensitive functionality for user accounts that are not verified, since it may be possible for anyone to inherit a guest account.

You may also convert a guest to a registered user with the `convertToRegistered` method. This will generate a random password and sends an invitation using the `rainlab.user::mail.invite` template.

    $user->convertToRegistered();

To disable the notification and password reset, pass the first argument as false.

    $user->convertToRegistered(false);

## Events

This plugin will fire some global events that can be useful for interacting with other plugins.

- **rainlab.user.beforeRegister**: Before the user's registration is processed. Passed the `$data` variable by reference to enable direct modifications to the `$data` provided to the `Auth::register()` method.
- **rainlab.user.register**: The user has successfully registered. Passed the `$user` object and the submitted `$data` variable.
- **rainlab.user.beforeAuthenticate**: Before the user is attempting to authenticate using the Account component.
- **rainlab.user.login**: The user has successfully signed in.
- **rainlab.user.logout**: The user has successfully signed out.
- **rainlab.user.deactivate**: The user has opted-out of the site by deactivating their account. This should be used to disable any content the user may want removed.
- **rainlab.user.reactivate**: The user has reactivated their own account by signing back in. This should revive the users content on the site.
- **rainlab.user.getNotificationVars**: Fires when sending a user notification to enable passing more variables to the email templates. Passes the `$user` model the template will be for.

Here is an example of hooking an event:

    Event::listen('rainlab.user.deactivate', function($user) {
        // Hide all posts by the user
    });

A common requirement is to adapt another to a legacy authentication system. In the example below, the `WordPressLogin::check` method would check the user password using an alternative hashing method, and if successful, update to the new one used by October.

    Event::listen('rainlab.user.beforeAuthenticate', function($component, $credentials) {
        $login = array_get($credentials, 'login');
        $password = array_get($credentials, 'password');

        /*
         * No such user exists
         */
        if (!$user = Auth::findUserByLogin($login)) {
            return;
        }

        /*
         * The user is logging in with their old WordPress account
         * for the first time. Rehash their password using the new
         * October system.
         */
        if (WordPressLogin::check($user->password, $password)) {
            $user->password = $user->password_confirmation = $password;
            $user->forceSave();
        }
    });
