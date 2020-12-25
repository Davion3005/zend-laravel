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

    public function index(Request $request)
    {
        $this->params['filter']['status'] = $request->input('filter_status', 'all');
        $this->params['search']['search_field'] = $request->input('search_field');
        $this->params['search']['search_value'] = $request->input('search_value');

        $items = $this->model->listItems($this->params, ['task' => 'admin-list-items']);
        $itemsStatusCount = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status']);

        return view($this->pathViewController . 'index', [
            'params' => $this->params,
            'items' => $items,
            'itemsStatusCount' => $itemsStatusCount,
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
