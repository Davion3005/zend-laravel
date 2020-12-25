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
        $templateStatus = Config::get('zvn.template.status');
        $statusValue = array_key_exists($status, $templateStatus) ? $status : 'default';
        $currentTemplateStatus = $templateStatus[$statusValue];
        $link = route($controllerName . '/status', ['status' => $status, 'id' => $id]);

        $xhtml = sprintf(
            '<a href="%s" type="button" class="btn btn-round %s"> %s</a>', $link, $currentTemplateStatus['class'], $currentTemplateStatus['name']);
        return $xhtml;
    }

    public static function showItemThumb ($controllerName, $thumbName, $thumbAlt) {
        $xhtml = sprintf('<img src="%s" alt="%s" class="zvn-thumb"></p>', asset("images/$controllerName/$thumbName") , $thumbAlt);
        return $xhtml;
    }

    public static function showButtonAction($controllerName, $id)
    {
        $templateButton = Config::get('zvn.template.button');

        $buttonInArea = Config::get('zvn.config.button', 'default');

        $controller = array_key_exists($controllerName, $buttonInArea) ? $controllerName : 'default';
        $listButtons = $buttonInArea[$controller];
        $xhtml = '';
        foreach ($listButtons as $button) {
            $currentButton = $templateButton[$button];
            $link = route($controller . $currentButton['route-name'], ['id' => $id]);
            $xhtml .= sprintf('<a href="%s" type="button" class="btn btn-icon %s" data-toggle="tooltip" data-placement="top" data-original-title="%s">
                                    <i class="fa %s"></i></a>', $link, $currentButton['class'], $currentButton['title'], $currentButton['icon']);
        }

        return $xhtml;
    }

    public static function showButtonFilter($controllerName, $itemsStatusCount, $currentFilterStatus) {
        $xhtml = null;
        $templateStatus = Config::get('zvn.template.status');
        if (count($itemsStatusCount) > 0) {
            array_unshift($itemsStatusCount, [
                'count' => array_sum(array_column($itemsStatusCount, 'count')),
                'status' => 'all',
            ]);
            foreach ($itemsStatusCount as $item) {
                $statusValue = array_key_exists($item['status'], $templateStatus) ? $item['status'] : 'default';
                $currentTemplateStatus = $templateStatus[$statusValue];
                $link = route($controllerName) . "?filter_status=" . $statusValue;
                $class = ($currentFilterStatus == $statusValue) ? 'btn-primary' : 'btn-info';

                $xhtml .= sprintf('<a href="%s" type="button" class="btn %s">%s <span class="badge bg-white">%s</span></a>', $link, $class, $currentTemplateStatus['name'], $item['count']);
            }

        }

        return $xhtml;
    }

    public static function showSearchArea($controllerName, $params) {
        $xhtml = null;
        $templateField = Config::get('zvn.template.search');
        $fieldInController = Config::get('zvn.config.search');
        $searchValue = $params['search_value'];
        $searchField = in_array($params['search_field'], $fieldInController[$controllerName]) ? $params['search_field'] : 'all';
        $controllerName = array_key_exists($controllerName, $fieldInController) ? $controllerName : 'default';
        $xhtmlField = null;
        foreach ($fieldInController[$controllerName] as $field) {
            $xhtmlField .= sprintf('<li><a href="#" class="select-field" data-field="%s">%s</a></li>', $field, $templateField[$field]['name']);
        }
        $xhtml = sprintf('<div class="input-group">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle btn-active-field"
                                            data-toggle="dropdown" aria-expanded="false">%s <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">%s</ul>
                                    </div>
                                    <input type="text" class="form-control" name="search_value" value="%s">
                                    <input type="hidden" name="search_field" value="all">
                                    <span class="input-group-btn">
                                        <button id="btn-clear-search" type="button" class="btn btn-success"
                                                style="margin-right: 0px">Xóa tìm kiếm</button>
                                        <button id="btn-search" type="button" class="btn btn-primary">Tìm kiếm</button>
                                    </span>
                                </div>', $templateField[$searchField]['name'], $xhtmlField, $searchValue);

        return $xhtml;
    }
}




