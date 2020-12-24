<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'slider';
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public function listItems($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'admin-list-items') {
            $result = self::select('*')->orderBy('id', 'desc')->paginate($params['pagination']['itemsPerPage']);
        }

        return $result;
    }

    public function countItems($params = null, $options = null)
    {
        $result = 'null';

        if ($options['task'] == 'admin-count-items') {
            $result = self::select(DB::raw('count(id) as count, status'))
                        ->groupBy('status')
                        ->get()
                        ->toArray();
        }

        return $result;
    }
}
