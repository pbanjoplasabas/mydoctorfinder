<?php

namespace MyDoctorFinder\Http\Controllers;

use Illuminate\Http\Request;

use MyDoctorFinder\Http\Requests;
use MyDoctorFinder\Http\Controllers\Controller;
# Import Library namespaces
use DB;
use Auth;
use Session;
use \Carbon\Carbon;
use MyDoctorFinder\Libraries\DataLoader;
# Import Eloquent Facades
use MyDoctorFinder\Doctors;

class PagesController extends Controller
{

    /**
     * Variable used to contain the general data of the controller
     *
     * @var array
     */
    var $data;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title']        = config('constants.general_title');
        // Load data for both specialties and locations
        $this->data['specialties']  = DB::table('specializations')->get();
        $this->data['options']      = new DataLoader;
        $this->data['locations']    = json_decode($this->data['options']->getLocations('provinces'));
        // Retrieve location of the remote address
        $this->data['ip']           = ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' ? '112.199.47.222' : $_SERVER['REMOTE_ADDR']);
        // echo $this->data['ip'];die;
        // $this->data['location']  = json_decode(file_get_contents('http://ipinfo.io/'.$this->data['ip'].'/json'));
        // $ch = curl_init('http://ipinfo.io/'.$this->data['ip'].'/json');
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $this->data['location'] = json_decode(curl_exec($ch));
        // $this->data['coordiantes']  = explode(",", $this->data['location']->loc);

        // Load data for doctors
        $this->data['doctors']      = json_decode($this->data['options']->buildDoctorsList('', ''));
        // $this->data['doctors']      = json_decode($this->data['options']->buildDoctorsList($this->data['coordiantes'][0], $this->data['coordiantes'][1]));
        // var_dump($this->data['doctors']);die;

        return view('pages.index')->with($this->data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
