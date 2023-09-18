@extends('layout.cms')


@section('pageName')
    Satış Ekle
@endsection

@section('extraCss')
    <style>


        .transparent-button {
            background: none;
            border: none;
            color: white;
            font-size: 16px;

        }

        table {
            border-collapse: collapse;
            border: 1px solid #bbbbbb;
        }

        select.form-control {
            padding: 12px 20px;
            font-size: 14px;
            border-radius: 4px;
            border: 2px solid #bbbbbb;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="text"] {
            padding: 8px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #bbbbbb;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="number"] {
            padding: 8px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #bbbbbb;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="decimal"] {
            padding: 8px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #bbbbbb;
            width: 100%;
            box-sizing: border-box;
        }

        .btn {
            padding: 6px 12px;
            font-size: 14px;
            border-radius: 4px;
        }

        .form-group {
            margin-bottom: 20px;
        }


        .card-header {

        }

        .card-body {
            padding: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;


        }

        .table th,
        .table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #bbbbbb;
        }

        th:not(:last-child),
        td:not(:last-child) {
            border-right: 1px solid #ffffff;
        }

        .table th {
            background-color: #3579f6;
            color: #fff;
            font-weight: normal;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #ffffff;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #000000;
            color: white;
            text-decoration: none;
            cursor: pointer;
            border: none;
            border-radius: 4px;
        }

        .button:hover {
            background-color: #bbbbbb;
        }

        .button:focus {
            outline: none;
        }

        .result-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .result-text {
            font-size: 18px;
            font-weight: bold;
        }
    </style>

@endsection


@section("content")
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Satış Ekleme Formu</h3>
            </div>
            <form id="form" action="{{ route('sales.update', $salesEdit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="customer">Müşteri:</label>
                        <select class="form-control" id="customer_id" name="customer_id">
                            @foreach($customers as $customer)
                                @if($customer->status==true)
                                    <option value="{{ $customer->id }}"
                                            @if($customer->id == $salesEdit->customer_id) selected @endif >{{ $customer->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tarih">Satış Tarihi:</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{$salesEdit->date }}">
                    </div>
                    <div class="form-group">
                        <div class="card">
                            <div class="card-body p-10">
                                <table id="myTable" class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th style="width: 45%">Ürün</th>
                                        <th style="width: 20%">Miktar</th>
                                        <th style="width: 20%">Fiyat</th>
                                        <th style="width: 15%">Sil
                                            <button type="button" style="float: right" class="transparent-button"
                                                    onclick="addRow()">
                                                <i class="fa fa-plus fa-sm"></i>
                                            </button>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($salesItem as $item)
                                        <tr>
                                            <td>
                                                <select class="form-control" name="product_id[]">
                                                    @foreach($products as $product)
                                                        @if($product->status==true)
                                                        <option value="{{ $product->id }}"
                                                                @if($product->id == $item->product_id) selected @endif >{{ $product->name }}
                                                        </option>
                                                        @endif
                                                    @endforeach
                                                </select></td>
                                            <td>
                                                <input value="{{$item->quantity}}" class="column1" type="number" name="quantity[]"
                                                       oninput="calculateTotal()">
                                            </td>
                                            <td>
                                                <input value="{{$item->price}}" class="column2" type="decimal" name="price[]"
                                                       oninput="calculateTotal()">
                                            </td>
                                            <td>
                                                <button name="delete" type="button" class="btn btn-danger btn-sm"
                                                        title="Sil" onclick="deleteRow(this)"><i
                                                            class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <p class="form-control" id="result"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus fa-sm"></i> KAYDET</button>
                </div>
            </form>
            <div id="response"></div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        function addRow() {
            $("#myTable tbody").append('' +
                '<tr>' +
                '<td><select class="form-control" name="product_id[]"></select></td>' +
                '<td><input class="column1" type="number" name="quantity[]" oninput="calculateTotal()"></td>' +
                '<td><input class="column2" type="decimal" name="price[]" oninput="calculateTotal()"></td>' +
                '<td> <button name="delete" type="button" class="btn btn-danger btn-sm" title="Sil" onclick="deleteRow(this)"><i class="fas fa-trash"></i> </button></td>' +
                '</tr>');

            $(document).on('change', '.column1, .column2', function () {
                calculateTotal();
            });


            var selectElement = document.createElement("select");
            selectElement.className = "form-control";
            selectElement.name = "product_id[]";

            @foreach($products as $product)
            @if($product->status==true)
            var option = document.createElement("option");
            option.value = "{{ $product->id }}";
            option.textContent = "{{ $product->name }}";
            selectElement.appendChild(option);
            @endif
            @endforeach
            var tableRow = $("#myTable tbody tr:last");
            tableRow.find("td:first").html(selectElement);
        }

        function deleteRow(button) {
            $(button).closest('tr').remove();
            calculateTotal();
        }

        function calculateTotal() {
            var total = 0;
            $('.column1').each(function (index) {
                var val1 = parseFloat($(this).val());
                var val2 = parseFloat($('.column2:eq(' + index + ')').val());
                if (!isNaN(val1) && !isNaN(val2)) {
                    total += val1 * val2;
                }
            });
            $('#result').text('Toplam tutar: ' + total + ' ₺');
        }
    </script>

@endsection
