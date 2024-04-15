@extends('layouts.panel',['title' => 'فرم بازرسی واحد کنترل کیفیت'])
@section('body')
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h3 class="text-themecolor">فرم بازرسی واحد کنترل کیفیت
                @if(Request()->search)
                    <small>جستجو برای {{ Request()->search }}</small>
                @endif
            </h3>
        </div>
    </div>
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
    <div class="container-fluid">
        @include('qualitycontrol::layouts.handleErrors')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">فرم بازرسی واحد کنترل کیفیت</h4>
                        <form
                            action="{{route('unitinspection.update',['unitinspection' => $formData['unitInspection']['id']])}}"
                            method="post">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="code" class="form-label">کد مدرک</label>
                                    <input type="text" class="form-control" id="code" name="code"
                                           value="{{$formData['unitInspection']['code']}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="shift" class="form-label">شیفت کاری</label>
                                    <select class="form-control" id="shift" name="shift">
                                        @foreach($formData['shifts'] as $key=> $value)
                                            <option
                                                value="{{$key}}" {{ $formData['unitInspection']->shift == $key ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="period" class="form-label">نوبت کاری</label>
                                    <select class="form-control" id="period" name="period">
                                        @foreach($formData['periods'] as $key=> $value)
                                            <option
                                                value="{{$key}}" {{ $formData['unitInspection']->period == $key ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="head_shift_name" class="form-label">سرپرست شیفت کنترل کیفی</label>
                                    <input type="text" class="form-control" id="head_shift_name" name="head_shift_name"
                                           value="{{$formData['unitInspection']['head_shift_name']}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="head_noonday" class="form-label">سرپرست روز کار کنترل کیفی</label>
                                    <input type="text" class="form-control" id="head_noonday" name="head_noonday"
                                           value="{{$formData['unitInspection']['head_noonday']}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="period" class="form-label">محل بازرسی</label>
                                    <select class="form-control" id="place" name="place">
                                        @foreach($formData['places'] as $key=> $value)
                                            <option
                                                value="{{$key}}" {{ $formData['unitInspection']->place == $key ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" id="tarikhTwoLable"> تاریخ ثبت
                                        شده: {{\Morilog\Jalali\Jalalian::forge($formData['unitInspection']->created_at)->format('d %B Y')}}</label>
                                    <input type="hidden" name="created_at"
                                           value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$formData['unitInspection']->created_at)->timestamp  }}"
                                           id="tarikhEnd" class="form-control"/>
                                    <input id="tarikhTwo" type="text" class="form-control" disabled="true"
                                           value="{{\Morilog\Jalali\Jalalian::forge($formData['unitInspection']->created_at)->format('d %B Y')}}">
                                </div>
                            </div>

                            <!-- Values Input Section -->
                            <div id="valuesContainer" style="overflow-x: auto; max-width: 100%">
                                <div class="row-no-wrapp mb-3">
                                    <div class="col-md-2">
                                        <label for="product_id_0" class="form-label">ماشین آلات</label>
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
                                        <label for="total_0" class="form-label">تعداد کل</label>
                                    </div>
                                    <div class="col-md-05">

                                    </div>
                                </div>
                                @foreach($formData['unitInspection']->values as $key => $value)
                                    <div class="row-no-wrapp mb-3">
                                        <div class="col-md-2">
                                            <select class="form-control" id="machine_id_{{ $value->id }}"
                                                    name="values[{{ $value->id }}][machine_id]">
                                                @foreach($formData['machines'] as $key=> $machine)
                                                    <option
                                                        value="{{$machine->id}}" {{ $value->machine_id == $machine->id ? 'selected' : '' }}>{{$machine->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control" id="product_id_{{ $value->id }}"
                                                    name="values[{{ $value->id }}][product_id]">
                                                @foreach($formData['products'] as $key=> $product)
                                                    <option
                                                        value="{{$product->id}}" {{ $value->product_id == $product->id ? 'selected' : '' }}>{{$product->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <select class="form-control" id="status_packaging_{{ $value->id }}"
                                                    name="values[{{ $value->id }}][status_packaging]">
                                                @foreach($formData['statuses'] as $key=> $status)
                                                    <option
                                                        value="{{$key}}" {{ $value->status_packaging == $key ? 'selected' : '' }}>{{$status}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-05">
                                            <input type="number" class="form-control" id="count_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][count]" value="{{ $value->count }}" min="0" max="1000000000" step="0.01">
                                        </div>
                                        <div class="col-md-05">
                                            <input type="number" class="form-control" id="water_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][water]" value="{{ $value->water }}" min="0" max="1000000000" step="0.01">
                                        </div>
                                        <div class="col-md-05">
                                            <input type="number" class="form-control" id="oil_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][oil]" value="{{ $value->oil }}" min="0" max="1000000000" step="0.01">
                                        </div>
                                        <div class="col-md-05">
                                            <input type="number" class="form-control" id="pollution_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][pollution]"
                                                   value="{{ $value->pollution }}" min="0" max="1000000000" step="0.01">
                                        </div>
                                        <div class="col-md-05">
                                            <input type="number" class="form-control" id="membrane_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][membrane]"
                                                   value="{{ $value->membrane }}" min="0" max="1000000000" step="0.01">
                                        </div>
                                        <div class="col-md-05">
                                            <input type="number" class="form-control" id="rupture_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][rupture]"
                                                   value="{{ $value->rupture }}" min="0" max="1000000000" step="0.01">
                                        </div>
                                        <div class="col-md-05">
                                            <input type="number" class="form-control" id="humidity_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][humidity]"
                                                   value="{{ $value->humidity }}" min="0" max="1000000000" step="0.01">
                                        </div>
                                        <div class="col-md-05">
                                            <input type="number" class="form-control" id="burn_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][burn]" value="{{ $value->burn }}" min="0" max="1000000000" step="0.01">
                                        </div>
                                        <div class="col-md-05">
                                            <input type="number" class="form-control" id="wrinkles_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][wrinkles]"
                                                   value="{{ $value->wrinkles }}" min="0" max="1000000000" step="0.01">
                                        </div>
                                        <div class="col-md-05">
                                            <input type="number" class="form-control" id="weight_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][weight]" value="{{ $value->weight }}" min="0" max="1000000000" step="0.01">
                                        </div>
                                        <div class="col-md-05">
                                            <div class="col-md-05">
                                                <input type="number" class="form-control" id="total_{{ $value->id }}"
                                                       name="values[{{ $value->id }}][total]"
                                                       value="{{ $value->total }}" min="0" max="1000000000" step="0.01">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="water" class="form-label">آب</label>

                                    <input type="number" class="form-control" id="water"
                                           name="water" disabled
                                           value="{{$formData['unitInspection']->water }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="oil" class="form-label">روغن</label>

                                    <input type="number" class="form-control" id="oil"
                                           name="oil" disabled
                                           value="{{$formData['unitInspection']->oil }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="pollution" class="form-label">آلودگی</label>

                                    <input type="number" class="form-control" id="pollution"
                                           name="pollution" disabled
                                           value="{{ $formData['unitInspection']->pollution }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="membrane" class="form-label">آسیب غشایی</label>

                                    <input type="number" class="form-control" id="membrane"
                                           name="membrane" disabled
                                           value="{{ $formData['unitInspection']->membrane }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="rupture" class="form-label">پارگی</label>

                                    <input type="number" class="form-control" id="rupture"
                                           name="rupture" disabled
                                           value="{{ $formData['unitInspection']->rupture }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="humidity" class="form-label">رطوبت</label>

                                    <input type="number" class="form-control" id="humidity"
                                           name="humidity" disabled
                                           value="{{ $formData['unitInspection']->humidity }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="burn" class="form-label">سوختگی</label>

                                    <input type="number" class="form-control" id="burn"
                                           name="burn" disabled
                                           value="{{ $formData['unitInspection']->burn }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="wrinkles" class="form-label">تاخوردگی و چروک</label>

                                    <input type="number" class="form-control" id="wrinkles"
                                           name="wrinkles" disabled
                                           value="{{ $formData['unitInspection']->wrinkles }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="weight" class="form-label">وزن</label>

                                    <input type="number" class="form-control" id="weight"
                                           name="weight" disabled
                                           value="{{ $formData['unitInspection']->weight }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="total_of_total" class="form-label">جمع تعداد کل</label>
                                    <input type="number" class="form-control" id="total_of_total"
                                           name="total_of_total" disabled
                                           value="{{ $formData['unitInspection']->total_of_total }}">
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
        $("#tarikhTwoLable").click(function () {
            $("#tarikhTwo").prop("disabled", false);
            $('#tarikhTwo').persianDatepicker({
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
        })
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
                    let originalSelect = document.getElementById(`${field}_{{$formData['unitInspection']->values[0]['id']}}`);
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
                    let originalSelect = document.getElementById(`${field}_{{$formData['unitInspection']->values[0]['id']}}`);
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
                    let originalSelect = document.getElementById(`${field}_{{$formData['unitInspection']->values[0]['id']}}`);
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
