<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurentRequest;
use App\Models\Restaurent;
use Illuminate\Http\Request;

use DB;
use Image;

class RestaurentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.restaurents.index');
    }


    public function fetch(Request $request)
    {
        $perpage = $request->per_page != ''? ((int)$request->per_page):10;
        $keyword = $request->keyword??'';
        return Restaurent::with('categories','cuisines','features','location','location.zone')
            ->when($keyword != '', function($q) use ($keyword){
                $q->where('name','like','%'.$keyword.'%');
            })
            ->orderBy('id','desc')
            ->paginate($perpage);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.restaurents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RestaurentRequest $request, Restaurent $restaurent)
    {
        DB::beginTransaction();
        try{
            $restaurent->name = $request->name;
            $restaurent->slug = $request->name;
            $restaurent->is_booking = $request->is_booking?1:0;
            $restaurent->location_id = $request->location_id;
            $restaurent->description = $request->description;
            $restaurent->approx_cost = $request->approx_cost;
            $restaurent->address = $request->address;

            // store image
            if($request->hasfile('image')){
                $restaurent->cover = $this->storeImage($request->file('image'));
            }

            if ($restaurent->save()){
                if(isset($request->cuisines)){
                    $restaurent->cuisines()->attach($request->cuisines);
                }
                if(isset($request->features)){
                    $restaurent->features()->attach($request->features);
                }
                if(isset($request->categories)){
                    $restaurent->categories()->attach($request->categories);
                }
            }
            DB::commit();
            return $restaurent;
        }catch(\Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function storeImage($image, $name = null, $path = null)
    {
        Image::make($image)->save('images/restaurents/bar.jpg');

        return  'images/restaurents/bar.jpg';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Restaurent::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $restaurent = Restaurent::with('categories','cuisines','features','location','location.zone')->find($id);
        return view('admin.restaurents.edit', compact('restaurent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RestaurentRequest $request, Restaurent $restaurent)
    {
        DB::beginTransaction();
        try{
            $restaurent->name = $request->name;
            $restaurent->slug = $request->name;
            $restaurent->is_booking = $request->is_booking?1:0;
            $restaurent->location_id = $request->location_id;
            $restaurent->description = $request->description;
            $restaurent->approx_cost = $request->approx_cost;
            $restaurent->address = $request->address;

            // store image
            if($request->hasfile('image')){
                $restaurent->cover = $this->storeImage($request->file('image'));
            }

            if ($restaurent->save()){
                if(isset($request->cuisines)){
                    $restaurent->cuisines()->sync($request->cuisines);
                }
                if(isset($request->features)){
                    $restaurent->features()->sync($request->features);
                }
                if(isset($request->categories)){
                    $restaurent->categories()->sync($request->categories);
                }
            }
            DB::commit();
            return $restaurent;
        }catch(\Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Restaurent::find($id)->delete();
    }
}
