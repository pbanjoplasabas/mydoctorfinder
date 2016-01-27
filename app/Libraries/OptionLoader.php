<?php

namespace MyDoctorFinder\Libraries;

# Import Library namespaces
use DB;

class OptionLoader
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
				foreach ($this->data['cities'] as $city) {
					$this->data['location'][]['location_name'] 	= $province->province_name.', '.$city->city_name;
				}
			}
			return json_encode($this->data['location']);
		}
	}


}