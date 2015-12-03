<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Activity;
use App\POF;
use Auth;

class ActivityRestController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Activity::all();
    }

    public function userActivities(Request $request) {
        return Auth::user()->activities;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $actArray = POF::getItem(Activity::findOrFail($id)->guid);

        return ['title' => array_get($actArray, 'title', 'ei määritetty'),
            'guid' => array_get($actArray, 'guid', 'ei määritetty'),
            'content' => array_get($actArray, 'content', 'ei määritetty'),
            'pakollisuus' => array_get($actArray, 'tags.pakollisuus.name', 'ei määritetty'),
            'pakollisuusikoni' => array_get($actArray, 'tags.pakollisuus.0.icon', 'ei määritetty'),
            'ryhmakoko' => array_get($actArray, 'tags.ryhmakoko.0.name', 'ei määritetty'),
            'logo' => array_get($actArray, 'images.logo.url', ''),
            'main_image' => array_get($actArray, 'images.main_image.url', ''),
            'paikka' => array_get($actArray, 'tags.paikka.0.name', 'ei määritetty'),
            'suoritus_kesto' => array_get($actArray, 'tags.suoritus_kesto.name', 'ei määritetty')];

//             ,
//            'pakollisuus' => $actArray->tags->pakollisuus->name, 'ryhmakoko' => $actArray->tags->ryhmakoko->name,
//            'paikka' => $actArray->tags->paikka->name, 'suoritus_kesto' => $actArray->tags->suoritus_kesto->name];
        //return POF::getItemJson(Activity::findOrFail($id)->guid);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
