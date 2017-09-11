<?php

namespace TangoMan\MenuBundle\Twig\Extension;

class MenuExtension extends \Twig_Extension
{
    /**
     * @var \Twig_Environment
     */
    private $template;

    /**
     * MenuExtension constructor.
     *
     * @param \Twig_Environment $template
     */
    public function __construct(\Twig_Environment $template)
    {
        $this->template = $template;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tangoman_menu';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'menu', [$this, 'menuFunction'], ['is_safe' => ['html'],]
            ),
            new \Twig_SimpleFunction('multi_start_with', [$this, 'multiStartWithFunction']),
        ];
    }

    /**
     * @param string $template
     *
     * @return string
     */
    public function menuFunction($menu, $template = 'default')
    {
        $templates = [
            'default',
            'navbar',
            'tabs',
        ];

        if (in_array($template, $templates)) {
            $template = '@TangoManMenu/'.$template.'.html.twig';
        }

        if (is_string($menu)) {
            $menu = json_decode($menu);
        }

        return $this->template->render(
            $template,
            [
                'menu' => $menu,
            ]
        );
    }

    /**
     * Checks if at least one item from given items starts with route
     *
     * @param string $needle
     * @param array  $haystack
     *
     * @return bool
     */
    public function multiStartWithFunction($needle, $haystack = [])
    {
        if ($haystack == []) {
            return true;
        }

        if (in_array($needle, $haystack)) {
            return true;
        } else {
            foreach ($haystack as $item) {
                if (strpos($needle, $item) === 0) {
                    return true;
                }
            }
        }

        return false;
    }
}
