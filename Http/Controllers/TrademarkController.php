<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Trademark;
use Modules\Category\Http\Requests\TrademarkRequest;
use Modules\Category\Services\TrademarkService;

class TrademarkController extends Controller
{
public function __construct(){
    $this->middleware('permission:trademark-create',   ['only' => ['create','store']]);
    $this->middleware('permission:trademark-edit',     ['only' => ['edit','update']]);
    $this->middleware('permission:trademark-list',     ['only' => ['show', 'index']]);
    $this->middleware('permission:trademark-delete',   ['only' => ['destroy']]);
    $this->middleware('permission:trademark-activate', ['only' => ['activate']]);
}

public function index()
{
     $trademarks=Trademark::get();
    return view('category::dashboard.trademarks.index',compact('trademarks'));
}


public function create()
{
    return view('category::dashboard.trademarks.create');
}


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
//     return view('category::dashboard.trademarks.show');
// }


public function edit($id)
{
    $trademark =Trademark::find($id);
    if (!$trademark) {
        return redirect()->route('dashboard')->with('failed',"trademark Not Found");
    }
    return view('category::dashboard.trademarks.edit',compact('trademark'));
}

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
