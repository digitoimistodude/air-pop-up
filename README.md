# Air pop up

You need Advanced Custom Fields PRO plugin installed to use this plugin.

Creates a custom post type for pop up and adds following ACF fields for it:
* Start time
* End time
* Show on page ( specifying certain pages to show the pop up on. Pop up will be shown on all pages if nothing is selected )
* Show again ( when to show pop up again )
* Interval to show pop up again ( if specific show on is selected )
* Delay
* Title of the pop up
* Content of the pop up

## Adding pop up to template

In order to show pop up on your page, you need to call it in your template. This is done by adding the following action to your template. Even though you can freely choose where to add pop up, location such as footer is preferred. 

```php
  do_action( 'air_pop_up_show_pop_up' );
```

## Disabling default pop up css

If you want to use the default pop up template, but dont want to load its css, you can disable it.

```php
  add_filter( 'air_pop_up_disable_css', '__return_true' );
```

## Adding custom post types to show on page select

If you want to show a pop up on your custom post type page, you need to add the post type via a hook to 

To be able to show pop up on your specific custom post type page, you need to add your custom post type to show on page field selection choices via a hook.

```php
  add_filter( 'air_pop_up_show_on_locations', function( $locations ) {
    $locations[] = 'your-custom-post-type';
    return $locations;
  });
```

## Custom pop up template

Default pop up template can be replaced by your own custom one. You will need to name it like `pop-up-template-default.php`. This template needs to be saved in `yourtheme/templates`.

In these templates you have access to the pop up data by `$pop_up` variable.

In order to make pop up work properly you have to include these in your template:
* Make sure your main wrapper by default has `display: none`, this to prevent the pop up from appearing and then disappearing if it had already been closed before. Pop up visibility is controlled by class 'visible'.
* Add class `air-pop-up` to your main wrapper
* Add data attribute `data-pop-up-id` to your main wrapper. Value for this should be unique since it will be saved in the users localstorage, when closing a pop up. `$pop_up['guid']` is created just for this use.
* You can add custom pop up closing elements by assigning class 'pop-up-close' to them.

### Adding custom data

By default Air pop up comes with fields for a heading and text content, optional link and yes/no choice. You can add more fields by adding additional ACF fields to your theme. When done with adding fields, show them in custom location called 'Air Pop up additional fields'. Now you should see them when editing a pop up. Custom field data can be accessed in the template like any other data by referencing the new custom field name.

## Statistics
Since 1.1.0

Pop up statistics can be accessed in the admin area. To get statistics working with a custom template, add class names to the elements you want to track like this:
Track link clicks: `air-pop-up-link
Track "yes" choice: `air-pop-up-yes`
Track "no" choice: `air-pop-up-no`

View count is updated every time a pop up is shown, and works with just the `air-pop-up` class on the main wrapper.

