<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tracks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'gpx' => 'required|file'
        ]);

        $xml=simplexml_load_file($request->file('gpx'));

        //look at points and save to db
        $track = new Track();
        $track->name = $xml->trk->name;
        $track->save();

        foreach( $xml->trk->trkseg->{'trkpt'} as $trackPoint ) {

            $point = new Point();

            $lat = $trackPoint->attributes()->lat;
            $lon = $trackPoint->attributes()->lon;

            $point->position = \DB::raw("ST_GeomFromText('POINT($lat $lon)',4326)");

            $point->elevation = 0;

            //todo relationship
            $point->track_id = $track->id;
            $point->save();


        }


        //go back to the show now

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track)
    {
        return view('tracks.show')->with('track',$track->load('points'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
