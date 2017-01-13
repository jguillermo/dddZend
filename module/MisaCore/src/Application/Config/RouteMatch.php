<?php
/**
 * Aptitus Project
 *
 * This file demonstrates the rich information that can be included in
 * in-code documentation through DocBlocks and tags.
 *
 * @author Jose Guillermo <jguillermo@outlook.com>
 */

namespace MisaCore\Application\Config;

class RouteMatch
{
    private static $params;

    public static function set(array $params)
    {
        //'controller' => string 'Postulante\Controller\Home' (length=26)
        //'action' => string 'index' (length=5)

        $controller = explode('\\', $params['controller']);
        self::$params['module'] = $controller[0];
        self::$params['controller'] = str_replace("Controller", "", $controller[2]);
        self::$params['action'] = (isset($params['action'])) ? $params['action'] : '';
    }

    public static function setParam($key, $value)
    {
        self::$params[$key] = $value;
    }

    public static function get($key = null)
    {
        if (is_null($key)) {
            return self::$params;
        } else {
            return self::$params[$key];
        }
    }
}
