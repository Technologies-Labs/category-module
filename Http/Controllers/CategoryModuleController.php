<?php

namespace Modules\CategoryModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CategoryModule\Entities\Category;
use Modules\CategoryModule\Services\CategoryService;
use Modules\CategoryModule\Http\Requests\CategoryRequest;
use App\Traits\UploadTrait;

class CategoryModuleController extends Controller
{
    public function __construct(){
        $this->middleware('permission:category-create',   ['only' => ['create','store']]);
        $this->middleware('permission:category-edit',     ['only' => ['edit','update']]);
        $this->middleware('permission:category-list',     ['only' => ['show', 'index']]);
        $this->middleware('permission:category-delete',   ['only' => ['destroy']]);
        $this->middleware('permission:category-activate', ['only' => ['activate']]);
    }
    // /**
    //  * Display a listing of the resource.
    //  * @return Renderable
    //  */
    public function index()
    {
        $categories=Category::get();
        return view('categorymodule::dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('categorymodule::dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CategoryRequest $request)
    {
        $category = new CategoryService();
        $category->setUserID(auth()->user()->id)
                 ->setName($request->name)
                 ->setOrder($request->order)
                 ->setImage($request->image)
                 ->createCategory();

        return redirect()->route("categories.index")->with('success', 'تم اضافة  بنجاح');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('categorymodule::dashboard.categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $category=Category::find($id);
        if (!$category) {
            return redirect()->route('dashboard')->with('failed',"Category Not Found");
        }
        return view('categorymodule::dashboard.categories.edit',compact('category'));
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
              'name'     => 'required|string|unique:categories,name,'. $id,
              'order'    => 'required|integer',
          ]);

          $category = Category::find($id);
          if(!$category){
              return redirect()->route('dashboard')->with('failed',"Category Not Found");
          }

        $categoryUpdate   = new CategoryService();
        $categoryUpdate-> setName($request->name)
                       -> setOrder($request->order);
                        if($request->has('image')){
                            $categoryUpdate->updateImg($request->image,$category->image);
                        }
        $categoryUpdate->updateCategory($category);

        return redirect()->route("categories.index")->with('success', 'تم التعديل  بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        if (!$category) {
            return redirect()->route('dashboard')->with('failed',"Category Not Found");
        }
        $category->delete();
        // return redirect()->back()->with('success',"Category deleted");
    }

    public function activate($id)
    {
        $category=Category::find($id);
        if (!$category) {
            return redirect()->route('dashboard')->with('failed',"Category Not Found");
        }
        $category->is_active = !$category->is_active;
        $category->save();
    }
}
