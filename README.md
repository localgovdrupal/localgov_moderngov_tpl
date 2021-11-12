Drupal module for [ModernGov](http://www.civica.com/moderngov) template page generation.

## Configuration
Select an existing node to serve as the ModernGov template page from the *Configuration > Content authoring > ModernGov template* menu item (/admin/config/content/moderngov/settings).  Later provide the **path alias** of this node to ModernGov.

## Features
The configured page, when viewed as an anonymous user, displays the following ModernGov tokens:
- ```{pagetitle}``` instead of the actual Drupal page title.
- ```{breadcrumb}``` instead of the Drupal breadcrumb.
- ```{content}``` instead of the page content.
- ```{sidenav}``` instead of the second sidebar.

Both link and asset URLs in the page are rendered as absolute URLs.

## Good to know
- Relative URLs **hardcoded** in theme templates or blocks **cannot** be rendered as absolute URLs.
- [ModernGov test URL](https://reversecms.moderngov.co.uk/).  This is behind HTTP authentication.
