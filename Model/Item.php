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
     * Active item to be shown when route starts with or ends with
     * e.g: 'app_admin_user' or 'index'
     *
     * @var string
     */
    private $active;

    /**
     * Font icon
     * e.g: 'glyphicon glyphicon-user'
     *
     * @var string
     */
    private $icon;

    /**
     * Show divider
     *
     * @var bool
     */
    private $divider;

    /**
     * Show dropDown
     *
     * @var bool
     */
    private $dropDown;

    /**
     * Roles granted privilege to see item
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

        if ($this->active) {
            $json['active'] = $this->active;
        }

        if ($this->icon) {
            $json['icon'] = $this->icon;
        }

        if ($this->divider) {
            $json['divider'] = $this->divider;
        }

        if ($this->dropDown) {
            $json['dropDown'] = $this->dropDown;
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
