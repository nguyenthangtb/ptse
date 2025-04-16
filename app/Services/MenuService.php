<?php

namespace App\Services;

use Illuminate\Support\Collection;

class MenuService
{
    public function getMainMenu(): Collection
    {
        return collect([
            [
                'title' => 'Giới thiệu',
                'url' => '/gioi-thieu',
                'icon' => '',
                'target' => '_self',
                'children' => []
            ],
            [
                'title' => 'Sản phẩm',
                'url' => '/san-pham',
                'icon' => '',
                'target' => '_self',
                'children' => [
                    [
                        'title' => 'Bơm Grundfos',
                        'url' => '#',
                        'icon' => '',
                        'target' => '_self',
                        'children' => [
                        ]
                    ],
                    [
                        'title' => 'Van AVK',
                        'url' => '#',
                        'icon' => '',
                        'target' => '_self',
                        'children' => [
                        ]
                    ],
                    [
                        'title' => 'Van Ebro',
                        'url' => '#',
                        'icon' => '',
                        'target' => '_self',
                        'children' => []
                    ],
                    [
                        'title' => 'Van và đường ống +GF+',
                        'url' => '#',
                        'icon' => '',
                        'target' => '_self',
                        'children' => []
                    ],
                    [
                        'title' => 'Bơm định lượng kỹ thuật số',
                        'url' => '#',
                        'icon' => '',
                        'target' => '_self',
                        'children' => []
                    ],
                    [
                        'title' => 'Hệ thống Clo khử trùng',
                        'url' => '#',
                        'icon' => '',
                        'target' => '_self',
                        'children' => []
                    ],
                    [
                        'title' => 'Bơm tăng áp inline',
                        'url' => '#',
                        'icon' => '',
                        'target' => '_self',
                        'children' => []
                    ],
                    [
                        'title' => 'Phụ kiện',
                        'url' => '#',
                        'icon' => '',
                        'target' => '_self',
                        'children' => []
                    ],
                ]
            ],
            [
                'title' => 'Giải pháp',
                'url' => '/giai-phap',
                'icon' => '',
                'target' => '_self',
                'children' => []
            ],
            [
                'title' => 'Dự án',
                'url' => '/du-an',
                'icon' => '',
                'target' => '_self',
                'children' => []
            ],
            [
                'title' => 'Tin tức & Sự kiện',
                'url' => '/tin-tuc',
                'icon' => '',
                'target' => '_self',
                'children' => []
            ],
            [
                'title' => 'Liên hệ',
                'url' => '/lien-he',
                'icon' => '',
                'target' => '_self',
                'children' => []
            ]
        ])->map(function ($item) {
            return (object) array_map(function ($value) {
                return is_array($value) ? collect($value)->map(function ($subItem) {
                    return (object) array_map(function ($subValue) {
                        return is_array($subValue) ? collect($subValue)->map(function ($subSubItem) {
                            return (object) $subSubItem;
                        }) : $subValue;
                    }, $subItem);
                }) : $value;
            }, $item);
        });
    }
}
