<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();

        return view('customer.index', ["customers" => $customers]);
    }

    public function add()
    {
        return view('customer.add');
    }

    public function edit($customerID)
    {

        $customerEdit = Customer::find($customerID);
        return view('customer.edit', ["customerEdit" => $customerEdit]);
    }

    public function delete($id)
    {
        $customerDelete = Customer::find($id);
        $customerDelete->status = false;
        $customerDelete->update();

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:40',
            'phone' => 'required|string|min:10|max:18|unique:customers,phone',
            'address' => 'required|string|max:255',
            'mail' => 'required|email|max:50|unique:customers,mail',
        ], [
        ], ["name" => "İsim", "phone" => "Telefon", "address" => "Adres", "mail" => "Mail"]);

        if ($validator->fails()) {
            return $this->responseMessage(implode(' ', $validator->errors()->all()), "error", 400);
        }

        $customer = Customer::find($id);
        $customer->name = $request->input('name');
        $customer->phone = $request->input('phone');
        $customer->address = $request->input('address');
        $customer->mail = $request->input('mail');
        $customer->update();

        return $this->responseMessage("İşlem Başarılı", "success", 200, '/customers');


    }

    public function show($CustomerID)
    {
        $customer = Customer::with("sales.items.product")->find($CustomerID);
        return view('customer.show', ["customer" => $customer]);
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:40',
            'phone' => 'required|string|min:10|max:18|unique:customers,phone',
            'address' => 'required|string|max:255',
            'mail' => 'required|email|max:50|unique:customers,mail',
        ], [
        ], ["name" => "İsim", "phone" => "Telefon", "address" => "Adres", "mail" => "Mail"]);

        if ($validator->fails()) {
            return $this->responseMessage(implode(' ', $validator->errors()->all()), "error", 400);
        }

        $data = $request->all();


        $stock = new Customer();
        $stock->fill($data)->save();


        return $this->responseMessage("Başarılı.", "success", 200, route('customer.add'));
    }
}
