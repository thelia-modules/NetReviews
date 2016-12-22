# NetReviews

This module allow to use verified reviews for your site and product with the platform http://www.verified-reviews.com/
The module send order to the platform and get reviews.

## Installation

### Manually

* Copy the module into ```<thelia_root>/local/modules/``` directory and be sure that the name of the module is NetReviews.
* Activate it in your thelia administration panel

### Composer

Add it in your main thelia composer.json file

```
composer require thelia-modules/netreviews-module:~1.0
```

## Usage

Before any configuration you need to create an account on the platform
Then you need to configure this modules here http://yourdomain.com/admin/module/NetReviews
"Id website" and "Secret token" can be found in your platform account 

## Hook

``main.footer-bottom``` is used to display a link to your site review page
main.body-top is used to display the site widget
product.additional is used to display the product widget


## Loop

If your module declare one or more loop, describe them here like this :

[loop name]

### Input arguments

|Argument |Description |
|---      |--- |
|**arg1** | describe arg1 with an exemple. |
|**arg2** | describe arg2 with an exemple. |

### Output arguments

|Variable   |Description |
|---        |--- |
|$VAR1    | describe $VAR1 variable |
|$VAR2    | describe $VAR2 variable |

### Exemple

Add a complete exemple of your loop

## Other ?

If you have other think to put, feel free to complete your readme as you want.
