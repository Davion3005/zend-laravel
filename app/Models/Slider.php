<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'slider';
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $crudNotAccepted = [
        '_token',
        'thumb_current',
    ];

    public function listItems($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'admin-list-items') {
            $query = self::select('*');
            $status = $params['filter']['status'];
            if (isset($status) && $status != 'all') {
                $query->where('status', '=', $status);
            }
            $result = $query->orderBy('id', 'desc')
                        ->paginate($params['pagination']['itemsPerPage']);
        }
        return $result;
    }

    public function countItems($params = null, $options = null)
    {
        $result = 'null';

        if ($options['task'] == 'admin-count-items-group-by-status') {
            $result = self::select(DB::raw('count(id) as count, status'))
                        ->groupBy('status')
                        ->get()
                        ->toArray();
        }

        return $result;
    }

    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'change-status') {
            $status = $params['currentStatus'] == 'active' ? 'inactive' : 'active';
            self::where('id', $params['id'])->update(['status' => $status]);
        }

        if ($options['task'] == 'add-item') {
            $thumb = $params['thumb'];
            $params['thumb'] = Str::random(10) . '.' . $thumb->clientExtension();
            $params['created'] = Carbon::now();
            $params['created_by'] = 'Admin';
            $thumb->storeAs('slider', $params['thumb'], 'zvn_storage_image');
            $params = array_diff_key($params, array_flip($this->crudNotAccepted));
            DB::table($this->table)->insert($params);
        }
    }

    public function deleteItem($params = null, $options = null)
    {
        if ($options['task'] == 'delete-item') {
            $item = self::getItem($params, ['task' => 'get-thumb']);
            Storage::disk('zvn_storage_image')->delete('slider/' . $item->thumb);
            DB::table($this->table)->where('id', $params['id'])->delete();
        }
    }

    public function getItem($params = null, $options = null)
    {
        if ($options['task'] == 'get-item'){
            $result = self::where('id', $params['id'])->first();
        }
        if ($options['task'] == 'get-thumb'){
            $result = DB::table($this->table)->select('thumb')->where('id', $params['id'])->first();
        }

        return $result;
    }
}
