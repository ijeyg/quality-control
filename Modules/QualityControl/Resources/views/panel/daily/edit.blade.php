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
                        <h4 class="card-title">فرم ویرایش گزارش روزانه</h4>
                        <form action="{{ route('daily.update', ['daily' => $formData['daily']->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="code" class="form-label">کد مدرک</label>
                                    <input type="text" class="form-control" id="code" name="code"
                                           value="{{ $formData['daily']->code }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="shift" class="form-label">شیفت کاری</label>
                                    <select class="form-control" id="shift" name="shift">
                                        @foreach($formData['shifts'] as $key=> $value)
                                            <option
                                                value="{{$key}}" {{ $formData['daily']->shift == $key ? 'selected' : '' }}>{{$value}}</option>
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
                                                value="{{$key}}" {{ $formData['daily']->period == $key ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="head_shift_name" class="form-label">سرپرست شیفت کنترل کیفیت</label>
                                    <input type="text" class="form-control" id="head_shift_name" name="head_shift_name"
                                           value="{{ $formData['daily']->head_shift_name }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" id="tarikhTwoLable"> تاریخ ثبت
                                        شده: {{\Morilog\Jalali\Jalalian::forge($formData['daily']->created_at)->format('d %B Y')}}</label>
                                    <input type="hidden" name="created_at"
                                           value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$formData['daily']->created_at)->timestamp  }}"
                                           id="tarikhEnd" class="form-control"/>
                                    <input id="tarikhTwo" type="text" class="form-control" disabled="true"
                                           value="{{\Morilog\Jalali\Jalalian::forge($formData['daily']->created_at)->format('d %B Y')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="head_noonday" class="form-label">سرپرست روز کار کنترل کیفیت</label>
                                    <input type="text" class="form-control" id="head_noonday" name="head_noonday"
                                           value="{{ $formData['daily']->head_noonday }}">
                                </div>
                            </div>
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
                                @foreach($formData['daily']->values as $key => $value)
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <select class="form-control" id="machine_id_{{ $value->id }}"
                                                    name="values[{{ $value->id }}][machine_id]">
                                                @foreach($formData['machines'] as $product)
                                                    <option
                                                        value="{{ $product->id }}" {{ $value->machine_id == $product->id ? 'selected' : '' }}>
                                                        {{ $product->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control" id="product_id_{{ $value->id }}"
                                                    name="values[{{ $value->id }}][product_id]">
                                                @foreach($formData['products'] as $product)
                                                    <option
                                                        value="{{ $product->id }}" {{ $value->product_id == $product->id ? 'selected' : '' }}>
                                                        {{ $product->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="text" class="form-control"
                                                   id="delivery_weight_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][delivery_weight]"
                                                   value="{{ $value->delivery_weight }}" min="0" max="1000000000" step="0.01">
                                        </div>
                                        <div class="col-md-1">
                                            <input type="text" class="form-control" id="accept_weight_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][accept_weight]"
                                                   value="{{ $value->accept_weight }}" min="0" max="1000000000" step="0.01">
                                        </div>
                                        <div class="col-md-1">
                                            <input type="text" class="form-control" id="reject_weight_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][reject_weight]"
                                                   value="{{ $value->reject_weight }}" min="0" max="1000000000" step="0.01">
                                        </div>
                                        <div class="col-md-1">
                                            <input type="text" class="form-control" id="box_numbers_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][box_numbers]"
                                                   value="{{ $value->box_numbers }}" min="0" max="1000000000" step="0.01">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" id="description_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][description]"
                                                   value="{{ $value->description }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="delivery_weight" class="form-label">مجموع وزن
                                        تحویلی</label>
                                    <input type="text" class="form-control"
                                           id="delivery_weight"
                                           value="{{ $formData['daily']->delivery_weight }}" disabled>
                                </div>
                                <div class="col-md-2">
                                    <label for="accept_weight" class="form-label">مجموع وزن
                                        اکسپت</label>
                                    <input type="text" class="form-control" id="accept_weight"
                                           value="{{ $formData['daily']->accept_weight }}" disabled>
                                </div>
                                <div class="col-md-2">
                                    <label for="reject_weight" class="form-label">مجموع وزن
                                        ریجکت</label>
                                    <input type="text" class="form-control" id="reject_weight"
                                           value="{{ $formData['daily']->reject_weight }}" disabled="disabled">
                                </div>
                                <div class="col-md-2">
                                    <label for="box_numbers" class="form-label">مجموع تعداد باکس</label>
                                    <input type="text" class="form-control" id="box_numbers"
                                           value="{{ $formData['daily']->box_numbers }}" disabled="disabled">
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
                    let originalSelect = document.getElementById(`${field}_{{$formData['daily']->values[0]['id']}}`);
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
                    let originalSelect = document.getElementById(`${field}_{{$formData['daily']->values[0]['id']}}`);
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
