<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Functions\Helper;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    public function typeProject(){
        $types = Type::all();
        return view('admin.types.type-project', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exist = Type::where('name', $request->name)->first();
        if($exist){
            return redirect()->route('admin.types.index')->with('error', 'Type already exist');
        }else{
            $new_type = new Type();
            $new_type->name = $request->name;
            $new_type->slug = Helper::generateSlug($request->name, Type::class);
            $new_type->save();
            return redirect()->route('admin.types.index')->with('success', 'Type created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $val_edit_data = $request->validate([
            'name' =>'required|max:50',
        ]);

        $exist = Type::where('name', $request->name)->first();
        if($exist){
            return redirect()->route('admin.types.index')->with('error', 'Type already exist');
        }

        $val_edit_data['slug'] = Helper::generateSlug($request->name, Type::class);

        $type->update($val_edit_data);

        return redirect()->route('admin.types.index')->with('success', 'Type updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('success', 'Type deleted');
    }
}
