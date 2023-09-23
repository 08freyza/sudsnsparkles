<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData = Customer::orderBy('id')->get()->toArray();

        $data = [
            'title' => 'Customer',
            'customer' => $getData
        ];

        return view('customers.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create', ['title' => 'Create Customer']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        if (Customer::create($request->validated())) {
            return redirect('admin/customer')->with('message', 'customerCreateSuccess');
        }

        return redirect()->to('admin/customer')->with('message', 'customerCreateFailed');
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
        $getData = Customer::where('id', $id)->first();

        $data = [
            'title' => 'Edit Customer',
            'customer' => $getData
        ];

        return view('customers.edit', $data);
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
        if (Customer::where('id', $id)->update($request->getValidatedData())) {
            return redirect('admin/customer')->with('message', 'customerUpdateSuccess');
        }

        return redirect()->to('admin/customer')->with('message', 'customerUpdateFailed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Customer::where('id', $id)->delete()) {
            return response()->json(['success' => 'deleteSuccess']);
        }

        return response()->json(['failed' => 'deleteFailed']);
    }
}
