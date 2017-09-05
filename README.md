TangoMan Menu Bundle
====================

**TangoMan Menu Bundle** provides an easy way to include menus in twig.
**TangoMan Menu Bundle** makes building back-office for your app a brease.

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require tangoman/menu-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    // ...

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new TangoMan\MenuBundle\TangoManMenuBundle(),
        );

        // ...
    }
}
```

Step 3: Place use statement in the controller
---------------------------------------------

```php
use TangoMan\MenuBundle\Model\Item;
use TangoMan\MenuBundle\Model\Menu;
```

Step 4: Build object in the controller
--------------------------------------

```php
<?php
// AppBundle/Controller/DefaultController.php
namespace AppBundle\Controller;

// ...

class DefaultController extends Controller
{
    /**
     * @Route("/user/index")
     */
    public function indexAction()
    {
        // ...

        $menu = new Menu();

        $item = new Item();
        $item->setLabel('Tableau de bord')
            ->setRoute('app_admin_admin_index')
            ->setIcon('glyphicon glyphicon-dashboard');
        $menu->addItem($item);

        $item = new Item();
        $item->setDivider(true);
        $menu->addItem($item);

        $item = new Item();
        $item->setLabel('Articles')
            ->setRoute('app_admin_post_index')
            ->setIcon('glyphicon glyphicon-text-color');
        $menu->addItem($item);

        $item = new Item();
        $item->setLabel('Commentaires')
            ->setRoute('app_admin_comment_index')
            ->setIcon('glyphicon glyphicon-comment');
        $menu->addItem($item);

        $item = new Item();
        $item->setDivider(true);
        $menu->addItem($item);

        $item = new Item();
        $item->setLabel('Utilisateurs')
            ->setRoute('app_admin_user_index')
            ->setIcon('glyphicon glyphicon-user');
        $menu->addItem($item);

        // You can use json format as well

        $navbar = '{
            "label": "TangoMan",
            "route": "homepage",
            "icon": "fa fa-car",
            "items": [
                {
                    "label": "Blog",
                    "route": "app_posts_index"
                },
                {
                    "subMenu": {
                        "label": "Administration",
                        "icon": "fa fa-cogs",
                        "roles": ["ROLE_ADMIN"],
                        "items": [
                            {
                                "label": "User",
                                "icon": "fa fa-users",
                                "route": "admin_user_index",
                                "active": "admin_user_index"
                            },
                            {
                                "divider": true
                            },
                            {
                                "label": "Comments",
                                "icon": "fa fa-comments",
                                "route": "admin_comment_index",
                                "active": "admin_comment_index"
                            }
                        }
                    }
                }
            ]
        }';

        $tabs = '{
            "items": [
                {
                    "label": "List",
                    "route": "app_admin_user_index",
                    "active": "index",
                    "icon": "glyphicon glyphicon-list"
                },
                {
                    "label": "Add",
                    "route": "app_admin_user_new",
                    "active": "new",
                    "icon": "glyphicon glyphicon-plus"
                },
                {
                    "label": "Import",
                    "route": "app_admin_user_import",
                    "active": "import",
                    "icon": "glyphicon glyphicon-import"
                },
                {
                    "label": "Export",
                    "route": "app_admin_user_export",
                    "active": "export",
                    "icon": "glyphicon glyphicon-export"
                }
            ]
        }';

        return $this->render(
            'user/index.html.twig',
            [
                'navbar' => $menu,
                'menu' => $menu,
                'tabs' => $tabs,
                'users' => $users,
            ]
        );
    }
}
```

Step 5: Integrate in Twig
-------------------------

```twig
<div class="container">
    {{ menu(menu, 'navbar') }}
</div>
```

```twig
<div id="sidebar-menu" class="col-xs-12 col-sm-2">
    {{ menu(menu) }}
</div>
```

```twig
<div id="tabs">
    {{ menu(menu, 'tabs') }}
</div>
```

Note
====

If you find any bug please report here : [Issues](https://github.com/TangoMan75/MenuBundle/issues/new)

License
=======

Copyrights (c) 2017 Matthias Morin

[![License][license-GPL]][license-url]
Distributed under the GPLv3.0 license.

If you like **TangoMan Menu Bundle** please star!
And follow me on GitHub: [TangoMan75](https://github.com/TangoMan75)
... And check my other cool projects.

[tangoman.free.fr](http://tangoman.free.fr)

[license-GPL]: https://img.shields.io/badge/Licence-GPLv3.0-green.svg
[license-MIT]: https://img.shields.io/badge/Licence-MIT-green.svg
[license-url]: LICENSE
