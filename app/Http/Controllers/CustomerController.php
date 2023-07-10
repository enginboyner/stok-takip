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
        $userAuth = auth()->user();
        $roleAuth = Role::find($userAuth->role_id)->name;
        return view('customer.index', ["customers" => $customers, "userAuth" => $userAuth,"roleAuth"=>$roleAuth]);
    }

    public function add()
    {
        $userAuth = auth()->user();
        $roleAuth = Role::find($userAuth->role_id)->name;
        return view('customer.add', ["userAuth" => $userAuth,"roleAuth"=>$roleAuth]);
    }
    public function edit($customerID)
    {
        $userAuth = auth()->user();
        $roleAuth = Role::find($userAuth->role_id)->name;
        $customerEdit = Customer::find($customerID);
        return view('customer.edit',["customerEdit"=>$customerEdit,"userAuth" => $userAuth,"roleAuth"=>$roleAuth]);
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:40',
            'phone' => 'required|string|min:10|max:18|unique:customers,phone',
            'address' => 'required|string|max:255',
            'mail' => 'required|email|max:50|unique:customers,mail',
            'status' => 'required|bool',
        ], [
        ], ["name" => "İsim", "phone" => "Telefon", "address" => "Adres", "mail" => "Mail", "status" => "Durum"]);

        if ($validator->fails()) {
            return $this->responseMessage(implode(' ', $validator->errors()->all()), "error", 400);
        }

        $data = $request->all();


        $stock = new Customer();
        $stock->fill($data)->save();


        return $this->responseMessage("Başarılı.", "success", 200, route('customer.add'));
    }
}
