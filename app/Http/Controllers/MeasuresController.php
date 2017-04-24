<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Measure;
use App\Type;

class MeasuresController extends Controller
{
    /**
     * Render the main page.
     *
     * @return mixed
     */
    public function index()
    {
        return view('welcome')->with('types', Type::all());
    }

    /**
     * Return an array of measures for the given type.
     *
     * @param integer $type_id
     *
     * @return mixed
     */
    public function get($type_id)
    {
        return Measure::where('type_id', $type_id)
            ->orderBy('date', 'DESC')
            ->get();
    }

    /**
     * Store a new measure value.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function post(Request $request)
    {
        $this->validate($request, [
            'date'     => 'required|',
            'value'    => 'required',
            'type_id'  => 'required|exists:types,id',
        ]);

        $measure = new Measure();
        $measure->fill($request->all());
        $measure->save();

        return response()->json([]);
    }
}
