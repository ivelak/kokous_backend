<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Activity;
use App\Http\Controllers\Controller;
use App\Jobs\SynchronizeWithPOF;
use App\POF;

class ActivityController extends Controller
{
    
    protected $pofSyncer;
            
    public function __construct(SynchronizeWithPOF $pofSyncer) {
        $this->pofSyncer = $pofSyncer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    /*public function index()
    {
        $activities = Activity::all();
        return view('activity.activities', ['activities' => $activities]);
    }*/
    
    public function index(Request $request) {
        //
      $activities = Activity::paginate($request->input('perpage', 15));
        return view('activity.activities', compact('activities'));
    }
    
    public function sync(Request $request) {
        $this->dispatch($this->pofSyncer);       
        return redirect('/activities');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('activity.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $actArray = POF::getItem(Activity::findOrFail($id)->guid);

        return ['title' => $actArray['title'],
            'guid' => $actArray['guid'],
            'content' => $actArray['content'],
            'pakollisuus' => $actArray['tags']['pakollisuus'][0]['name'],
            'pakollisuusikoni' => $actArray['tags']['pakollisuus'][0]['icon'],
            'ryhmakoko' => $actArray['tags']['ryhmakoko'][0]['name'],
            'paikka' => $actArray['tags']['paikka'][0]['name'],
            'suoritus_kesto' => $actArray['tags']['suoritus_kesto']['name']];

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
