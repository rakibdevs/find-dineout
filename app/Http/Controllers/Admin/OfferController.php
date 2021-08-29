<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.offers.index');
    }


    public function fetch(Request $request)
    {
        $perpage = $request->per_page != ''? ((int)$request->per_page):10;
        $keyword = $request->keyword??'';
        return Offer::withCount('restaurents')
            ->when($keyword != '', function($q) use ($keyword){
                $q->where('name','like','%'.$keyword.'%');
            })
            ->orderBy('id','desc')
            ->paginate($perpage);
    }

    public function topOffers()
    {
        return Offer::withCount('restaurents')
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
        return view('admin.offers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferRequest $request, Offer $offer)
    {
        DB::beginTransaction();
        try{
            $offer->name = $request->name;
            $offer->slug = $request->name;
            $offer->percent = $request->percent;
            $offer->description = $request->description;

            // store image
            if($request->hasfile('image')){
                $offer->image = $this->storeImage($request->file('image'),Str::slug($offer->name));
            }
            $offer->save();
            DB::commit();
            return $offer;
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
            ->save('images/offers/'.$fileName);

        return  $fileName;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Offer::withCount('restaurents')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offer = Offer::with('categories')->find($id);
        return view('admin.offers.edit', compact('Offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfferRequest $request, Offer $offer)
    {
        DB::beginTransaction();
        try{
            $offer->name = $request->name;
            $offer->slug = $request->name;
            $offer->percent = $request->percent;
            $offer->description = $request->description;

            // store image
            if($request->hasfile('image')){
                $offer->image = $this->storeImage($request->file('image'), Str::slug($offer->name));
            }

            DB::commit();
            return $offer;
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
        return Offer::find($id)->delete();
    }
}
