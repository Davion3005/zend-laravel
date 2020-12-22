<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;


class SliderController extends Controller
{
    private $pathViewController = 'admin.slider.';

    public function index()
    {
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
        return 'Change status';
    }

    public function delete()
    {
        return 'delete';
    }
}
