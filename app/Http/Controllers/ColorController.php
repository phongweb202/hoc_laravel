<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();

        return view(
            'admin.color.index',
            [
                'colors' => $colors
            ]
        );
    }

    public function create()
    {

        return view('admin.color.color_form', []);
    }

    public function saveCreate(Request $request)
    {

        $validated = Validator::make(
            $request->all(),
            [
                'color_name' => 'required',
                'color' => 'required'
            ],
            [
                'color_name.required' => 'Tên màu không được để trống',
                'color.required' => 'Mã màu không được để trống'
            ]
        );

        if ($validated->fails()) {
            return redirect('admin/colors/create')
                ->withErrors($validated)
                ->withInput();
        }

        $model = new Color();
        $model->color_name = $request->input('color_name');
        $model->color = $request->input('color');
        $model->save();
        return redirect('admin/colors');
    }

    public function edit($id)
    {
        $color = Color::find($id);

        return view(
            'admin.color.color_edit',
            [
                'color' => $color
            ]
        );
    }

    public function saveEdit(Request $request, $id)
    {
        $validated = Validator::make(
            $request->all(),
            [
                'color_name' => 'required',
                'color' => 'required'
            ],
            [
                'color_name.required' => 'Tên màu không được để trống',
                'color.required' => 'Mã màu không được để trống'
            ]
        );
        if ($validated->fails()) {
            return redirect('admin/colors/' . $id . '/edit')
                ->withErrors($validated)
                ->withInput();
        }

        $model = Color::find($id);
        $model->color_name = $request->input('color_name');
        $model->color = $request->input('color');
        $model->save();

        return redirect('admin/colors');
    }

    public function remove($id){
        $model = Color::destroy($id);
        return redirect('admin/colors');
    }
}
