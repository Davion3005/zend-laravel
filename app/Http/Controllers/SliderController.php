<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Slider;


class SliderController extends Controller
{
    private $pathViewController = 'admin.pages.slider.';
    private $controllerName = 'slider';
    private $model;
    private $params = [];

    public function __construct()
    {
        $this->params['pagination']['itemsPerPage'] = 1;
        $this->model = new Slider();
        View::share('controllerName', $this->controllerName);
    }

    public function index()
    {
        $items = $this->model->listItems($this->params, ['task' => 'admin-list-items']);
        $countByStatus = $this->model->countItems($this->params, ['task' => 'admin-count-items']);

        return view($this->pathViewController . 'index', [
            'items' => $items,
            'countByStatus' => $countByStatus,
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
