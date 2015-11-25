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
        $activity = Activity::findOrFail($id);
        

        $singleActArray = ['title' => array_get($actArray, 'title', 'ei määritetty'),
            'guid' => array_get($actArray, 'guid', 'ei määritetty'),
            'content' => array_get($actArray, 'content', 'ei määritetty'),
            'pakollisuus' => array_get($actArray, 'tags.pakollisuus.name', 'ei määritetty'),
            'pakollisuusikoni' => array_get($actArray, 'tags.pakollisuus.0.icon','ei määritetty'),
            'ryhmakoko' => array_get($actArray, 'tags.ryhmakoko.0.name', 'ei määritetty'),
            'agegroup' =>  array_get($actArray, 'parents.1.title'),
            'paikka' => array_get($actArray,'tags.paikka.0.name','ei määritetty'),
            'suoritus_kesto' => array_get($actArray, 'tags.suoritus_kesto.name', 'ei määritetty')];
        
        return view('activity', compact('singleActArray','activity'));

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
