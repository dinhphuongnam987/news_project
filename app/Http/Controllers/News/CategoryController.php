<?php

namespace App\Http\Controllers\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;;    

use App\Models\ArticleModel;
use App\Models\CategoryModel;

class CategoryController extends Controller
{
    private $pathViewController = 'news.pages.category.';  // slider
    private $controllerName     = 'category';
    private $params             = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {   
        $params["category_id"]  = $request->category_id;
        $articleModel  = new ArticleModel();
        $categoryModel = new CategoryModel();
        

        $itemCategory = $categoryModel->getItem($params, ['task' => 'news-get-item']);
        if(empty($itemCategory))  return redirect()->route('home');
        
        $itemsLatest   = $articleModel->listItems(null, ['task'  => 'news-list-items-latest']);
        $itemCategory['articles'] = $articleModel->listItems(['category_id' => $itemCategory['id']], ['task' => 'news-list-items-in-category']);
 
        return view($this->pathViewController .  'index', [
            'params'        => $this->params,
            'itemsLatest'   => $itemsLatest,
            'itemCategory'  => $itemCategory
        ]);
    }

 
}