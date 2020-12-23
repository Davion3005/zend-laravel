<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;


class SliderController extends Controller
{
    private $pathViewController = 'admin.slider.';
    private $controllerName = 'slider';

    public function __construct()
    {
        View::share('controllerName', $this->controllerName);
    }

    public function index()
    {
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            print_r($table);
        }
        return view($this->pathViewController . 'index');
    }

    public function form($id = null)
    {
        $title = 'title';
        return view($this->pathViewController . 'form', [
            'id' => $id,
            'title' => $title,
            ]);
    }

    public function status($status, $id, Request $request)
    {
        echo $request->route('status');
        return redirect()->route('slider');
    }

    public function delete()
    {
        return view($this->pathViewController . 'delete');
    }
}
