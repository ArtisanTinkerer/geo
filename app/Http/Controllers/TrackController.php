<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $points = "ST_GeomFromText('LINESTRING(";
        foreach( $xml->trk->trkseg->{'trkpt'} as $trackPoint ) {
            $points .= "{$trackPoint->attributes()->lon}    {$trackPoint->attributes()->lat} ,";
        }
        $points = rtrim($points,',');
        $points .= ")')";


        $track->line = \DB::raw($points);
        $track->save();

        //can I save this as a linestring instead of points?
        //ST_GeomFromText('LINESTRING(0 0, 1 1)')


        /*foreach( $xml->trk->trkseg->{'trkpt'} as $trackPoint ) {
            $point = new Point();
            $lat = $trackPoint->attributes()->lat;
            $lon = $trackPoint->attributes()->lon;
            $point->position = \DB::raw("ST_GeomFromText('POINT($lat $lon)',4326)");
            $point->elevation = 0;
            $point->track_id = $track->id;
            $point->save();
        }*/

        return route('tracks.show',$track);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track)
    {
        $token = env('MAPBOX_TOKEN');


        $theline =  DB::table('tracks')
            ->select(DB::raw('ST_AsGeoJSON(line) as json'))
            ->where('id', '=', $track->id)
            ->first()->json;

        $zoomTo = json_encode([json_decode($theline)->coordinates[0][1], json_decode($theline)->coordinates[0][0]]);

        return view('tracks.show',compact('track', 'token','theline','zoomTo'));

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
