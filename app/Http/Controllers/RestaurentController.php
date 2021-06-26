<?php

namespace App\Http\Controllers;

use App\Repositories\RestaurentRepository;
use App\Models\Branch;
use App\Models\Restaurent;
use Illuminate\Http\Request;

class RestaurentController extends Controller
{
    protected $restaurentRepository;


    public function __construct(RestaurentRepository $restaurentRepository)
    {
        $this->restaurentRepository = $restaurentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request)
    {
        return $this->restaurentRepository->get($request);
    }

    
}
