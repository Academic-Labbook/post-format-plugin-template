# Post format plugin template
Plugin template for defining a custom set of default blocks on new posts/pages/inventory.

## Usage
Do not use this plugin directly; it is intended to be customised for a particular logbook installation.
Instead, open up your favourite IDE and make some changes:

1. Decide on a 'slug' for your plugin. This is a namespace used for function names, constants, slugs,
   etc. in WordPress so that plugins do not interfere with each other. This plugin's slug is
   `ssl-post-template`, so for example you might want to just change the prefix `ssl` to something
   else like `abc-post-template`.
2. Replace the default `slug` with the one you decided to use above. Here we will assume you're using
   `abc-post-template`. (Hint: in Visual Studio Code, you can press `Ctrl+Shift+H` to open the replacement dialog). Ensure your searches are **case sensitive**.
    - Replace `ssl-post-template` with `abc-post-template` (slugs).
    - Replace `Ssl_Post_Template` with `Abc_Post_Template` (class names).
    - Replace `ssl_post_template` with `abc_post_template` (function names).
    - Replace `SSL_POST_TEMPLATE` with `ABC_POST_TEMPLATE` (constants).
4. Rename the `ssl-post-template.php` file to `abc-post-template.php`, and the `ssl-post-template`
   directory to `abc-post-template`.
5. Update the plugin metadata in the top (comment) section of `abc-post-template.php`. Set the
   name, URI, author, etc.

Once you've customised the plugin scaffolding, you can now customise the default post template
itself. The post template is entirely defined in the file `abc-post-template/includes/class-abc-post-template-post-templates.php`. The code in there by default defines a custom template
for the `ssl-alp-inventory` post type provided by Academic Labbook Plugin, specifically the function
`add_inventory_item_post_template`. The first line retrieves the object used by WordPress to
represent the post type:

```php
$post_type_object = get_post_type_object( 'ssl-alp-inventory' );
```

If you wish to customise a different post type, such as the (default WordPress) `post` or `page`
post types, then change `ssl-alp-inventory` to one of these.

This later line defines the blocks displayed by default on new `ssl-alp-inventory` posts:

```php
// Add template.
$post_type_object->template = array(
    array(
        'core/heading',
        array(
            'level'   => 2,
            'content' => 'Documentation',
        ),
    ),
    array(
        'core/heading',
        array(
            'level'   => 3,
            'content' => 'Schematic',
        ),
    ),
    array(
        'core/file',
        array(),
    ),
    array(
        'core/heading',
        array(
            'level'   => 3,
            'content' => 'Inputs and outputs',
        ),
    ),
    array(
        'core/paragraph',
        array(
            'placeholder' => 'Describe the item\'s inputs and outputs. Useful information to include could be for example signal type (single ended, differential, floating, etc.), input or output impedance (zero, 50Ω, infinite, etc.), maximum input/output voltage, etc.',
        ),
    ),
    array(
        'core/heading',
        array(
            'level'   => 2,
            'content' => 'Location',
        ),
    ),
    array(
        'core/paragraph',
        array(
            'placeholder' => 'Describe the item\'s location.',
        ),
    ),
    array(
        'core/heading',
        array(
            'level'   => 2,
            'content' => 'Notes',
        ),
    ),
    array(
        'core/paragraph',
        array(
            'placeholder' => 'Add any other pertinent information such as links to relevant posts, observations of strange behaviour, etc.',
        ),
    ),
);
```

Customise this array of arrays in any way you decide. Each array within the overall array should
have the block type (e.g. `core/paragraph`) first then another array of block settings second.

We are unaware of a good list of block types corresponding to the default WordPress block library,
but these can be found manually by searching for the block in the [Gutenberg source code](https://github.com/WordPress/gutenberg/tree/master/packages/block-library/src)
and finding the block type as defined in the `name` field of the block's `block.json` file.
[Here is the file for `core/code`](https://github.com/WordPress/gutenberg/blob/master/packages/block-library/src/code/block.json).

Once you are happy with the template, zip the top level directory `abc-post-template` and upload using WordPress's plugin page. You will
now find that the template you define is shown when you load the relevant post type.

## Credits

Sean Leavey  
<sean.leavey@ligo.org>
