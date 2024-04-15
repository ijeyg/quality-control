@extends('layouts.panel',['title' => 'فرم بازرسی واحد کنترل کیفیت'])
@section('body')
    <style>
        .col-md-05 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 8%;
            max-width: none;
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 3px;
            padding-left: 3px;
        }

        .row-no-wrapp {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: nowrap;
            margin-right: -15px;
            margin-left: -15px;
        }
    </style>
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h3 class="text-themecolor">فرم بازرسی واحد کنترل کیفیت
                @if(Request()->search)
                    <small>جستجو برای {{ Request()->search }}</small>
                @endif
            </h3>
        </div>
    </div>
    <div class="container-fluid">
        @include('qualitycontrol::layouts.handleErrors')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">فرم بازرسی واحد کنترل کیفیت</h4>
                        <form action="{{route('unitinspection.store')}}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="code" class="form-label">کد مدرک</label>
                                    <input type="text" class="form-control" id="code" name="code">
                                </div>
                                <div class="col-md-6">
                                    <label for="shift" class="form-label">شیفت کاری</label>
                                    <select class="form-control" id="shift" name="shift">
                                        @foreach($formData['shifts'] as $key=> $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="period" class="form-label">نوبت کاری</label>
                                    <select class="form-control" id="period" name="period">
                                        @foreach($formData['periods'] as $key=> $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="head_shift_name" class="form-label">سرپرست شیفت کنترل کیفی</label>
                                    <input type="text" class="form-control" id="head_shift_name" name="head_shift_name">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="head_noonday" class="form-label">سرپرست روز کار کنترل کیفی</label>
                                    <input type="text" class="form-control" id="head_noonday" name="head_noonday">
                                </div>
                                <div class="col-md-6">
                                    <label for="period" class="form-label">محل بازرسی</label>
                                    <select class="form-control" id="place" name="place">
                                        @foreach($formData['places'] as $key=> $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-md-6">تاریخ:</label>
                                    <input type="hidden" name="created_at" value="{{ old('created_at') }}"
                                           id="tarikhEnd" class="form-control"/>
                                    <input id="tarikhTwo" type="text" class="form-control"
                                           value="{{\Morilog\Jalali\Jalalian::forge('today')->format('date')}}">
                                </div>
                            </div>

                            <!-- Values Input Section -->
                            <div id="valuesContainer" style="overflow-x: auto; max-width: 100%">
                                <div class="row-no-wrapp mb-3">
                                    <div class="col-md-2">
                                        <label for="machine_id_0" class="form-label">ماشین آلات</label>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="product_id_0" class="form-label">محصول</label>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="status_packaging_0" class="form-label">وضعیت بسته بندی</label>
                                    </div>
                                    <div class="col-md-05">
                                        <label for="status_packaging_0" class="form-label">تعداد مجاز</label>
                                    </div>
                                    <div class="col-md-05">
                                        <label for="water_0" class="form-label">آب</label>
                                    </div>
                                    <div class="col-md-05">
                                        <label for="oil_0" class="form-label">روغن</label>
                                    </div>
                                    <div class="col-md-05">
                                        <label for="pollution_0" class="form-label">آلودگی</label>
                                    </div>
                                    <div class="col-md-05">
                                        <label for="membrane_0" class="form-label">آسیب غشایی</label>
                                    </div>
                                    <div class="col-md-05">
                                        <label for="rupture_0" class="form-label">پارگی</label>
                                    </div>
                                    <div class="col-md-05">
                                        <label for="humidity_0" class="form-label">رطوبت</label>
                                    </div>
                                    <div class="col-md-05">
                                        <label for="burn_0" class="form-label">سوختگی</label>
                                    </div>
                                    <div class="col-md-05">
                                        <label for="wrinkles_0" class="form-label">تاخوردگی و چروک</label>
                                    </div>
                                    <div class="col-md-05">
                                        <label for="weight_0" class="form-label">نوسان وزن</label>
                                    </div>
                                    <div class="col-md-05">
                                        {{--                                        <label for="reject_weight_0" class="form-label">حذف</label>--}}
                                        {{--                                        <button type="button" class="form-control btn btn-danger" disabled onclick="deleteRow(this)"><i class="fa fa-close"></i></button>--}}
                                    </div>
                                </div>
                                <div class="row-no-wrapp mb-3">
                                    <div class="col-md-2">
                                        <select class="form-control" id="machine_id_0" name="values[0][machine_id]">
                                            @foreach($formData['machines'] as $key=> $value)
                                                <option value="{{$value->id}}">{{$value->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control" id="product_id_0" name="values[0][product_id]">
                                            @foreach($formData['products'] as $key=> $value)
                                                <option value="{{$value->id}}">{{$value->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <select class="form-control" id="status_packaging_0"
                                                name="values[0][status_packaging]">
                                            @foreach($formData['statuses'] as $key=> $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-05">
                                        <input type="number" class="form-control" id="count_0"
                                               name="values[0][count]" min="0" max="1000000000" step="0.01">
                                    </div>
                                    <div class="col-md-05">
                                        <input type="number" class="form-control" id="water_0"
                                               name="values[0][water]" min="0" max="1000000000" step="0.01">
                                    </div>
                                    <div class="col-md-05">
                                        <input type="number" class="form-control" id="oil_0"
                                               name="values[0][oil]" min="0" max="1000000000" step="0.01">
                                    </div>
                                    <div class="col-md-05">
                                        <input type="number" class="form-control" id="pollution_0"
                                               name="values[0][pollution]" min="0" max="1000000000" step="0.01">
                                    </div>
                                    <div class="col-md-05">
                                        <input type="number" class="form-control" id="membrane_0"
                                               name="values[0][membrane]" min="0" max="1000000000" step="0.01">
                                    </div>
                                    <div class="col-md-05">
                                        <input type="number" class="form-control" id="rupture_0"
                                               name="values[0][rupture]" min="0" max="1000000000" step="0.01">
                                    </div>
                                    <div class="col-md-05">
                                        <input type="number" class="form-control" id="humidity_0"
                                               name="values[0][humidity]" min="0" max="1000000000" step="0.01">
                                    </div>
                                    <div class="col-md-05">
                                        <input type="number" class="form-control" id="burn_0"
                                               name="values[0][burn]" min="0" max="1000000000" step="0.01">
                                    </div>
                                    <div class="col-md-05">
                                        <input type="number" class="form-control" id="wrinkles_0"
                                               name="values[0][wrinkles]" min="0" max="1000000000" step="0.01">
                                    </div>
                                    <div class="col-md-05">
                                        <input type="number" class="form-control" id="weight_0"
                                               name="values[0][weight]" min="0" max="1000000000" step="0.01">
                                    </div>
                                    <div class="col-md-05">
                                        {{--                                        <label for="reject_weight_0" class="form-label">حذف</label>--}}
                                        {{--                                        <button type="button" class="form-control btn btn-danger" disabled onclick="deleteRow(this)"><i class="fa fa-close"></i></button>--}}
                                    </div>
                                </div>

                            </div>
                                <button type="button" class="btn btn-success" onclick="addValues()">اضافه کردن ردیف
                                </button>
                                <button type="submit" class="btn btn-primary">ثبت فرم</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        var tarikh = $('#tarikhTwo').persianDatepicker({
            altField: '#tarikhEnd',
            altFormat: 'X',
            initialValueType: 'persian',
            format: 'D MMMM YYYY',
            timePicker: {
                enabled: true,
                meridiem: {
                    enabled: true
                }
            }
        });
    </script>
    <script>
        let valueIndex = 1;

        function addValues() {
            let valuesContainer = document.getElementById('valuesContainer');

            let newIndex = Date.now(); // Use timestamp as a unique index

            let newValuesDiv = document.createElement('div');
            newValuesDiv.className = 'row-no-wrapp mb-3';

            let fields = [
                'machine_id',
                'product_id',
                'status_packaging',
                'count',
                'water',
                'oil',
                'pollution',
                'membrane',
                'rupture',
                'humidity',
                'burn',
                'wrinkles',
                'weight',
            ];

            fields.forEach(function (field, index) {
                let colDiv = document.createElement('div');
                colDiv.className = index === 1 || index === 0 ? 'col-md-2' : (index === 2 ? 'col-md-1' : 'col-md-05'); // Set col width

                let input;
                if (field === 'product_id') {
                    input = document.createElement('select');
                    input.className = 'form-control';
                    input.id = `${field}_${newIndex}`;
                    input.name = `values[${newIndex}][${field}]`;

                    // Clone the options from the original select
                    let originalSelect = document.getElementById(`${field}_0`);
                    for (let i = 0; i < originalSelect.options.length; i++) {
                        let option = originalSelect.options[i].cloneNode(true);
                        input.appendChild(option);
                    }
                } else if (field === 'machine_id') {
                    input = document.createElement('select');
                    input.className = 'form-control';
                    input.id = `${field}_${newIndex}`;
                    input.name = `values[${newIndex}][${field}]`;

                    // Clone the options from the original select
                    let originalSelect = document.getElementById(`${field}_0`);
                    for (let i = 0; i < originalSelect.options.length; i++) {
                        let option = originalSelect.options[i].cloneNode(true);
                        input.appendChild(option);
                    }
                } else if (field === 'status_packaging') {
                    input = document.createElement('select');
                    input.className = 'form-control';
                    input.id = `${field}_${newIndex}`;
                    input.name = `values[${newIndex}][${field}]`;

                    // Clone the options from the original select
                    let originalSelect = document.getElementById(`${field}_0`);
                    for (let i = 0; i < originalSelect.options.length; i++) {
                        let option = originalSelect.options[i].cloneNode(true);
                        input.appendChild(option);
                    }
                } else {
                    input = document.createElement('input');
                    input.type = 'number';
                    input.className = 'form-control';
                    input.id = `${field}_${newIndex}`;
                    input.name = `values[${newIndex}][${field}]`;
                    input.min = "0"
                    input.max = "1000000000"
                    input.step = "0.01"
                }

                colDiv.appendChild(input);
                newValuesDiv.appendChild(colDiv);
            });

            // Add delete button with icon
            let deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.className = 'btn btn-danger';
            deleteButton.innerHTML = '<i class="fa fa-close"></i>'; // Set innerHTML to add the icon
            deleteButton.onclick = function () {
                deleteRow(this);
            };

            let deleteColumn = document.createElement('div');
            deleteColumn.className = 'col-sm-auto';
            deleteColumn.appendChild(deleteButton);
            newValuesDiv.appendChild(deleteColumn);

            valuesContainer.appendChild(newValuesDiv);
            valueIndex += 1;
        }

        function deleteRow(button) {
            let row = button.parentNode.parentNode; // Get the parent row
            row.parentNode.removeChild(row); // Remove the row from the DOM
        }
    </script>
@endsection
