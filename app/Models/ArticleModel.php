<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ArticleModel extends AdminModel
{
    public function __construct()
    {
        $this->table               = 'article as a';
        $this->folderUpload        = 'article';
        $this->fieldSearchAccepted = ['name', 'content'];
        $this->crudNotAccepted     = ['_token', 'thumb_current'];
    }

    public function listItems($params = null, $options = null)
    {

        $result = null;

        if ($options['task'] == "admin-list-items") {
            $query = $this->select('a.id', 'a.name', 'a.status', 'a.content', 'a.thumb', 'a.type', 'c.name as category_name', 'c.id as category_id', 'c.parent_id as category_parent')
                ->join('category as c', 'a.category_id', '=', 'c.id');


            if ($params['filter']['status'] !== "all") {
                $query->where('a.status', '=', $params['filter']['status']);
            }

            if ($params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere('a.' . $column, 'LIKE',  "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where('a.' . $params['search']['field'], 'LIKE',  "%{$params['search']['value']}%");
                }
            }

            if(!empty($params['filter']['category']) && $params['filter']['category'] !== "all") {
                $query->where(function ($query) use ($params) {
                    $query->where('c.id', $params['filter']['category'])
                          ->orWhere('c.parent_id', $params['filter']['category']);
                });
            }

            $result =  $query->orderBy('a.id', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }

        if ($options['task'] == 'news-list-items') {
            $query = $this->select('id', 'name', 'thumb')
                ->where('status', '=', 'active')
                ->limit(5);

            $result = $query->get()->toArray();
        }

        if ($options['task'] == 'news-list-items-featured') {

            $query = $this->select('a.id', 'a.name', 'a.content', 'a.created', 'a.category_id', 'c.name as category_name', 'a.thumb')
                ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
                ->where('a.status', '=', 'active')
                ->where('a.type', 'featured')
                ->orderBy('a.id', 'desc')
                ->take(3);

            $result = $query->get()->toArray();
        }


        if ($options['task'] == 'news-list-items-latest') {

            $query = $this->select('a.id', 'a.name', 'a.created', 'a.category_id', 'c.name as category_name', 'a.thumb')
                ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
                ->where('a.status', '=', 'active')
                ->orderBy('id', 'desc')
                ->take(4);;
            $result = $query->get()->toArray();
        }

        if ($options['task'] == 'news-list-items-in-category') {
            $query = $this->select('id', 'name', 'content', 'thumb', 'created')
                ->where('status', '=', 'active')
                ->where('category_id', '=', $params['category_id'])
                ->take(4);
            $result = $query->get()->toArray();
        }

        if ($options['task'] == 'news-list-items-related-in-category') {
            $query = $this->select('id', 'name', 'content', 'thumb', 'created')
                ->where('status', '=', 'active')
                ->where('a.id', '!=', $params['article_id'])
                ->where('category_id', '=', $params['category_id'])
                ->take(4);
            $result = $query->get()->toArray();
        }



        return $result;
    }

    public function countItems($params = null, $options  = null)
    {

        $result = null;

        if ($options['task'] == 'admin-count-items-group-by-status') {

            $query = $this::groupBy('status')
                ->select(DB::raw('status , COUNT(id) as count'));

            if ($params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%");
                }
            }

            $result = $query->get()->toArray();
        }

        return $result;
    }

    public function getItem($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'get-item') {
            $result = self::select('id', 'name', 'content', 'status', 'thumb', 'category_id')->where('id', $params['id'])->first();
        }

        if ($options['task'] == 'get-thumb') {
            $result = self::select('id', 'thumb')->where('id', $params['id'])->first();
        }

        if ($options['task'] == 'news-get-item') {
            $result = self::select('a.id', 'a.name', 'content', 'a.category_id', 'c.name as category_name', 'a.thumb', 'a.created', 'c.display')
                ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
                ->where('a.id', '=', $params['article_id'])
                ->where('a.status', '=', 'active')->first();
            if ($result) $result = $result->toArray();
        }

        if ($options['task'] == 'news-get-bread-crumb-item') {
            $result = self::select('a.category_id', 'c.name as category_name', 'c.parent_id as category_parent')
            ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
            ->where('a.id', '=', $params['article_id'])
            ->where('a.status', '=', 'active')->first();
            if ($result) $result = $result->toArray();

            $breadCrumb = [];
            $recursiveCategoryParent = function($category_id) use (&$recursiveCategoryParent, &$breadCrumb) {
                $category = DB::table('category')->select('name', 'id', 'parent_id')->where('id',  $category_id)->first();
                $breadCrumb[$category->id] = $category->name;
                if($category->parent_id > 1) {
                    $recursiveCategoryParent($category->parent_id);
                }
                return array_reverse($breadCrumb, TRUE);
            };
            $result = $recursiveCategoryParent($result['category_id']);
        }
        return $result;
    }

    public function saveItem($params = null, $options = null)
    {
        $this->table = 'article';
        if($options['task'] == 'change-category') {
            self::where('id', $params['id'])->update(['category_id' => $params['category_id']]);
        }

        if ($options['task'] == 'change-status') {
            $status = ($params['currentStatus'] == "active") ? "inactive" : "active";
            self::where('id', $params['id'])->update(['status' => $status]);
        }

        if ($options['task'] == 'change-type') {
            self::where('id', $params['id'])->update(['type' => $params['currentType']]);
        }


        if ($options['task'] == 'add-item') {
            $params['created_by'] = "phuongnam";
            $params['created']    = date('Y-m-d');
            $params['thumb']      = $this->uploadThumb($params['thumb']);
            self::insert($this->prepareParams($params));
        }

        if ($options['task'] == 'edit-item') {
            if (!empty($params['thumb'])) {
                // Xóa hình cũ
                $this->deleteThumb($params['thumb_current']);

                // Up hình mới
                $params['thumb']      = $this->uploadThumb($params['thumb']);
            }

            $params['modified_by']   = "phuongnam";
            $params['modified']      = date('Y-m-d');

            self::where(['id' => $params['id']])->update($this->prepareParams($params));
        }
    }

    public function deleteItem($params = null, $options = null)
    {
        $this->table = 'article';
        if ($options['task'] == 'delete-item') {
            $item   = $this->getItem($params, ['task' => 'get-thumb']);
            $this->deleteThumb($item['thumb']);
            self::where('id', $params['id'])->delete();
        }
    }
}
