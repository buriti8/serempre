<?php

namespace App\Http\Controllers\ProjectControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = [];

        if ($request->has('q')) {
            $search = $request->get('q', []);
        } else {
            $search = get_last_user_search('cities', []);
        }

        set_last_user_search('cities', $search);

        $per_page = module_per_page('cities', 20);
        $cities = City::search($search)->paginate($per_page);
        $cities->appends($search + ['per_page' => $per_page]);

        return view('cities.index', [
            'search' => $search,
            'cities' => $cities,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(City $cities)
    {
        return view("cities.create", [
            'cities' => $cities,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCityRequest $request)
    {
        try {
            DB::beginTransaction();

            $cities = new City($request->validated());

            if ($cities->save()) {
                Session::flash('success', __('cities.created', ['name' => $cities->name]));
                DB::commit();
            } else {
                Session::flash('error', __('cities.error', ['name' => $cities->name, 'action' => 'crear']));
                DB::rollBack();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect('cities');
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
        $cities = City::findOrFail($id);

        return view("cities.edit", [
            'cities' => $cities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $cities = City::findOrFail($id);

            if ($cities->update($request->validated())) {
                Session::flash('success', __('cities.updated', ['name' => $cities->name]));
                DB::commit();
            } else {
                Session::flash('error', __('cities.error', ['name' => $cities->name, 'action' => 'actualizar']));
                DB::rollBack();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect('cities');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cities = City::findOrFail($id);

        try {
            $cities->delete();
            Session::flash('success', __('cities.deleted', ['name' => $cities->name]));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', __('cities.delete_error', ['name' => $cities->name]));
        }

        return redirect('/cities');
    }
}
