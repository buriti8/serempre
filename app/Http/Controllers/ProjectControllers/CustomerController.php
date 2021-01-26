<?php

namespace App\Http\Controllers\ProjectControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
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
            $search = get_last_user_search('customers', []);
        }

        set_last_user_search('customers', $search);

        $per_page = module_per_page('customers', 20);
        $customers = Customer::search($search)->paginate($per_page);
        $customers->appends($search + ['per_page' => $per_page]);

        return view('customers.index', [
            'search' => $search,
            'customers' => $customers,
        ] + Customer::getArrayList());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Customer $customers)
    {
        return view("customers.create", [
            'customers' => $customers,
        ] + Customer::getArrayList());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCustomerRequest $request)
    {
        try {
            DB::beginTransaction();

            $customers = new Customer($request->validated());

            if ($customers->save()) {
                Session::flash('success', __('customers.created', ['name' => $customers->name]));
                DB::commit();
            } else {
                Session::flash('error', __('customers.error', ['name' => $customers->name, 'action' => 'crear']));
                DB::rollBack();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect('customers');
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
        $customers = Customer::findOrFail($id);

        return view("customers.edit", [
            'customers' => $customers,
        ] + Customer::getArrayList());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $customers = Customer::findOrFail($id);

            if ($customers->update($request->validated())) {
                Session::flash('success', __('customers.updated', ['name' => $customers->name]));
                DB::commit();
            } else {
                Session::flash('error', __('customers.error', ['name' => $customers->name, 'action' => 'actualizar']));
                DB::rollBack();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect('customers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customers = Customer::findOrFail($id);

        try {
            $customers->delete();
            Session::flash('success', __('customers.deleted', ['name' => $customers->name]));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', __('customers.delete_error', ['name' => $customers->name]));
        }

        return redirect('/customers');
    }
}
