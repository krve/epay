## Epay PHP Libary

This is a PHP libary for [Epay](http://www.epay.dk/). It mimics the [Stripe PHP Libary](https://github.com/stripe/stripe-php) to allow for a cleaner and easier to use API.

**Work in progress**

## Current Todo

- Better test coverage
- Better Epay API Coverage
- Rewrite base API Class

## Documentation
You will probably notice that in the documentation there is several references to `$subscription_id`. This is **NOT** the Epay/Subscription ID but instead it is returned from Epay when first adding your card. This is specific to the user. The reason for the confusing semantics is because this package tries to stay as close to the Stripe PHP Libary as possible.

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
$customer = Customer::retrieve($subscription_id);
```
```php
$customer = Customer::retrieve($subscription_id);
$customer->delete();
```

#### Epay/Charge
See example below.
```php
$charge = Charge::create([
    'amount' => 1000,
    'customer' => $subscription_id,
    'order' => uniqid(),
    'description' => 'Charge description'
]);
```  
You also have the ability to specify a custom currency.
```php
$charge = Charge::create([
    'amount' => 1000,
    'customer' => $subscription_id,
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

#### Epay/Subscription
You can create a subscription to a plan by doing the following:
```php
$subscription = Subscription::create([
    'customer' => $subscription_id,
    'plan' => $plan_id
]);
```
This signs up the user to the plan.  
You also have the ability to retrieve and delete a subscription
```php
$subscription = Subscription::retrieve($subscription_id);
$subscription->delete();
```

## Testing

Copy the .env.example to .env and fill out the values.  
Then run `phpunit`

## Contributing
If you see anything you think could be improved, feel free to fork and create a PR with your changes. Just remember to keep the same code style.
