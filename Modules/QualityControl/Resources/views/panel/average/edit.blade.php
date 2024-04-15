@extends('layouts.panel',['title' => 'فرم میانگین وزن محصولات'])
@section('body')
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h3 class="text-themecolor">فرم میانگین وزن محصولات
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
                        <h4 class="card-title">فرم میانگین وزن محصولات</h4>
                        <form action="{{ route('average.update', ['average' => $formData['average']->id]) }}"
                              method="post">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="code" class="form-label">زمان</label>
                                    <input type="text" class="form-control" id="time" name="time"
                                           value="{{ $formData['average']->time }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="shift" class="form-label">شیفت کاری</label>
                                    <select class="form-control" id="shift" name="shift">
                                        @foreach($formData['shifts'] as $key=> $value)
                                            <option
                                                value="{{$key}}" {{ $formData['average']->shift == $key ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" id="tarikhTwoLable"> تاریخ ثبت
                                        شده: {{\Morilog\Jalali\Jalalian::forge($formData['average']->created_at)->format('d %B Y')}}</label>
                                    <input type="hidden" name="created_at"
                                           value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$formData['average']->created_at)->timestamp  }}"
                                           id="tarikhEnd" class="form-control"/>
                                    <input id="tarikhTwo" type="text" class="form-control" disabled="true"
                                           value="{{\Morilog\Jalali\Jalalian::forge($formData['average']->created_at)->format('d %B Y')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="period" class="form-label">نوبت کاری</label>
                                    <select class="form-control" id="period" name="period">
                                        @foreach($formData['periods'] as $key=> $value)
                                            <option
                                                value="{{$key}}" {{ $formData['average']->period == $key ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                    </select>
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
                                    <div class="col-md-2">
                                        <label for="design_0" class="form-label">وزن طراحی</label>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="average_0" class="form-label">میانگین وزن</label>
                                    </div>
                                </div>
                                @foreach($formData['average']->values as $key => $value)
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
                                        <div class="col-md-2">
                                            <input type="number" class="form-control"
                                                   id="design_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][design]"
                                                   value="{{ $value->design }}" min="0" max="1000000000" step="0.01">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control"
                                                   id="average_{{ $value->id }}"
                                                   name="values[{{ $value->id }}][average]"
                                                   value="{{ $value->average }}" min="0" max="1000000000"
                                                   step="0.01">
                                        </div>
                                    </div>
                                @endforeach
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

            let fields = ['machine_id', 'product_id', 'design', 'average'];

            fields.forEach(function (field, index) {
                let colDiv = document.createElement('div');
                colDiv.className = 'col-md-2'; // Set col width

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
