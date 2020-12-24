<?php

namespace  App\Helpers;

use Illuminate\Support\Facades\Config;

class Template {
    public static function showItemHistory($by, $time)
    {
        $xhtml = sprintf(
            '<p><i class="fa fa-user"></i> %s</p>
            <p><i class="fa fa-clock-o"></i> %s</p>', $by, date(Config::get('zvn.format.short_time'), strtotime($time)));
        return $xhtml;
    }

    public static function showItemStatus($controllerName, $id, $status) {
        $templateStatus = [
            'active' => ['name' =>'Active', 'class' => 'btn-success'],
            'inactive' => ['name' =>'Inactive', 'class' => 'btn-info'],
        ];

        $currentStatus = $templateStatus[$status];
        $link = route($controllerName . '/status', ['status' => $status, 'id' => $id]);

        $xhtml = sprintf(
            '<a href="%s" type="button" class="btn btn-round %s"> %s</a>', $link, $currentStatus['class'], $currentStatus['name']);
        return $xhtml;
    }

    public static function showItemThumb ($controllerName, $thumbName, $thumbAlt) {
        $xhtml = sprintf('<img src="%s" alt="%s" class="zvn-thumb"></p>', asset("images/$controllerName/$thumbName") , $thumbAlt);
        return $xhtml;
    }

    public static function showButtonAction($controllerName, $id)
    {
        $templateButton = [
            'edit' => [
                'class' => 'btn-success',
                'title' => 'Edit',
                'icon' => 'fa-pencil',
                'route-name' => $controllerName . '/form',
            ],
            'delete' => [
                'class' => 'btn-danger',
                'title' => 'Delete',
                'icon' => 'fa-trash',
                'route-name' => $controllerName . '/delete',
            ],
            'info' => [
                'class' => 'btn-info',
                'title' => 'View',
                'icon' => 'fa-info-circle',
                'route-name' => $controllerName . '/delete',
            ],
        ];

        $buttonInArea = [
            'default' => ['edit', 'delete'],
            'slider' => ['edit', 'delete'],
        ];

        $controller = array_key_exists($controllerName, $buttonInArea) ? $controllerName : 'default';
        $listButtons = $buttonInArea[$controller];
        $xhtml = '';
        foreach ($listButtons as $button) {
            $currentButton = $templateButton[$button];
            $link = route($currentButton['route-name'], ['id' => $id]);
            $xhtml .= sprintf('<a href="%s" type="button" class="btn btn-icon %s" data-toggle="tooltip" data-placement="top" data-original-title="%s">
                                    <i class="fa %s"></i></a>', $link, $currentButton['class'], $currentButton['title'], $currentButton['icon']);
        }

        return $xhtml;
    }

    public static function showButtonFilter($countByStatus) {
        $xhtml = sprintf('123');

        return $xhtml;
    }
}

