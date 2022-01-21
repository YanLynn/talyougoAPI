<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Districts;
use App\Models\Township;
use App\Http\Controllers\BaseController as BaseController;

class PcodesController extends BaseController
{
    public function getCity()
    {
        return $this->handleResponse(City::all(), 'data success!');
    }
    public function getDistrict($sr_pcode = '')
    {
        if ($sr_pcode) {
            $data = Districts::where('sr_pcode', $sr_pcode)->get();
        } else {
            $data = Districts::all();
        }

        return $this->handleResponse($data, 'data success!');
    }
    public function getTownship($sr_pcode = '', $d_code = '')
    {
        if (($sr_pcode && $d_code) || (!$sr_pcode && $d_code) || ($sr_pcode && !$d_code)) {
            $data = Township::where('sr_code', $sr_pcode)->orWhere('d_code', $d_code)->get();
        } else {
            $data = Township::all();
        }

        return $this->handleResponse($data, 'data success!');
    }
}
