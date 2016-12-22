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

Before any configuration you need to create an account on the netreviews platform.

Then you need to configure this modules here http://yourdomain.com/admin/module/NetReviews
"Id website" and "Secret token" can be found in your platform account.

## Hook

```main.footer-bottom``` is used to display a link to your site review page

But of you want change the place of the link you can disable precedent hook and add the ```netreviews.footer.link``` where you want

```main.body-top``` is used to display the site widget

But of you want change the place of the widget you can disable precedent hook and add the ```netreviews.site.widget``` where you want

```product.additional``` is used to display the product widget

But of you want change the place of the widget you can disable precedent hook and add the ```netreviews.product.iframe``` where you want
