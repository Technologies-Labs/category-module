<?php

namespace Modules\CategoryModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CategoryModule\Entities\Trademark;
use Modules\CategoryModule\Http\Requests\TrademarkRequest;
use Modules\CategoryModule\Services\TrademarkService;

class TrademarkController extends Controller
{
public function __construct(){
    $this->middleware('permission:trademark-create',   ['only' => ['create','store']]);
    $this->middleware('permission:trademark-edit',     ['only' => ['edit','update']]);
    $this->middleware('permission:trademark-list',     ['only' => ['show', 'index']]);
    $this->middleware('permission:trademark-delete',   ['only' => ['destroy']]);
    $this->middleware('permission:trademark-activate', ['only' => ['activate']]);
}
 /**
 * Display a listing of the resource.
 * @return Renderable
 */
public function index()
{
     $trademarks=Trademark::get();
    return view('categorymodule::dashboard.trademarks.index',compact('trademarks'));
}

/**
 * Show the form for creating a new resource.
 * @return Renderable
 */
public function create()
{
    return view('categorymodule::dashboard.trademarks.create');
}

/**
 * Store a newly created resource in storage.
 * @param Request $request
 * @return Renderable
 */
public function store(TrademarkRequest $request)
{
    $trdemark    = new TrademarkService();
    $trdemark   ->setUserID(auth()->user()->id)
                ->setName($request->name)
                ->setImage($request->image)
                ->createTrademark();

    return redirect()->route("trademarks.index")->with('success', 'تم اضافة  بنجاح');
}

// /**
//  * Show the specified resource.
//  * @param int $id
//  * @return Renderable
//  */
// public function show($id)
// {
//     return view('categorymodule::dashboard.trademarks.show');
// }

/**
 * Show the form for editing the specified resource.
 * @param int $id
 * @return Renderable
 */
public function edit($id)
{
    $trademark =Trademark::find($id);
    if (!$trademark) {
        return redirect()->route('dashboard')->with('failed',"trademark Not Found");
    }
    return view('categorymodule::dashboard.trademarks.edit',compact('trademark'));
}

/**
 * Update the specified resource in storage.
 * @param Request $request
 * @param int $id
 * @return Renderable
 */
public function update(Request $request, $id)
{
    $request->validate([
            'name'     => 'required|string|unique:trademarks,name,'. $id,
        ]);

        $trademark = Trademark::find($id);
        if(!$trademark){
            return redirect()->route('dashboard')->with('failed',"trademark Not Found");
        }

    $trademarkUpdate = new TrademarkService();
    $trademarkUpdate -> setName($request->name);
                     if($request->has('image')){
                     $trademarkUpdate->updateImg($request->image,$trademark->image);
                     }
    $trademarkUpdate->updateTrademark($trademark);

    return redirect()->route("trademarks.index")->with('success', 'تم التعديل  بنجاح');
}

/**
 * Remove the specified resource from storage.
 * @param int $id
 * @return Renderable
 */
public function destroy($id)
{
    $trademark=Trademark::find($id);
    if (!$trademark) {
        return redirect()->route('dashboard')->with('failed',"trademark Not Found");
    }
    $trademark->delete();
}

public function activate($id)
{
    $trademark=Trademark::find($id);
    if (!$trademark) {
        return redirect()->route('dashboard')->with('failed',"trademark Not Found");
    }
    $trademark->is_active = !$trademark->is_active;
    $trademark->save();
}
}
