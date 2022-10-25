<?php

namespace App\Http\Controllers\News;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    private $pathViewController = 'news.pages.gallery.';

    public function index()
    {   
        $title = 'Thư viện hình ảnh';
        $items = Storage::disk('gallery')->allFiles('gallery');
        $gallery = [];
        foreach($items as $key => $item) {
            if(!str_contains($item, 'thumb')) $gallery[$key] = $item;
        }
        return view($this->pathViewController .'index', [
            'title' => $title,
            'gallery' => $gallery
        ]);

    }
}