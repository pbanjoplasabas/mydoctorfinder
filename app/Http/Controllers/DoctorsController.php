<?php

namespace MyDoctorFinder\Http\Controllers;

use Illuminate\Http\Request;

use MyDoctorFinder\Http\Requests;
use MyDoctorFinder\Http\Controllers\Controller;
# Import Library namespaces
use DB;
use URL;
use Auth;
use Session;
use \Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use MyDoctorFinder\Libraries\DataLoader;
# Import database namespaces
use MyDoctorFinder\Doctors;

class DoctorsController extends Controller
{

    /**
     * Variable used to contain the doctors data of the controller
     *
     * @var Collection
     */ 
    var $doctor;

    /**
     * Method used to redirect the search result to the friendly url page
     *
     * @return Response
     */
    public function prepareSearchResults()
    {
        if (isset($_GET['specialty']) && isset($_GET['location'])) {
            return redirect('doctors/'.$_GET['specialty'].'/'.$_GET['location']);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($specialty = '', $location = '')
    {
        // Prepare query search result set
        $this->data['options']      = new DataLoader;
        $this->data['location']     = $this->data['options']->getIdValue($location, 'location_cities');
        $this->data['specialty']    = $this->data['options']->getIdValue($specialty, 'specializations');
        // Prepare additional query 
        $location_query             = ($location ? array($this->data['location']->id) : array());
        if (isset($_GET['locations'])) {
            if ($_GET['locations']) {
                $location_query     = array_merge($location_query, explode('-', $_GET['locations']));
            }
        }
        $specialty_query            = ($specialty ? array($this->data['specialty']->id) : array());
        if (isset($_GET['specialty'])) {
            if ($_GET['specialty']) {
                $specialty_query    = array_merge($specialty_query, explode('-', $_GET['specialty']));
            }
        }
        $this->data['query']        = array (
                                                'specializations'       => $specialty_query,
                                                'locations'             => $location_query
                                            );

        $this->data['ip']           = ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' ? '112.199.47.222' : $_SERVER['REMOTE_ADDR']);
        $this->data['ip_loc']       = json_decode(file_get_contents('http://ipinfo.io/'.$this->data['ip'].'/json'));
        $ch = curl_init('http://ipinfo.io/'.$this->data['ip'].'/json');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $this->data['ip_loc']       = json_decode(curl_exec($ch));
        $this->data['coordiantes']  = explode(",", $this->data['ip_loc']->loc);

        $this->data['doctors_list'] = $this->data['options']->buildDoctorsList($this->data['coordiantes'][0], $this->data['coordiantes'][1], (isset($_GET['page']) ? ($_GET['page'] < 2 ? 0 : ($_GET['page'] == 2 ? 25 : (($_GET['page'] - 1) * 25)) ) : 0), 25, $this->data['query']);
        $this->data['doctors']      = json_decode($this->data['doctors_list']);
        $this->doctor               = new Doctors;
        $this->data['list_count']   = $this->doctor->getDoctorsListCount($this->data['coordiantes'][0], $this->data['coordiantes'][1], $this->data['query']);
        
        $this->data['paginator']    = new LengthAwarePaginator($this->data['doctors_list'], count($this->data['list_count']), 25, Paginator::resolveCurrentPage(), ['path' => Paginator::resolveCurrentPath()]);

        // Prepare page title
        if ($specialty && $location) {
            $this->data['title']        = config('constants.general_title').' - Doctors of '.$this->data['specialty']->specialization.' in '.$this->data['location']->city_name;
        }
        else {
        $this->data['title']        = config('constants.general_title').' - Doctors in the Philippines listed';
        }

        // Load data for both specialties and locations dropdown search 
        $this->data['specialties']  = DB::table('specializations')->get();
        $this->data['locations']    = json_decode($this->data['options']->getLocations('provinces'));

        // Load data for sidebar options of locations and specialties
        $this->data['opt_specs']    = DB::table('specializations')->take(10)->get();
        $this->data['opt_locs']     = $this->data['options']->getOptionsLocations(($location ? $this->data['location']->province_id : 0));  

        if ($location && $specialty) {
            return view('doctors.index')->with($this->data);
        }
        else {
            
        }
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

    /**
     * Method used to display the doctors detail
     *
     * @param string : $friendly_url
     * @return Response
     */
    public function details($friendly_url)
    {

    }

    /**
     * Method used to filter the selected items for changing the result set
     *
     * @return Html
     */
    public function filterResults(Request $request)
    {
        $this->data['location_ids']     = $request->get('location_ids');
        $this->data['specialty_ids']    = $request->get('specialty_ids');
        $this->data['current_loc']      = $request->get('current_location');
        $this->data['current_spec']     = $request->get('current_specialty');

        $this->data['query']        = array (
                                                'specialization_id'     => $request->get('current_specialty'),
                                                'location_id'           => $request->get('current_location'),
                                                'locations'             => $request->get('location_ids')
                                            );

        $this->doctor                   = new DataLoader;
        $this->data['result']           = json_decode($this->doctor->buildDoctorsList('', '', 0, 25, $this->data['query']));

        return $this->data['result'];
    }

}
