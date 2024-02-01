<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public $parentModel =  SubCategory::class;
    public $secondModel =  Category::class;
    public $parentView  =  'Admin.SubCategory';

    public function index(){
        $data['category'] = $this->parentModel::with('category')->withoutTrashed()->paginate(20);
        return view($this->parentView.'.index')->with('data' , $data);
    }
    public function trash(){
        $data['category'] = $this->parentModel::with('category')->onlyTrashed()->paginate(20);
        return view($this->parentView.'.trash')->with('data' , $data);
    }

    public function create($id = null){
        $data['subcategory'] = $this->parentModel::where('id' , $id)->first();
        $data['category']    = $this->secondModel::withoutTrashed()->get();
        $data['action'] = $data['subcategory'] != null ? 'edit' : 'create';
        return view($this->parentView.'.create')->with('data' , $data);
    }
    public function store(Request $request , $id = null){
        $data  = $request->except('_token');
        foreach($data['name'] as $key => $value){
            $storeCategory = $this->parentModel::updateOrCreate(['id' => $id] ,[
                'category_id' => $data['category_id'],
                'name'        => $data['name'][$key],
            ]);
        }
        if($storeCategory){
            return redirect(route('subcategory.index'))->with('success' , 'Sub Category has been Saved..!');
        }else{
            return redirect()->back()->with('error' , 'Failed to Save Sub Category..!');
        }
    }
    public function delete($id = null){
        $delete  = $this->parentModel::where('id' , $id)->delete();
        if($delete){
            return redirect()->route('subcategory.index')->with('success' , 'category Has been sent to trash..!');
        }
        else{
            return redirect()->back()->with('error' , 'Failed to Delete category..!');
        }
    }
    public function restore($id = null){
        $delete  = $this->parentModel::where('id' , $id)->restore();
        if($delete){
            return redirect()->route('subcategory.index')->with('success' , 'category Has been Restored..!');
        }
        else{
            return redirect()->back()->with('error' , 'Failed to Restore category..!');
        }
    }
    public function destroy($id = null){
        $delete  = $this->parentModel::where('id' , $id)->forceDelete();
        if($delete){
            return redirect()->route('subcategory.index')->with('success' , 'category Has been Deleted..!');
        }
        else{
            return redirect()->back()->with('error' , 'Failed to Delete category..!');
        }
    }
}
