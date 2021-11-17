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

## Todo
At the moment, link URLs within the following types of blocks are rendered as **absolute URLs** when used in the ModernGov template page:
- block_content
- system_menu_block
- localgov_alert_banner_block

If the ModernGov template page uses any other block and that block has relative URLs embedded in it, those link URLs won't change to absolute URLs.  To modify link URLs within **all** blocks used in the ModernGov template page, the above block list needs to become configurable through the module configuration form at /admin/config/content/moderngov/settings.
