<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Slider;


class SliderController extends Controller
{
    private $pathViewController = 'admin.slider.';
    private $controllerName = 'slider';
    private $model;

    public function __construct()
    {
        $this->model = new Slider();
        View::share('controllerName', $this->controllerName);
    }

    public function index()
    {
        $items = $this->model->listItems(null, ['task' => 'admin-list-items']);

        return view($this->pathViewController . 'index', [
            'items' => $items,
        ]);
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
