<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\RestaurentRepository;
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
    public function get(Request $request)
    {
        return $this->restaurentRepository->get($request);
    }
}
