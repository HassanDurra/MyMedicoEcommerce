<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public $parentModel = Category::class;
    public $parentView  = 'Admin.Category';

    public function index(){
        $data['category'] = $this->parentModel::withoutTrashed()->paginate(20);
        return view($this->parentView.'.index')->with('data' , $data);
    }
    public function trash(){
        $data['category'] = $this->parentModel::onlyTrashed()->paginate(20);
        return view($this->parentView.'.trash')->with('data' , $data);
    }

    public function create($id = null){
        $data['category'] = $this->parentModel::where('id' , $id)->first();
        $data['action'] = $data['category'] != null ? 'edit' : 'create';
        return view($this->parentView.'.create')->with('data' , $data);
    }
    public function store(Request $request , $id = null){
        $data  = $request->except('_token');
        $storeCategory = $this->parentModel::updateOrCreate(['id' => $id] , $data);
        if($storeCategory){
            return redirect(route('category.index'))->with('success' , 'Category has been Saved..!');
        }else{
            return redirect()->back()->with('error' , 'Failed to Save Category..!');
        }
    }
    public function delete($id = null){
        $delete  = $this->parentModel::where('id' , $id)->delete();
        if($delete){
            return redirect()->route('category.index')->with('success' , 'category Has been sent to trash..!');
        }
        else{
            return redirect()->back()->with('error' , 'Failed to Delete category..!');
        }
    }
    public function restore($id = null){
        $delete  = $this->parentModel::where('id' , $id)->restore();
        if($delete){
            return redirect()->route('category.index')->with('success' , 'category Has been Restored..!');
        }
        else{
            return redirect()->back()->with('error' , 'Failed to Restore category..!');
        }
    }
    public function destroy($id = null){
        $delete  = $this->parentModel::where('id' , $id)->forceDelete();
        if($delete){
            return redirect()->route('category.index')->with('success' , 'category Has been Deleted..!');
        }
        else{
            return redirect()->back()->with('error' , 'Failed to Delete category..!');
        }
    }
}
