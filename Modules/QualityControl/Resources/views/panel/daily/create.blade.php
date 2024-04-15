@extends('layouts.panel',['title' => 'فرم گزارش روزانه'])
@section('body')
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h3 class="text-themecolor">فرم گزارش روزانه کارکرد واحد کنترل کیفیت
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
                        <h4 class="card-title">فرم گزارش روزانه کارکرد واحد کنترل کیفیت</h4>
                        <form action="{{route('daily.store')}}" method="post">
                            @csrf

                            <!-- Values Input Section -->

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
                                    <label for="head_shift_name" class="form-label">سرپرست شیفت کنترل
                                        کیفی</label>
                                    <input type="text" class="form-control" id="head_shift_name"
                                           name="head_shift_name">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="col-md-6">تاریخ:</label>
                                    <input type="hidden" name="created_at" value="{{ old('created_at') }}"
                                           id="tarikhEnd" class="form-control"/>
                                    <input id="tarikhTwo" type="text" class="form-control"
                                           value="{{\Morilog\Jalali\Jalalian::forge('today')->format('date')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="head_noonday" class="form-label">سرپرست روز کار کنترل
                                        کیفی</label>
                                    <input type="text" class="form-control" id="head_noonday"
                                           name="head_noonday">
                                </div>
                            </div>
                            <!-- Values Input Section -->
                            <div id="valuesContainer">
                                <div class="row mb-3">
                                    <div class="col-md-2">
                                        <label for="machine_id_0" class="form-label">ماشین آلات</label>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="product_id_0" class="form-label">محصول</label>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="delivery_weight_0" class="form-label">وزن تحویلی</label>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="accept_weight_0" class="form-label">وزن اکسپت</label>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="reject_weight_0" class="form-label">وزن ریجکت</label>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="box_numbers_0" class="form-label">تعداد باکس</label>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="description_0" class="form-label">توضیحات</label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-2">
                                        <select class="form-control" id="machine_id_0"
                                                name="values[0][machine_id]">
                                            @foreach($formData['machines'] as $key=> $value)
                                                <option value="{{$value->id}}">{{$value->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control" id="product_id_0"
                                                name="values[0][product_id]">
                                            @foreach($formData['products'] as $key=> $value)
                                                <option value="{{$value->id}}">{{$value->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="number" class="form-control" id="delivery_weight_0"
                                               name="values[0][delivery_weight]" min="0" max="1000000000" step="0.01">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="number" class="form-control" id="accept_weight_0"
                                               name="values[0][accept_weight]" min="0" max="1000000000" step="0.01">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="number" class="form-control" id="reject_weight_0"
                                               name="values[0][reject_weight]" min="0" max="1000000000" step="0.01">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="number" class="form-control" id="box_numbers_0"
                                               name="values[0][box_numbers]" min="0" max="1000000000" step="0.01">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" id="description_0"
                                               name="values[0][description]">
                                    </div>
                                    <div class="col-md-1">
                                        {{--                                        <label for="reject_weight_0" class="form-label">حذف</label>--}}
                                        {{--                                        <button type="button" class="form-control btn btn-danger" disabled onclick="deleteRow(this)"><i class="fa fa-close"></i></button>--}}
                                    </div>
                                </div>

                            </div>

                                <button type="button" class="btn btn-success" onclick="addValues()">اضافه کردن
                                    ردیف
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
            newValuesDiv.className = 'row mb-3';

            let fields = ['machine_id', 'product_id', 'delivery_weight', 'accept_weight', 'reject_weight', 'box_numbers', 'description'];

            fields.forEach(function (field, index) {
                let colDiv = document.createElement('div');
                colDiv.className = index === 0 || index === 1 || index === 6 ? 'col-md-2' : 'col-md-1'; // Set col width

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
                } else if (field === 'delivery_weight' || field === 'accept_weight' || field === 'reject_weight') {
                    input = document.createElement('input');
                    input.type = 'number';
                    input.className = 'form-control';
                    input.id = `${field}_${newIndex}`;
                    input.name = `values[${newIndex}][${field}]`;
                    input.min = "0"
                    input.max = "1000000000"
                    input.step = "0.01"
                } else {
                    input = document.createElement('input');
                    input.type = 'text';
                    input.className = 'form-control';
                    input.id = `${field}_${newIndex}`;
                    input.name = `values[${newIndex}][${field}]`;
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
            deleteColumn.className = 'col-md-1';
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
