# Laravel Humanized Dictionary Enum

Laravel API enum dictionary support and validation library.

Humanize your Enum's in API resource responses.

## Installing

### Composer

To get started install package by requiring it through composer CLI 

```
composer require synortix/laravel-dictionary:1.*
```

## Usage

### Define Dictionary

You can define your dictionary by extending **Synortix\Dictionary\Dictionary** class

```
    use Synortix\Dictionary\Dictionary;
    
    class CustomerTypeDictionary extends Dictionary
    {
        const FREE = 1;
        const PAID = 2;
    }
```

### Create Dictionary Instance

You can create object from string representation and pass that further as object.
_Dictionary string case-insensitive_. 

```
    try {
        $customerType = new CustomerTypeDictionary($request->get('customer_type'));
    } catch (UnexpectedValueException $e) {
        // invalid value, handle it here
    }
```

### Use in Model Resources

```
    class CustomerResource extends Resource
    {
        public function toArray($request)
        {
            return [
                'id' => $this->resource->id,
                'type' => (string) new CustomerTypeDictionary($this->resource->type)
            ];
        }
    }
    
```

### Validate request parameter

```

    $this->validate($request, [
        'cusomer_type' => ['required', new DictionaryRule(CustomerTypeDictionary::class)],
    ]);
    
```

## Running the tests

For testing purposes this library use PHPUnit. To run tests on your own execute the following command.

```
clone git@github.com:synortix/laravel-dictionary.git
cd laravel-dictionary
composer install
php vendor/bin/phpunit --bootstrap vendor/autoload.php tests/
```

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
