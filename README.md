## Epay PHP Libary

This is a PHP libary for [Epay](http://www.epay.dk/). It mimics the [Stripe PHP Libary](https://github.com/stripe/stripe-php) to allow for a cleaner and easier to use API.

Install the package by doing: `composer require krve/epay`

**Work in progress**

## Current Todo

- Better test coverage
- Better Epay API Coverage
- Rewrite base API Class

## Documentation
You will probably notice that in the documentation there is several references to `$customer_id`. Customer ID references the subscriptionid you get back after having used the Epay Payment window. Don't worry about the mismatch in naming, it's simply called `$customer_id` so it fits the class Epay/Customer.

To set the your Merchant ID, Epay Webservice password and default currency make use of Epay/Epay.
**This needs to be done BEFORE making any calls to the api**
```php
Epay::setMerchantNumber($merchant_number);
Epay::setPassword('secret');
Epay::useCurrency('EUR', 978)
```

#### Epay/Customer
You can both retrieve and delete a Customer using the API. See examples below.
```php
$customer = Customer::retrieve($customer_id);
```
```php
$customer = Customer::retrieve($customer_id);
$customer->delete();
```
You can also get the customers subscriptions.
```php
$subscriptions = $customer->subscriptions();
```

#### Epay/Charge
See example below.
```php
$charge = Charge::create([
    'amount' => 1000,
    'customer' => $customer_id,
    'order' => uniqid(),
    'description' => 'Charge description'
]);
```
You also have the ability to specify a custom currency.
```php
$charge = Charge::create([
    'amount' => 1000,
    'customer' => $customer_id,
    'order' => uniqid(),
    'description' => 'Charge description',
    'currency' => 840,
]);
```

#### Epay/Plan
For the moment you can only create a very basic plan using the API. If you want more options (You probably do) make use of Epays Plan manager.
```php
$plan = Plan::create([
    'amount' => 2000,
    'interval' => 'yearly',
    'name' => 'Test Plan',
]);
```
You can also use the Epay\Plan to fetch the plans subscriptions.
```php
$subscriptions = $plan->subscriptions();
```

#### Epay/Subscription
You can create a subscription to a plan by doing the following:
```php
$subscription = Subscription::create([
    'customer' => $customer_id,
    'plan' => $plan_id
]);
```
This signs up the user to the plan.
You also have the ability to retrieve and cancel a subscription
```php
$subscription = Subscription::retrieve($subscription_id);
$subscription->cancel();
```
And fetch all subscriptions
```php
$subscriptions = Subscription::all();
```
When you have a subscription you also have the ability to fetch the subscriptions customer. This will return a Epay\Customer instance.
```php
$customer = $subscriptions->customer();
```
And the plan. This will return a Epay\Plan instance.
```php
$plan = $subscriptions->plan();
```

## Testing

Copy the .env.example to .env and fill out the values.
Then run `phpunit`

## Contributing
If you see anything you think could be improved, feel free to fork and create a PR with your changes. Just remember to keep the same code style.
