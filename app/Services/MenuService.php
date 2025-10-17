<?php

namespace App\Services;

use Illuminate\Support\Collection;

class MenuService
{
    public function getMainMenu(): Collection
    {
        return collect([
            [
                'title' => __('common.home'),
                'url' => '/',
                'icon' => '',
                'target' => '_self',
                'children' => []
            ],
            [
                'title' => __('common.about'),
                'url' => '/gioi-thieu',
                'icon' => '',
                'target' => '_self',
                'children' => []
            ],
            [
                'title' => __('common.products'),
                'url' => '/san-pham',
                'icon' => '',
                'target' => '_self',
                'children' => [
                    [
                        'title' => __('common.bom_cong_nghiep'),
                        'url' => '/san-pham/danh-muc/bom-cong-nghiep',
                        'icon' => '',
                        'target' => '_self',
                        'children' => []
                    ],
                    [
                        'title' => __('common.bom_thoat_nuoc_chong_ngap_tuoi'),
                        'url' => '/san-pham/danh-muc/bom-thoat-nuoc-chong-ngap-tuoi-tieu',
                        'icon' => '',
                        'target' => '_self',
                        'children' => []
                    ],
                    [
                        'title' => __('common.pump_tang_ap_inline'),
                        'url' => '/san-pham/danh-muc/bom-tang-ap-inline',
                        'icon' => '',
                        'target' => '_self',
                        'children' => []
                    ],
                    [
                        'title' => __('common.pump_grundfos'),
                        'url' => '/san-pham/danh-muc/bom-dinh-luong',
                        'icon' => '',
                        'target' => '_self',
                        'children' => []
                    ],
                    [
                        'title' => __('common.he_thong_clo_khu_trung'),
                        'url' => '/san-pham/danh-muc/he-thong-khu-trung-clo',
                        'icon' => '',
                        'target' => '_self',
                        'children' => []
                    ],
                    [
                        'title' => __('common.van_avk'),
                        'url' => '/san-pham/danh-muc/van-avk',
                        'icon' => '',
                        'target' => '_self',
                        'children' => [
                        ]
                    ],
                    [
                        'title' => __('common.van_ebro'),
                        'url' => '/san-pham/danh-muc/van-ebro',
                        'icon' => '',
                        'target' => '_self',
                        'children' => []
                    ],
                    // [
                    //     'title' => __('common.van_xa_khi'),
                    //     'url' => '/san-pham/danh-muc/van-xa-khi',
                    //     'icon' => '',
                    //     'target' => '_self',
                    //     'children' => []
                    // ],
                    // [
                    //     'title' => __('common.van_va_duong_ong_g_f_plus'),
                    //     'url' => '#',
                    //     'icon' => '',
                    //     'target' => '_self',
                    //     'children' => []
                    // ],
                    // [
                    //     'title' => __('common.pump_dinh_luong_ky_thuat_so'),
                    //     'url' => '#',
                    //     'icon' => '',
                    //     'target' => '_self',
                    //     'children' => []
                    // ],
                    // [
                    //     'title' => __('common.pump_tang_ap_inline'),
                    //     'url' => '#',
                    //     'icon' => '',
                    //     'target' => '_self',
                    //     'children' => []
                    // ],
                    [
                        'title' => __('common.phu_kien'),
                        'url' => '/san-pham/danh-muc/phu-kien-thiet-bi-moi-khac',
                        'icon' => '',
                        'target' => '_self',
                        'children' => []
                    ],
                ]
            ],
            [
                'title' => __('common.services'),
                'url' => '/dich-vu',
                'icon' => '',
                'target' => '_self',
                'children' => []
            ],
            [
                'title' => __('common.giai_phap'),
                'url' => '/giai-phap',
                'icon' => '',
                'target' => '_self',
                'children' => []
            ],
            [
                'title' => __('common.du_an'),
                'url' => '/du-an',
                'icon' => '',
                'target' => '_self',
                'children' => []
            ],
            [
                'title' => __('common.tin_tuc_va_su_kien'),
                'url' => '/tin-tuc',
                'icon' => '',
                'target' => '_self',
                'children' => []
            ],
            [
                'title' => __('common.careers'),
                'url' => '/tuyen-dung',
                'icon' => '',
                'target' => '_self',
                'children' => []
            ],
            [
                'title' => __('common.lien_he'),
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
