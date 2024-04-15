@extends('layouts.panel',['title' => 'فرم میزان تولید ماشین آلات Geo'])
@section('body')
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h3 class="text-themecolor">فرم میزان تولید ماشین آلات Geo
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
                        <h4 class="card-title">فرم میزان تولید ماشین آلات Geo</h4>
                        <form action="{{ route('reject.update', ['reject' => $formData['reject']->id]) }}"
                              method="post">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="code" class="form-label">کد مدرک</label>
                                    <input type="text" class="form-control" id="code" name="code"
                                           value="{{ $formData['reject']->code }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="shift" class="form-label">شیفت کاری</label>
                                    <select class="form-control" id="shift" name="shift">
                                        @foreach($formData['shifts'] as $key=> $value)
                                            <option
                                                value="{{$key}}" {{ $formData['reject']->shift == $key ? 'selected' : '' }}>{{$value}}</option>
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
                                                value="{{$key}}" {{ $formData['reject']->period == $key ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="head_shift_name" class="form-label">سرپرست شیفت کنترل کیفیت</label>
                                    <input type="text" class="form-control" id="head_shift_name" name="head_shift_name"
                                           value="{{ $formData['reject']->head_shift_name }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" id="tarikhTwoLable"> تاریخ ثبت
                                        شده: {{\Morilog\Jalali\Jalalian::forge($formData['reject']->created_at)->format('d %B Y')}}</label>
                                    <input type="hidden" name="created_at"
                                           value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$formData['reject']->created_at)->timestamp  }}"
                                           id="tarikhEnd" class="form-control"/>
                                    <input id="tarikhTwo" type="text" class="form-control" disabled="true"
                                           value="{{\Morilog\Jalali\Jalalian::forge($formData['reject']->created_at)->format('d %B Y')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="head_noonday" class="form-label">سرپرست روز کار کنترل کیفیت</label>
                                    <input type="text" class="form-control" id="head_noonday" name="head_noonday"
                                           value="{{ $formData['reject']->head_noonday }}">
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
                                        <label for="run_weight_0" class="form-label">وزن ریجکت راه اندازی</label>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="technical_weight_0" class="form-label">وزن ریجکت فنی</label>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="quality_weight_0" class="form-label">وزن ریجکت کیفی</label>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="accept_weight_0" class="form-label">وزن اکسپت</label>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="line_weight_0" class="form-label">وزن ریجکت خط</label>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="total_0" class="form-label">مجموع کل</label>
                                    </div>
                                </div>
                                @foreach($formData['reject']->values as $key => $value)
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <select class="form-control" id="machine_id_{{ $value->id }}"
                                                    name="values[{{ $value->id }}][machine_id]">
                                                @foreach($formData['machines'] as $machine)
                                                    <option
                                                        value="{{ $machine->id }}" {{ $value->machine_id == $machine->id ? 'selected' : '' }}>
                                                        {{ $machine->title }}
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
                                            <input type="number" class="form-control"
                                                   id="run_weight_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][run_weight]"
                                                   value="{{ $value->run_weight }}" min="0" max="1000000000" step="0.01">
                                        </div>
                                        <div class="col-md-1">
                                            <input type="number" class="form-control"
                                                   id="technical_weight_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][technical_weight]"
                                                   value="{{ $value->technical_weight }}" min="0" max="1000000000"
                                                   step="0.01">
                                        </div>
                                        <div class="col-md-1">
                                            <input type="number" class="form-control"
                                                   id="quality_weight_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][quality_weight]"
                                                   value="{{ $value->quality_weight }}" min="0" max="1000000000" step="0.01">
                                        </div>
                                        <div class="col-md-1">
                                            <input type="number" class="form-control"
                                                   id="accept_weight_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][accept_weight]"
                                                   value="{{ $value->accept_weight }}" min="0" max="1000000000" step="0.01">
                                        </div>
                                        <div class="col-md-1">
                                            <input type="number" class="form-control" id="line_weight_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][line_weight]"
                                                   value="{{ $value->line_weight }}" min="0" max="1000000000" step="0.01">
                                        </div>
                                        <div class="col-md-1">
                                            <input type="text" class="form-control" id="total_{{ $value->id }}"
                                                   value="{{ $value->total }}" min="0" max="1000000000" step="0.01" disabled>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="run_weight" class="form-label">مجموع وزن ریجکت راه اندازی</label>
                                    <input type="text" class="form-control"
                                           id="run_weight"
                                           value="{{ $formData['reject']->run_weight }}" disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="technical_weight" class="form-label">مجموع وزن ریجکت فنی</label>
                                    <input type="text" class="form-control"
                                           id="technical_weight"
                                           value="{{ $formData['reject']->technical_weight }}" disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="quality_weight" class="form-label">مجموع وزن ریجکت کیفی</label>
                                    <input type="text" class="form-control" id="quality_weight"
                                           value="{{ $formData['reject']->quality_weight }}" disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="accept_weight" class="form-label">مجموع وزن اکسپت</label>
                                    <input type="text" class="form-control" id="accept_weight"
                                           value="{{ $formData['reject']->accept_weight }}" disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="line_weight" class="form-label">مجموع وزن ریجکت خط</label>
                                    <input type="text" class="form-control" id="line_weight"
                                           value="{{ $formData['reject']->line_weight }}" disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="total" class="form-label"> مجموع کل</label>
                                    <input type="text" class="form-control" id="total"
                                           value="{{ $formData['reject']->total }}" disabled>
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

            let fields = ['machine_id', 'product_id', 'run_weight', 'technical_weight', 'quality_weight', 'accept_weight', 'line_weight'];

            fields.forEach(function (field, index) {
                let colDiv = document.createElement('div');
                colDiv.className = index === 0 || index === 1 ? 'col-md-2' : 'col-md-1'; // Set col width

                let input;
                if (field === 'product_id') {
                    input = document.createElement('select');
                    input.className = 'form-control';
                    input.id = `${field}_${newIndex}`;
                    input.name = `values[${newIndex}][${field}]`;

                    // Clone the options from the original select
                    let originalSelect = document.getElementById(`${field}_{{ $value->id }}`);
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
                    let originalSelect = document.getElementById(`${field}_{{ $value->id }}`);
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
