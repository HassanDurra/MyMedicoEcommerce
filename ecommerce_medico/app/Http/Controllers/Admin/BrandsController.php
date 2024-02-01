<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brands;
class BrandsController extends Controller
{
    public $parentModel = Brands::class;
    public $parentView  = 'Admin.Brand';

    public function index(){
        $data['brand'] = $this->parentModel::withoutTrashed()->paginate(20);
        return view($this->parentView.'.index')->with('data' , $data);
    }
    public function trash(){
        $data['brand'] = $this->parentModel::onlyTrashed()->paginate(20);
        return view($this->parentView.'.trash')->with('data' , $data);
    }

    public function create($id = null){
        $data['brands'] = $this->parentModel::where('id' , $id)->first();
        $data['action'] = $data['brands'] != null ? 'edit' : 'create';
        return view($this->parentView.'.create')->with('data' , $data);
    }
    // Storing and updating brands
    public function store(Request $request , $id = null){
        $data = $request->except('_token');
        if($request->hasFile('image')){
            $data['image'] = time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file("image")->move('Admin/Brands/' , $data['image']);
        }
        $storeData  = $this->parentModel::create($data);
        if($storeData){
            return redirect()->route('brands.index')->with('success' , 'Brand Has been created..!');
        }
        else{
            return redirect()->back()->with('error' , 'Failed to create brand..!');
        }
    }
    public function update(Request $request , $id = null){
        $data            = $request->except('_token');
        $brand          = $this->parentModel::where('id' , $id)->first();
        $updateBrand     = $this->parentModel::where("id" , $id)->update($data);
        if($request->hasFile('image')){
            $unlinkImage   =     public_path('Admin/Brands/' . $brand->image);
            if(file_exists($unlinkImage)){
                unlink($unlinkImage);
            }
            $data['image'] = time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file("image")->move('Admin/Brands/' , $data['image']);

            $updateBrand   = $this->parentModel::where('id' , $id)->update($data);
        }
        if($updateBrand){
            return redirect()->route('brands.index')->with('success' , 'Brand Has been Updated..!');
        }
        else{
            return redirect()->back()->with('error' , 'Failed to Update brand..!');
        }
    }
    public function delete($id = null){
        $delete  = $this->parentModel::where('id' , $id)->delete();
        if($delete){
            return redirect()->route('brands.index')->with('success' , 'Brand Has been sent to trash..!');
        }
        else{
            return redirect()->back()->with('error' , 'Failed to Delete brand..!');
        }
    }
    public function restore($id = null){
        $delete  = $this->parentModel::where('id' , $id)->restore();
        if($delete){
            return redirect()->route('brands.index')->with('success' , 'Brand Has been Restored..!');
        }
        else{
            return redirect()->back()->with('error' , 'Failed to Restore brand..!');
        }
    }
    public function destroy($id = null){
        $delete  = $this->parentModel::where('id' , $id)->forceDelete();
        if($delete){
            return redirect()->route('brands.index')->with('success' , 'Brand Has been Deleted..!');
        }
        else{
            return redirect()->back()->with('error' , 'Failed to Delete brand..!');
        }
    }
}
