<?php

namespace MyDoctorFinder\Libraries;

# Import Library namespaces
use DB;
# Import Eloquent Facades
use MyDoctorFinder\Doctors;

class DataLoader
{

	/**
	 * Variable that will hold the location type that will be retrieved
	 *
	 * @var string: $locationType
	 */
	var $locationType;

	/**
	 * Variable that will hold the general data of the class library
	 *
	 * @var object: $data
	 */ 
	var $data;

	/**
	 * Method used to get the locations from the database and build it in dropdown format
	 *
	 * @param string : $locationType
	 * @return object
	 */
	public function getLocations($locationType = '')
	{
		$this->locationType 	= $locationType;
		if ($this->locationType == 'provinces') {
			$this->data['provinces'] 	= DB::table('location_provinces')->get();
			foreach ($this->data['provinces'] as $province) {
				$this->data['cities'] 	= DB::table('location_cities')->where('location_cities.province_id', '=', $province->id)->get();
				// var_dump($this->data['cities']);die;
				foreach ($this->data['cities'] as $city) {
					$this->data['location'][]	= array (
															'location_name'	=> $province->province_name.', '.$city->city_name,
															'friendly_url' 	=> $city->friendly_url
														);
				}
			}
			return json_encode($this->data['location']);
		}
	}

	/**
	 * Method used to get the options for locations from the search result; From the selection city location, will use the parent province id and get the other cities
	 * 
	 * @param integer : $province_Id
	 * @return Collection
	 */
	public function getOptionsLocations($province_id = 0)
	{
		$this->data 		= DB::table('location_provinces')->select(DB::raw('id, province_name as city_name, friendly_url'))->get();
		if ($province_id) {
			$this->data 	= DB::table('location_cities')->where('province_id', '=', $province_id)->get();
		}
		return $this->data;
	}

	/** 
	 * Method used to retrieve the doctors list
     *
     * @param float : $latitude
     * @param float : $longitude
     * @param integer : $start
     * @param integer : $limit
     * @param array : $query
     * @return Collection
     */
	public function buildDoctorsList($latitude = 0, $longitude = 0, $start = 0, $limit = 25, $query = array())
	{
        $this->data['doctor']       = new Doctors;
        $this->data['doctors']      = $this->data['doctor']->getDoctorsList($latitude, $longitude, $start, $limit, $query);
        $this->data['doctors_list'] = array();
        foreach ($this->data['doctors'] as $doctor) {
        	$this->data['tmp_hosp'] 	= DB::table('doctors_details')
											->leftJoin('listing_hospitals', 'listing_hospitals.id', '=', 'doctors_details.detail_id')
											->select(array('doctors_details.*', 'listing_hospitals.listing_title', 'listing_hospitals.url'))
											->where('doctors_details.detail_type', '=', 1)
											->where('doctors_details.doctor_id', '=', $doctor->id)
											->groupBy('doctors_details.detail_id')
											->get();
        	$this->data['tmp_hmo'] 		= DB::table('doctors_details')
											->leftJoin('listing_hmo', 'listing_hmo.id', '=', 'doctors_details.detail_id')
											->select(array('doctors_details.*', 'listing_hmo.listing_title', 'listing_hmo.url'))
											->where('doctors_details.detail_type', '=', 4)
											->where('doctors_details.doctor_id', '=', $doctor->id)
											->groupBy('doctors_details.detail_id')
											->get();
			$this->data['tmp_spec']		= DB::table('doctors_specialization')
											->leftJoin('specializations', 'specializations.id', '=', 'doctors_specialization.specialization_id')
											->select(array('doctors_specialization.*', 'specializations.specialization', 'specializations.friendly_url'))
											->where('doctors_specialization.doctor_id', '=', $doctor->id)
											->get();
    		$this->data['doctors_list'][] 			= array(
    															'id'		=> $doctor->id,
    															'fname'		=> $doctor->fname,
    															'lname'		=> $doctor->lname,
    															'full_name'	=> $doctor->full_name,
    															'gender'	=> $doctor->gender,
    															'url'		=> $doctor->url,
    															'latitude' 	=> $doctor->latitude,
    															'longitude' => $doctor->longitude,
    															'distance'	=> $doctor->distance,
    															'hospitals' => $this->data['tmp_hosp'],
    															'hmos'		=> $this->data['tmp_hmo'],
    															'specs'		=> $this->data['tmp_spec']
    														);
    		unset ($this->data['tmp_hosp']);
    		unset ($this->data['tmp_hmo']);
    		unset ($this->data['tmp_spec']);
        }
        return json_encode($this->data['doctors_list']);
	}

	/**
	 * Method used to get the id value of the friendly url
	 *
	 * @param string : $friendly_url
	 * @param string : $table
	 * @return Collection
	 */
	public function getIdValue($friendly_url = '', $table = '')
	{
		$this->data['record']	= DB::table($table)->where('friendly_url', '=', $friendly_url)->first();
		return $this->data['record'];
	}

}