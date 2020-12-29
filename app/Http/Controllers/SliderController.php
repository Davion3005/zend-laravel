<?php


namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class SliderController extends Controller
{
    private $pathViewController = 'admin.pages.slider.';
    private $controllerName = 'slider';
    private $model;
    private $params = [];

    public function __construct()
    {
        $this->params['pagination']['itemsPerPage'] = 5;
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

    public function form(Request $request)
    {
        $item = null;
        if ($request->id != null) {
            $params['id'] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }

        return view($this->pathViewController . 'form', [
            'item' => $item,
        ]);
    }

    public function status(Request $request)
    {
        $params['currentStatus'] = $request->status;
        $params['id'] = $request->id;
        $this->model->saveItem($params, ['task' => 'change-status']);

        return redirect()->route('slider')->with('status', 'Slider updated successfully');
    }

    public function delete(Request $request)
    {
        $params['id'] = $request->id;
        $this->model->deleteItem($params, ['task' => 'delete-item']);

        return redirect()->route($this->controllerName)->with('status', 'Slider has been deleted successfully');
    }

    public function save(SliderRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();

            $task = 'add-item';
            $notify = 'Add item successfully';

            if ($params['id'] !== null) {
                $task = 'edit-item';
                $notify = 'Edit item successfully';
            }
            $this->model->saveItem($params, ['task' => $task]);

            return redirect()->route($this->controllerName)->with('status', $notify);
        }
    }
}
