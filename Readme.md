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
composer require thelia/netreviews-module:~1.1.3
```

## Usage

Before any configuration you need to create an account on the netreviews platform.

Then you need to configure this modules here http://yourdomain.com/admin/module/NetReviews
"Id website" and "Secret token" can be found in your platform account.

You also need to fill the thelia variable "url_site" here "/admin/configuration/variables" with your domain name.

### Sending orders to Netreviews
If you want to automate the sending of orders to netreviews there is a cron for it, just call this commands : ```php Thelia module:NetReviews:SendOrder``` 
it will send all order in queue (all orders created when this module is active) to netreviews.

If you want to do it manually there is a button at the bottom of back office order page who send directly the order.

## Hook

```main.footer-bottom``` is used to display a link to your site review page

But of you want change the place of the link you can disable precedent hook and add the ```netreviews.footer.link``` where you want

```main.body-top``` is used to display the site widget

But of you want change the place of the widget you can disable precedent hook and add the ```netreviews.site.widget``` where you want

```product.additional``` is used to display the product widget

But of you want change the place of the widget you can disable precedent hook and add the ```netreviews.product.iframe``` where you want

## To Do 
Retrieve products reviews by xml files