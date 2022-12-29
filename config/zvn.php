<?php

return [
    'url'              => [
        'prefix_admin' => 'admin123',
        'prefix_news'  => '/',
    ],
    'format'           => [
        'long_time'    => 'H:m:s d/m/Y',
        'short_time'   => 'd/m/Y',
    ],
    'template'         => [
        'form_input' => [
            'class' => 'form-control col-md-6 col-xs-12'
        ],
        'form_label' => [
            'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
        ],
        'form_label_edit' => [
            'class' => 'control-label col-md-4 col-sm-3 col-xs-12'
        ],
      
        'form_ckeditor' => [
            'class' => 'form-control col-md-6 col-xs-12 ckeditor'
        ],
        'status'       => [
            'all'      => ['name' => 'Tất cả', 'class' => 'btn-success'],
            'active'   => ['name' => 'Kích hoạt', 'class'      => 'btn-success'],
            'inactive' => ['name' => 'Chưa kích hoạt', 'class' => 'btn-info'],
            'block' => ['name' => 'Bị khóa', 'class' => 'btn-danger'],
            'contacted'    => ['name' => 'Đã liên lạc', 'class' => 'btn-success'],
            'uncontacted'  => ['name' => 'Chưa liên lạc', 'class' => 'btn-info'],
            'pending_payment'  => ['name' => 'Đang chờ thanh toán', 'class' => 'btn-info'],
            'unpaid'  => ['name' => 'Đơn hàng bị hủy (quá hạn thanh toán)', 'class' => 'btn-danger'],
            'paid'  => ['name' => 'Đã thanh toán', 'class' => 'btn-success'],
            'default'      => ['name' => 'Chưa xác định', 'class' => 'btn-success'],
        ],
        'is_home'       => [
            'yes'      =>  ['name'=> 'Hiển thị', 'class'=> 'btn-primary'],
            'no'        => ['name'=> 'Không hiển thị', 'class'=> 'btn-warning']
        ],
        'display'       => [
            'list'      => ['name'=> 'Danh sách'],
            'grid'      => ['name'=> 'Lưới'],
        ],
        'type' => [
            'featured'   => ['name'=> 'Nổi bật'],
            'normal'     => ['name'=> 'Bình thường'],
        ],
        'rss_source' => [
            'vnexpress'   => ['name'=> 'VNExpress'],
            'tuoitre'     => ['name'=> 'Tuổi Trẻ'],
        ],
        'type_menu' => [
            'link'   => ['name'=> 'Link'],
            'category_article'     => ['name'=> 'Danh mục bài viết'],
        ],
        'type_open_menu' => [
            'current'   => ['name'=> 'Trang hiện tại', 'class' => '_self'],
            'new_tab'     => ['name'=> 'Trang mới', 'class' => '_top'],
            'new_window'     => ['name'=> 'Cửa sổ mới', 'class' => '_blank'],
        ],
        'level'       => [
            'founder'      => ['name'=> 'Người sáng lập'],
            'admin'      => ['name'=> 'Quản trị hệ thống'],
            'member'      => ['name'=> 'Người dùng bình thường'],
        ],
        'status_payment' => [
            'pending_payment'  => ['name'=> 'Đang chờ thanh toán'],
            'unpaid' => ['name'=> 'Đơn hàng bị hủy (quá hạn thanh toán)'],
            'paid' => ['name'=> 'Đã thanh toán'],
        ],
        'search'       => [
            'all'           => ['name'=> 'Search by All'],
            'id'            => ['name'=> 'Search by ID'],
            'name'          => ['name'=> 'Search by Name'],
            'username'      => ['name'=> 'Search by Username'],
            'fullname'      => ['name'=> 'Search by Fullname'],
            'email'         => ['name'=> 'Search by Email'],
            'description'   => ['name'=> 'Search by Description'],
            'link'          => ['name'=> 'Search by Link'],
            'content'       => ['name'=> 'Search by Content'],
            'code'          => ['name'=> 'Search by Code'],
            'phone'          => ['name'=> 'Search by Phone'],
            'MaHD'          => ['name'=> 'Search by MaHD'],
            
        ],
        'button' => [
            'edit'      => ['class'=> 'btn-success' , 'title'=> 'Edit'      , 'icon' => 'fa-pencil' , 'route-name' => '/form'],
            'delete'    => ['class'=> 'btn-danger btn-delete'  , 'title'=> 'Delete'    , 'icon' => 'fa-trash'  , 'route-name' => '/delete'],
            'info'      => ['class'=> 'btn-info'    , 'title'=> 'View'      , 'icon' => 'fa-pencil' , 'route-name' => '/delete'],
        ]
            
    ],
    'config' => [
        'search' => [
            'default'   => ['all', 'id', 'fullname'],
            'slider'    => ['all', 'id', 'name', 'description', 'link'],
            'category'  => ['all', 'name'],
            'article'   => ['all', 'name', 'content'],
            'rss'       => ['all', 'name', 'link'],
            'user'      => ['all', 'username', 'email', 'fullname'],
            'product'   => ['all', 'name', 'code'],
            'order'     => ['all', 'name', 'email', 'phone', 'MaHD'],
        ],
        'button' => [
            'default'   => ['edit', 'delete'],
            'slider'    => ['edit', 'delete'],
            'category'  => ['edit', 'delete'],
            'article'   => ['edit', 'delete'],
            'rss'   => ['edit', 'delete'],
            'user'      => ['edit', 'delete'],
            'menu'      => ['edit', 'delete'],
            'contact'   => ['delete'],
            'product'   => ['edit', 'delete'],
            'order'   => ['edit', 'delete'],
            'userGroup'   => ['edit', 'delete'],
        ]
    ]
    
];