<?php

namespace MyDoctorFinder;

use Illuminate\Database\Eloquent\Model;
# Import Library namespaces
use DB;

class Doctors extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'doctors';

    /**
     * Variable to contain the general data of the model
     *
     * @var Collection
     */ 
    var $data;

    /**
     * Variable to contain the query result set
     *
     * @var Collection
     */
    var $result;

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
    public function getDoctorsList($latitude = 0, $longitude = 0, $start = 0, $limit = 25, $query = array())
    {
        // $this->data     = DB::table('doctors')
        //                     ->leftJoin('doctors_details AS dhospital', 'doctors.id', '=', 'dhospital.doctor_id')
        //                     ->leftJoin('listing_hospitals', 'doctors.id', '=', 'listing_hospitals.id')
        //                     ->leftJoin('doctors_details AS dhmo', 'dhospital.detail_id', '=', 'dhmo.doctor_id')
        //                     ->leftJoin('listing_hmo', 'dhmo.detail_id', '=', 'listing_hmo.id')
        //                     ->select(array('doctors.*','dhospital.detail_id as hospital_id', 'listing_hospitals.listing_title as hospital_title', 'dhmo.detail_id as hmo_id', 'listing_hmo.listing_title as hmo_title'))
        //                     ->where('dhospital.detail_type', '=', 1)
        //                     ->where('dhmo.detail_type', '=', 4)
        //                     ->groupBy('doctors.id')
        //                     ->take($limit)
        //                     ->get();

        // $this->data     = DB::select(DB::raw('SELECT doctors.*, dhospital.detail_id as hospital_id, listing_hospitals.listing_title as hospital_title, dhmo.detail_id as hmo_id, listing_hmo.listing_title as hmo_title FROM doctors LEFT JOIN doctors_details dhospital ON doctors.id = dhospital.doctor_id LEFT JOIN listing_hospitals ON dhospital.detail_id = listing_hospitals.id LEFT JOIN doctors_details dhmo ON doctors.id = dhmo.doctor_id LEFT JOIN listing_hmo ON dhmo.detail_id = listing_hmo.id WHERE dhospital.detail_type = 1 AND dhmo.detail_type = 4 GROUP BY doctors.id LIMIT '.$limit));
        // $this->data     = DB::table('doctors');
        // $this->data->leftJoin('doctors_details AS dhospital', 'doctors.id', '=', 'dhospital.doctor_id');
        // $this->data->leftJoin('listing_hospitals', 'dhospital.detail_id', '=', 'listing_hospitals.id');
        // $this->data->leftJoin('doctors_details AS dhmo', 'doctors.id', '=', 'dhmo.doctor_id');
        // $this->data->leftJoin('listing_hmo', 'dhmo.detail_id', '=', 'listing_hmo.id');
        // $this->data->leftJoin('doctors_specialization', 'doctors.id', '=', 'doctors_specialization.doctor_id');
        // $this->data->select(array('doctors.*', 'dhospital.detail_id as hospital_id', 'listing_hospitals.listing_title as hospital_title', 'dhmo.detail_id as hmo_id', 'listing_hmo.listing_title as hmo_title', 'doctors_specialization.specialization_id'));
        // $this->data->where('dhospital.detail_type', '=', 1);
        // $this->data->where('dhmo.detail_type', '=', 4);
        // $this->data->groupBy('doctors.id');
        // $this->data->take($limit);
        // $this->data->get();
    	// $this->data     = DB::select(DB::raw('SELECT doctors.*, dhospital.detail_id as hospital_id, listing_hospitals.listing_title as hospital_title, listing_hospitals.latitude, listing_hospitals.longitude, listing_hospitals.street, location_cities.city_name, location_provinces.province_name, dhmo.detail_id as hmo_id, listing_hmo.listing_title as hmo_title, (6371 * acos (cos ( radians('.$latitude.') ) * cos( radians( listing_hospitals.latitude ) ) * cos( radians( listing_hospitals.longitude ) - radians('.$longitude.') ) + sin ( radians('.$latitude.') ) * sin( radians( listing_hospitals.latitude ) ))) AS distance FROM doctors LEFT JOIN doctors_details dhospital ON doctors.id = dhospital.doctor_id LEFT JOIN listing_hospitals ON dhospital.detail_id = listing_hospitals.id LEFT JOIN doctors_details dhmo ON doctors.id = dhmo.doctor_id LEFT JOIN listing_hmo ON dhmo.detail_id = listing_hmo.id LEFT JOIN location_cities ON location_cities.id = listing_hospitals.city LEFT JOIN location_provinces ON location_provinces.id = listing_hospitals.province WHERE dhospital.detail_type = 1 AND dhmo.detail_type = 4 GROUP BY doctors.id HAVING distance < 25 ORDER BY distance ASC LIMIT 20'));
        // if ($query) {
        $this->data     = DB::table('doctors');
        $this->data->leftJoin('doctors_details AS dhospital', 'doctors.id', '=', 'dhospital.doctor_id');
        $this->data->leftJoin('listing_hospitals', 'dhospital.detail_id', '=', 'listing_hospitals.id');
        $this->data->leftJoin('doctors_details AS dhmo', 'doctors.id', '=', 'dhmo.doctor_id');
        $this->data->leftJoin('listing_hmo', 'dhmo.detail_id', '=', 'listing_hmo.id');
        $this->data->leftJoin('doctors_specialization', 'doctors.id', '=', 'doctors_specialization.doctor_id');
        $this->data->leftJoin('location_cities', 'listing_hospitals.city', '=', 'location_cities.id');
        $this->data->leftJoin('location_provinces', 'listing_hospitals.province', '=', 'location_provinces.id');
        $this->data->select(DB::raw("doctors.*, dhospital.detail_id as hospital_id, listing_hospitals.listing_title as hospital_title, listing_hospitals.latitude, listing_hospitals.longitude, listing_hospitals.street, location_cities.city_name, location_provinces.province_name, dhmo.detail_id as hmo_id, listing_hmo.listing_title as hmo_title, doctors_specialization.specialization_id, (6371 * acos (cos ( radians(?) ) * cos( radians( listing_hospitals.latitude ) ) * cos( radians( listing_hospitals.longitude ) - radians(?) ) + sin ( radians(?) ) * sin( radians( listing_hospitals.latitude ) ))) AS distance"))->setBindings([$latitude, $longitude, $latitude]);
        // $this->data->select(array('doctors.*', 'dhospital.detail_id as hospital_id', 'listing_hospitals.listing_title as hospital_title', 'listing_hospitals.latitude', 'listing_hospitals.longitude', 'listing_hospitals.street', 'location_cities.city_name', 'location_provinces.province_name', 'dhmo.detail_id as hmo_id', 'listing_hmo.listing_title as hmo_title', 'doctors_specialization.specialization_id'), DB::raw('(6371 * acos (cos ( radians('.$latitude.') ) * cos( radians( listing_hospitals.latitude ) ) * cos( radians( listing_hospitals.longitude ) - radians('.$longitude.') ) + sin ( radians('.$latitude.') ) * sin( radians( listing_hospitals.latitude ) ))) AS distance'));
        $this->data->where('dhospital.detail_type', '=', 1);
        $this->data->where('dhmo.detail_type', '=', 4);
        if (isset($query['specializations'])) {
            $this->data->whereIn('doctors_specialization.specialization_id', $query['specializations']);
        }
        if (isset($query['locations'])) {
            $this->data->whereIn('listing_hospitals.city', $query['locations']);
        }
        $this->data->groupBy('doctors.id');
        if ($start) {
            $this->data->skip($start);
        }
        $this->data->take($limit);
        // }
        $this->result   = $this->data->get();
        return $this->result;
    }

    public function getDoctorsListCount($latitude = 0, $longitude = 0, $query = array())
    {
        $this->data     = DB::table('doctors');
        $this->data->leftJoin('doctors_details AS dhospital', 'doctors.id', '=', 'dhospital.doctor_id');
        $this->data->leftJoin('listing_hospitals', 'dhospital.detail_id', '=', 'listing_hospitals.id');
        $this->data->leftJoin('doctors_details AS dhmo', 'doctors.id', '=', 'dhmo.doctor_id');
        $this->data->leftJoin('listing_hmo', 'dhmo.detail_id', '=', 'listing_hmo.id');
        $this->data->leftJoin('doctors_specialization', 'doctors.id', '=', 'doctors_specialization.doctor_id');
        $this->data->leftJoin('location_cities', 'listing_hospitals.city', '=', 'location_cities.id');
        $this->data->leftJoin('location_provinces', 'listing_hospitals.province', '=', 'location_provinces.id');
        $this->data->select(DB::raw("doctors.*, dhospital.detail_id as hospital_id, listing_hospitals.listing_title as hospital_title, listing_hospitals.latitude, listing_hospitals.longitude, listing_hospitals.street, location_cities.city_name, location_provinces.province_name, dhmo.detail_id as hmo_id, listing_hmo.listing_title as hmo_title, doctors_specialization.specialization_id, (6371 * acos (cos ( radians(?) ) * cos( radians( listing_hospitals.latitude ) ) * cos( radians( listing_hospitals.longitude ) - radians(?) ) + sin ( radians(?) ) * sin( radians( listing_hospitals.latitude ) ))) AS distance"))->setBindings([$latitude, $longitude, $latitude]);
        $this->data->where('dhospital.detail_type', '=', 1);
        $this->data->where('dhmo.detail_type', '=', 4);
        if (isset($query['specializations'])) {
            $this->data->whereIn('doctors_specialization.specialization_id', $query['specializations']);
        }
        if (isset($query['locations'])) {
            $this->data->whereIn('listing_hospitals.city', $query['locations']);
        }
        $this->data->groupBy('doctors.id');
        // }
        return $this->data->get();
    }

}
