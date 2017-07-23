<?php

namespace App\Http\Controllers;

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
            ->paginate(10);
    }

    /**
     * Store a new measure value.
     *
     * @return mixed
     */
    public function post()
    {
        $this->validate(request(), [
            'date'     => 'required|date_format:d/m/Y',
            'value'    => 'required|integer|min:1',
            'type_id'  => 'required|exists:types,id',
        ]);

        $measure = Measure::create(request(['date', 'value', 'type_id']));

        return $measure;
    }
}
