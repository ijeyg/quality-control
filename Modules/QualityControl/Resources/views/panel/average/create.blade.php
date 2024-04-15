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
                        <form action="{{route('average.store')}}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="code" class="form-label">ساعت</label>
                                    <input type="text" class="form-control" id="time" name="time">
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
                                    <label class="col-md-6">تاریخ:</label>
                                    <input type="hidden" name="created_at" value="{{ old('created_at') }}"
                                           id="tarikhEnd" class="form-control"/>
                                    <input id="tarikhTwo" type="text" class="form-control"
                                           value="{{\Morilog\Jalali\Jalalian::forge('today')->format('date')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="period" class="form-label">نوبت کاری</label>
                                    <select class="form-control" id="period" name="period">
                                        @foreach($formData['periods'] as $key=> $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
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
                                    <div class="col-md-2">
                                        <label for="design_0" class="form-label">وزن طراحی</label>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="average_0" class="form-label">میانگین وزن</label>
                                    </div>
                                    <div class="col-md-1">
                                        {{--                                        <label for="reject_weight_0" class="form-label">حذف</label>--}}
                                        {{--                                        <button type="button" class="form-control btn btn-danger" disabled onclick="deleteRow(this)"><i class="fa fa-close"></i></button>--}}
                                    </div>
                                </div>

                                <div class="row mb-3">
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
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" id="design_0"
                                               name="values[0][design]" min="0" max="1000000000" step="0.01">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" id="average_0"
                                               name="values[0][average]" min="0" max="1000000000" step="0.01">
                                    </div>
                                    <div class="col-md-1">
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
            newValuesDiv.className = 'row mb-3';

            let fields = ['machine_id', 'product_id', 'design', 'average'];

            fields.forEach(function (field, index) {
                let colDiv = document.createElement('div');
                colDiv.className ='col-md-2'; // Set col width

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
            deleteColumn.className = 'col-md-3';
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
