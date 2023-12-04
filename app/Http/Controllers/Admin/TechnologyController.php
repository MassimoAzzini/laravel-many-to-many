<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;
use App\Functions\Helper;
use App\Models\Project;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    public function projectsTechnologies (Technology $technology){
        return view('admin.technologies.projectTechnologies', compact('technology'));
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
        $exist = Technology::where('name', $request->name)->first();
        if($exist){
            return redirect()->route('admin.technologies.index')->with('error', 'Technology already exist');
        }else{
            $new_technology = new Technology();
            $new_technology->name = $request->name;
            $new_technology->link = $request->link;
            $new_technology->slug = Helper::generateSlug($request->name, Technology::class);
            $new_technology->save();
            return redirect()->route('admin.technologies.index')->with('success', 'Technology created');
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
    public function update(Request $request, Technology $technology)
    {
        $val_edit_data = $request->validate([
            'name' =>'required|max:50',
            'link' =>'max:255'
        ]);

        $exist = Technology::where('name', $request->name)->first();
        if($exist){
            return redirect()->route('admin.technologies.index')->with('error', 'Technology already exist');
        }

        $val_edit_data['slug'] = Helper::generateSlug($request->name, Technology::class);

        $technology->update($val_edit_data);

        return redirect()->route('admin.technologies.index')->with('success', 'Technology updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('success', 'Technology deleted');
    }
}
