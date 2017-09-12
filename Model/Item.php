<?php

namespace TangoMan\MenuBundle\Model;

use TangoMan\MenuBundle\Model\Menu;

/**
 * Class Item
 *
 * @package TangoMan\MenuBundle\Model
 */
class Item implements \JsonSerializable
{
    /**
     * Font icon
     * e.g: 'glyphicon glyphicon-user'
     *
     * @var string
     */
    private $icon;

    /**
     * Label to be displayed
     *
     * @var string
     */
    private $label;

    /**
     * Hyperlink route
     * e.g: 'app_admin_user_index'
     *
     * @var string
     */
    private $route;

    /**
     * Pass callback link with route parameters
     *
     * @var boolean
     */
    private $callback;

    /**
     * Pass target id with route parameters
     *
     * @var integer
     */
    private $id;

    /**
     * Pass target slug with route parameters
     *
     * @var string
     */
    private $slug;

    /**
     * Pages that should display item
     * e.g: 'homepage'
     *
     * @var array
     */
    private $pages = [];

    /**
     * data-toggle attribute
     * e.g: modal
     *
     * @var string
     */
    private $toggle;

    /**
     * data-target attribute
     * e.g: myModal
     *
     * @var string
     */
    private $target;

    /**
     * Current page internal anchor (without #)
     *
     * @var string
     */
    private $anchor;

    /**
     * Active item to be shown when route starts with or ends with
     * e.g: 'app_admin_user' or 'index'
     *
     * @var string
     */
    private $active;

    /**
     * Show divider
     *
     * @var bool
     */
    private $divider;

    /**
     * Roles granted privilege to see item
     * (null = no restrictions)
     * e.g: ['ROLE_ADMIN', 'ROLE_SUPER_ADMIN']
     *
     * @var array
     */
    private $roles = [];

    /**
     * Link submenu
     *
     * @var Menu
     */
    private $subMenu;

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param string $route
     *
     * @return $this
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * @param array $pages
     *
     * @return $this
     */
    public function setPages($pages)
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * @return array $pages
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param string $page
     *
     * @return bool
     */
    public function hasPage($page)
    {
        if (in_array($page, $this->pages)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $page
     *
     * @return $this
     */
    public function addPage($page)
    {
        if (!$this->hasPage($page)) {
            $this->pages[] = $page;
        }

        return $this;
    }

    /**
     * @param string $page
     *
     * @return $this
     */
    public function removePage($page)
    {
        $pages = $this->pages;

        if ($this->hasPage($page)) {
            $remove[] = $page;
            $this->pages = array_diff($pages, $remove);
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isCallback()
    {
        return $this->callback;
    }

    /**
     * @param bool $callback
     *
     * @return Item
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Item
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     *
     * @return Item
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     */
    public function getToggle()
    {
        return $this->toggle;
    }

    /**
     * @param string $toggle
     *
     * @return Item
     */
    public function setToggle($toggle)
    {
        $this->toggle = $toggle;

        return $this;
    }

    /**
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param string $target
     *
     * @return Item
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * @return string
     */
    public function getAnchor()
    {
        return $this->anchor;
    }

    /**
     * @param string $anchor
     *
     * @return Item
     */
    public function setAnchor($anchor)
    {
        $this->anchor = $anchor;

        return $this;
    }

    /**
     * @return string
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param string $active
     *
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     *
     * @return $this
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDivider()
    {
        return $this->divider;
    }

    /**
     * @param bool $divider
     *
     * @return $this
     */
    public function setDivider($divider)
    {
        $this->divider = $divider;

        return $this;
    }

    /**
     * @param array $roles
     *
     * @return $this
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return array $roles
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param string $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        if (in_array($role, $this->roles)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $role
     *
     * @return $this
     */
    public function addRole($role)
    {
        if (!$this->hasRole($role)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    /**
     * @param string $role
     *
     * @return $this
     */
    public function removeRole($role)
    {
        $roles = $this->roles;

        if ($this->hasRole($role)) {
            $remove[] = $role;
            $this->roles = array_diff($roles, $remove);
        }

        return $this;
    }

    /**
     * @return Menu
     */
    public function getSubMenu()
    {
        return $this->subMenu;
    }

    /**
     * @param Menu $subMenu
     *
     * @return $this
     */
    public function setSubMenu(Menu $subMenu)
    {
        $this->subMenu = $subMenu;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $json = [];
        if ($this->label) {
            $json['label'] = $this->label;
        }

        if ($this->route) {
            $json['route'] = $this->route;
        }

        if (count($this->pages)) {
            $json['pages'] = json_encode($this->pages);
        }

        if ($this->active) {
            $json['active'] = $this->active;
        }

        if ($this->icon) {
            $json['icon'] = $this->icon;
        }

        if ($this->divider) {
            $json['divider'] = $this->divider;
        }

        if (count($this->roles)) {
            $json['roles'] = json_encode($this->roles);
        }

        if ($this->subMenu) {
            $json['subMenu'] = $this->subMenu->jsonSerialize();
        }

        return $json;
    }
}
