<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurentRequest;
use App\Models\Image as ImageLibrary;
use App\Models\MenuCard;
use App\Models\Restaurent;
use DB;
use Illuminate\Http\Request;
use Image;
use Str;

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

    public function topRestaurents()
    {
        return Restaurent::with('location','location.zone')
            ->withCount('bookings')
            ->orderByDesc('view')
            ->take(5)
            ->get();
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
        //dd($request->all());
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
                $restaurent->cover = $this->storeImage($request->file('image'),Str::slug($restaurent->name));
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

                // store feature images
                if(isset($request->images)){
                    $this->storeFeatureImages($restaurent, $request->images);
                }

                // store feature images
                if(isset($request->menucards)){
                    $this->storeMenucards($restaurent, $request->menucards);
                }

                // store menu cards
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
        $ext = explode(".", $image->getClientOriginalName());
        $fileName = ($name != null?$name:'').uniqid().'.'.end($ext);
        $imageInstance = Image::make($image)
            ->save('images/restaurents/'.$fileName);

        return  $fileName;
    }


    public function storeFeatureImages($restaurent, $images)
    {
        foreach($images as $key => $image){ 
            $ext = explode(".", $image->getClientOriginalName());
            $fileName = 'feature_'.$restaurent->id.'_'.uniqid().'.'.end($ext);
            $imageInstance = Image::make($image)
                ->save('images/gallery/'.$fileName);

            $img = new ImageLibrary(['src' => $fileName]);

            $h = $restaurent->images()->save($img);
        }
        return 'done';
    }

    public function storeMenucards($restaurent, $images)
    {
        foreach($images as $key => $image){ 
            $ext = explode(".", $image->getClientOriginalName());
            $fileName = 'menucards_'.$restaurent->id.'_'.uniqid().'.'.end($ext);
            $imageInstance = Image::make($image)
                ->save('images/menucards/'.$fileName);

            $img = new MenuCard(['src' => $fileName]);
            
            $h = $restaurent->menucards()->save($img);
        }
        return 'done';
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
        $restaurent = Restaurent::with(
            'images',
            'menucards',
            'categories',
            'cuisines',
            'features',
            'location',
            'location.zone'
        )->find($id);

        //dd($restaurent);
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
            $restaurent->is_booking = $request->is_booking?1:0;
            $restaurent->location_id = $request->location_id;
            $restaurent->description = $request->description;
            $restaurent->approx_cost = $request->approx_cost;
            $restaurent->address = $request->address;

            // store image
            if($request->hasfile('image')){
                $restaurent->cover = $this->storeImage($request->file('image'), Str::slug($restaurent->name));
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

                // store feature images
                if(isset($request->images)){
                    $this->storeFeatureImages($restaurent, $request->images);
                }

                // store feature images
                if(isset($request->menucards)){
                    $this->storeMenucards($restaurent, $request->menucards);
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
