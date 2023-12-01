<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResultadosLiga;
use App\Models\Home;

class HomeController extends Controller
{
    public function getMatchsByDay($params)
    {
        $year = '2023-2024';
        $result = ResultadosLiga::where('fecha', $params)->where('year', $year)->get();

        $model = new ResultadosLiga();
        $response = $model->getNextGame($result);               

        return $response;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Home $home)
    {
        //
    }
}
