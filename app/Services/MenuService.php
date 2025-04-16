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
                        'url' => '/san-pham/bom-grundfos',
                        'icon' => '',
                        'target' => '_self',
                        'children' => [
                        ]
                    ],
                    [
                        'title' => 'Van AVK',
                        'url' => '/san-pham/van-avk',
                        'icon' => '',
                        'target' => '_self',
                        'children' => [
                        ]
                    ],
                    [
                        'title' => 'Van Ebro',
                        'url' => '/san-pham/van-ebro',
                        'icon' => '',
                        'target' => '_self',
                        'children' => []
                    ],
                    [
                        'title' => 'Van và đường ống +GF+',
                        'url' => '/san-pham/van-va-duong-ong-gf',
                        'icon' => '',
                        'target' => '_self',
                        'children' => []
                    ],
                    [
                        'title' => 'Bơm định lượng kỹ thuật số',
                        'url' => '/san-pham/bom-dinh-luong-ky-thuat-so',
                        'icon' => '',
                        'target' => '_self',
                        'children' => []
                    ],
                    [
                        'title' => 'Hệ thống Clo khử trùng',
                        'url' => '/san-pham/he-thong-clo-khutrung',
                        'icon' => '',
                        'target' => '_self',
                        'children' => []
                    ],
                    [
                        'title' => 'Bơm tăng áp inline',
                        'url' => '/san-pham/bom-tang-ap-inline',
                        'icon' => '',
                        'target' => '_self',
                        'children' => []
                    ],
                    [
                        'title' => 'Phụ kiện',
                        'url' => '/san-pham/phu-kien',
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
