<?php

namespace TangoMan\MenuBundle\Model;

use TangoMan\MenuBundle\Model\Item;

/**
 * Class Menu
 *
 * @package TangoMan\MenuBundle\Model
 */
class Menu implements \JsonSerializable
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
     * Base64 logo
     *
     * @var string
     */
    private $logo;

    /**
     * Font icon
     * e.g: 'glyphicon glyphicon-user'
     *
     * @var string
     */
    private $icon;

    /**
     * Roles granted privilege to see menu
     * e.g: ['ROLE_ADMIN', 'ROLE_SUPER_ADMIN']
     *
     * @var array
     */
    private $roles = [];

    /**
     * @var array
     */
    private $items = [];

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
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     *
     * @return $this
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

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
     * @param array $items
     *
     * @return $this
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return array $items
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param \TangoMan\MenuBundle\Model\Item $item
     *
     * @return bool
     */
    public function hasItem(Item $item)
    {
        if (in_array($item, $this->items)) {
            return true;
        }

        return false;
    }

    /**
     * @param \TangoMan\MenuBundle\Model\Item $item
     *
     * @return $this
     */
    public function addItem(Item $item)
    {
        if (!$this->hasItem($item)) {
            $this->items[] = $item;
        }

        return $this;
    }

    /**
     * @param \TangoMan\MenuBundle\Model\Item $item
     *
     * @return $this
     */
    public function removeItem(Item $item)
    {
        $items = $this->items;

        if ($this->hasItem($item)) {
            $remove[] = $item;
            $this->items = array_diff($items, $remove);
        }

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

        if ($this->logo) {
            $json['logo'] = $this->logo;
        }

        if ($this->icon) {
            $json['icon'] = $this->icon;
        }

        if (count($this->roles)) {
            $json['roles'] = json_encode($this->roles);
        }

        $items = [];
        foreach ($this->items as $item) {
            $items[] = $item->jsonSerialize();
        }

        if ($this->items) {
            $json['items'] = $this->items->jsonSerialize();
        }

        return $json;
    }
}
