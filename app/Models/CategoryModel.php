<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Kalnoy\Nestedset\NodeTrait;

class CategoryModel extends AdminModel
{
    use NodeTrait;
    protected $table = 'category';
    protected $guarded = [];

    public function listItems($params = null, $options = null)
    {

        $result = null;

        if ($options['task'] == "admin-list-items") {
            $query = $this->select('id', 'name', 'status', 'is_home', 'display', 'created', 'created_by', 'modified', 'modified_by');

            if ($params['filter']['status'] !== "all") {
                $query->where('status', '=', $params['filter']['status']);
            }

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

            $result =  $query->get();
        }

        if ($options['task'] == 'news-list-items') {
            $query = $this->select('id', 'name')
                ->where('status', '=', 'active')
                ->limit(8);

            $result = $query->get()->toArray();
        }

        if ($options['task'] == 'news-list-items-is-home') {
            $query = $this->select('id', 'name', 'display')
                ->where('status', '=', 'active')
                ->where('is_home', '=', 'yes');

            $result = $query->get()->toArray();
        }

        if ($options['task'] == "admin-list-items-in-select-box") {
            $query = self::select('id', 'name')->where('_lft', '<>', NULL)->withDepth()->defaultOrder();

            if(isset($params['id'])) {
                $node = self::find($params['id']);
                $query->where('_lft', '<', $node->_lft)->orWhere('_lft', '>', $node->_rgt);
            }
            $nodes = $query->get()->toFlatTree();
            
            foreach($nodes as $value) {
                $result[$value['id']] = str_repeat('|---', $value['depth']) . $value['name'];
            }
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
            $result = self::select('id', 'name', 'parent_id', 'status')->where('id', $params['id'])->first();
        }

        if ($options['task'] == 'news-get-item') {
            $result = self::select('id', 'name', 'display')->where('id', $params['category_id'])->first();

            if ($result) $result = $result->toArray();
        }

        return $result;
    }

    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'change-status') {
            $status = ($params['currentStatus'] == "active") ? "inactive" : "active";
            self::where('id', $params['id'])->update(['status' => $status]);
        }

        if ($options['task'] == 'change-is-home') {
            $isHome = ($params['currentIsHome'] == "yes") ? "no" : "yes";
            self::where('id', $params['id'])->update(['is_home' => $isHome]);
        }

        if ($options['task'] == 'change-display') {
            $display = $params['currentDisplay'];
            self::where('id', $params['id'])->update(['display' => $display]);
        }

        if ($options['task'] == 'add-item') {
            $params['created_by'] = session('userInfo')['username'];
            $params['created']    = date('Y-m-d h:i:s');
            $parent = self::find($params['parent_id']);

            self::create($this->prepareParams($params), $parent);
        }

        if ($options['task'] == 'edit-item') {
            $params['created_by'] = session('userInfo')['username'];
            $params['created']    = date('Y-m-d h:i:s');

            $parent = self::find($params['parent_id']);
            $query = $current = self::find($params['id']);
            $query->update($this->prepareParams($params));
            if($current['parent_id'] !== $params['parent_id']) $query->prependToNode($parent)->save();
        }
    }

    public function deleteItem($params = null, $options = null)
    {
        if ($options['task'] == 'delete-item') {
            self::where('id', $params['id'])->delete();
        }
    }
}
