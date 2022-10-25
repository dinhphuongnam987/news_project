@php 
    use App\Models\MenuModel;
    use App\Models\CategoryModel as CategoryModel;
    use App\Helpers\URL;

    $menuModel = new MenuModel();
    $itemsMenu  = $menuModel->listItems(null, ['task' => 'news-list-items']);
    $categoryModel = new CategoryModel();
    $itemsCategory = $categoryModel->listItems(null, ['task' => 'news-list-items']);

    $xhtmlMenu = '';
    $xhtmlMenuMobile = '';
    $link = '';

    if (count($itemsMenu) > 0) {
        
        $xhtmlMenu = '<nav class="main_nav"><ul class="main_nav_list d-flex flex-row align-items-center justify-content-start">';
        $xhtmlMenuMobile = '<nav class="menu_nav"><ul class="menu_mm">';

        foreach ($itemsMenu as $item) {
            $link = $item['link'];
            $typeOpen = config('zvn.template.type_open_menu')[$item['type_open']]['class'];

            $xhtmlMenu .= sprintf('<li><a href="%s" target="%s">%s</a>', $link, $typeOpen, $item['name']);
            $xhtmlMenuMobile .= sprintf('<li class="menu_mm"><a href="%s">%s</a>', $link, $item['name']);

            if($item['type_menu']  == 'category_article') {
                $xhtmlMenu .= '<i class="fa fa-caret-down btn-drop-down"></i>'; 
                $xhtmlMenu .= '<div class="sub_menu">'; 
                $xhtmlMenuMobile .= '<i class="fa fa-caret-down btn-drop-down"></i>'; 
                $xhtmlMenuMobile .= '<div class="sub_menu">'; 

                foreach ($itemsCategory as $category) {
                    $categoryIdCurrent = Route::input('category_id');
                    $link       =  URL::linkCategory($category['id'], $category['name']);
                    $classActive = ($categoryIdCurrent == $category['id']) ? 'class="active"' : '';

                    $xhtmlMenu .= sprintf('<a href="%s">%s</a>', $link, $category['name']);
                    $xhtmlMenuMobile .= sprintf('<a href="%s">%s</a>', $link, $category['name']);
                }   
                $xhtmlMenu .= '</div>';
                $xhtmlMenuMobile .= '</div>';
            }

            $xhtmlMenu .= '</li>';
            $xhtmlMenuMobile .= '</li>';
        }

        $xhtmlMenu .= sprintf('<li><a href="%s">Tin tức tổng hợp</a></li>', route('rss/index'));
        $xhtmlMenuMobile .= sprintf('<li class="menu_mm"><a href="%s">Tin tức tổng hợp</a></li>', route('rss/index'));
        $xhtmlMenu .= sprintf('<li><a href="%s">Thư viện hình ảnh</a></li>', route('gallery/index'));
        $xhtmlMenuMobile .= sprintf('<li class="menu_mm"><a href="%s">Thư viện hình ảnh</a></li>', route('gallery/index'));

        if (session('userInfo')) {
            $xhtmlMenuUser = sprintf('<li><a href="%s">%s</a></li>', route('auth/logout'), 'Logout');
        }else {
            $xhtmlMenuUser = sprintf('<li><a href="%s">%s</a></li>', route('auth/login'), 'Login');
        }

        $xhtmlMenu .= $xhtmlMenuUser . '</ul></nav>';
        $xhtmlMenuMobile .= $xhtmlMenuUser . '</ul></nav>';
    }

@endphp

<header class="header">

    <!-- Header Content -->
    <div class="header_content_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justfy-content-start">
                        <div class="logo_container">
                            <a href="{!! route('home') !!}">
                                <div class="logo"><span>ZEND</span>VN</div>
                            </a>
                        </div>
                        <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start">
                            <a href="#">
                                <div class="background_image" style="background-image:url({{asset('news/images/zendvn-online.png') }});background-size: contain"></div>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Navigation & Search -->
    <div class="header_nav_container" id="header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_nav_content d-flex flex-row align-items-center justify-content-start">
                        
                        <!-- Logo -->
                        <div class="logo_container">
                            <a href="#">
                                <div class="logo"><span>ZEND</span>VN</div>
                            </a>
                        </div>

                        <!-- Navigation -->
                        {!! $xhtmlMenu !!}

                        <!-- Hamburger -->
                        <div class="hamburger ml-auto menu_mm"><i class="fa fa-bars  trans_200 menu_mm" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>		
    </div>
</header>

<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
    <div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>

    {!! $xhtmlMenuMobile !!}
    
    
</div>