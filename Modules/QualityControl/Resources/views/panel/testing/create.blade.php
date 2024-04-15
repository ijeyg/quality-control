@extends('layouts.panel',['title' => 'فرم تست آب و روغن ظروف حین تولید'])
@section('body')
    <style>
        .flex-wrapp {
            -ms-flex-wrap: wrap !important;
            flex-wrap: wrap !important;
            -webkit-flex-wrap: wrap !important;
        }

        .row-gapp {
            row-gap: 30px;
        }
    </style>
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h3 class="text-themecolor">فرم تست آب و روغن ظروف حین تولید
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
                        <h4 class="card-title">فرم تست آب و روغن ظروف حین تولید</h4>
                        <form action="{{route('testing.store')}}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="code" class="form-label">کد مدرک</label>
                                    <input type="text" class="form-control" id="code" name="code">
                                </div>
                                <div class="col-md-6">
                                    <label for="night" class="form-label">شیفت کاری</label>
                                    <select class="form-control" id="night" name="night">
                                        @foreach($formData['shifts'] as $key=> $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="morning" value="0">
                                <div class="col-md-6">
                                    <label for="period" class="form-label">نوبت کاری</label>
                                    <select class="form-control" id="period" name="period">
                                        @foreach($formData['periods'] as $key=> $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="head" class="form-label">سرپرست</label>
                                    <input type="text" class="form-control" id="head" name="head">
                                </div>
                                <div class="col-md-6">
                                    <label class="col-md-6">تاریخ:</label>
                                    <input type="hidden" name="created_at" value="{{ old('created_at') }}"
                                           id="tarikhEnd" class="form-control"/>
                                    <input id="tarikhTwo" type="text" class="form-control"
                                           value="{{\Morilog\Jalali\Jalalian::forge('today')->format('date')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="head" class="form-label">توضیحات سرپرست</label>
                                    <input type="text" class="form-control" id="description" name="description">
                                </div>
                            </div>

                            <!-- Values Input Section -->
                            <div id="valuesContainer" class="d-flex justify-content-start flex-wrapp row-gapp">
                                <div class="col-md-4 col-12">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <select class="form-control" id="machine_id_0" name="values[0][machine_id]">
                                                @foreach($formData['machines'] as $key=> $value)
                                                    <option value="{{$value->id}}">{{$value->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <select class="form-control" id="product_id_0" name="values[0][product_id]">
                                                @foreach($formData['products'] as $key=> $value)
                                                    <option value="{{$value->id}}">{{$value->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p style="text-align: right"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p style="text-align: right">آب</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p style="text-align: right">روغن</p>
                                        </div>
                                    </div>

                                    @foreach($formData['12_hours_time_work'] as $key=>$item)
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control"
                                                           id="time_0_{{$item}}_{{$key}}"
                                                           name="values[0][{{$item}}][time]" value="{{$item}}">
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control" id="water_0_{{$item}}_{{$key}}"
                                                            name="values[0][{{$item}}][water]">
                                                        @foreach($formData['status_devices'] as $j=> $i)
                                                            <option value="{{$j}}">{{$i}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control" id="oil_0_{{$item}}_{{$key}}"
                                                            name="values[0][{{$item}}][oil]">
                                                        @foreach($formData['status_devices'] as $m=> $n)
                                                            <option value="{{$m}}">{{$n}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                    @endforeach
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
        function generateRandomId() {
            return Math.random().toString(36).substr(2, 9);
        }

        function addValues() {
            // Generate a random ID
            let randomId = generateRandomId();

            // Get the valuesContainer
            let valuesContainer = document.getElementById('valuesContainer');
            let Col12 = document.createElement('div');
            Col12.className = 'col-md-4 col-12';
            let machineRow = document.createElement('div');
            machineRow.className = 'row mb-3';

            // Add product select
            let machineCol = document.createElement('div');
            machineCol.className = 'col-md-12';
            let machineSelect = document.createElement('select');
            machineSelect.className = 'form-control';
            machineSelect.id = `machine_id_${randomId}`;
            machineSelect.name = `values[${randomId}][machine_id]`;

            // Populate product options
            @foreach($formData['machines'] as $key => $value)
            let machineOption{{$key}} = document.createElement('option');
            machineOption{{$key}}.value = '{{$value->id}}';
            machineOption{{$key}}.textContent = '{{$value->title}}';
            machineSelect.appendChild(machineOption{{$key}});
            @endforeach

            machineCol.appendChild(machineSelect);
            machineRow.appendChild(machineCol);

            // Create a new row for the product
            let productRow = document.createElement('div');
            productRow.className = 'row mb-3';

            // Add product select
            let productCol = document.createElement('div');
            productCol.className = 'col-md-12';
            let productSelect = document.createElement('select');
            productSelect.className = 'form-control';
            productSelect.id = `product_id_${randomId}`;
            productSelect.name = `values[${randomId}][product_id]`;

            // Populate product options
            @foreach($formData['products'] as $key => $value)
            let productOption{{$key}} = document.createElement('option');
            productOption{{$key}}.value = '{{$value->id}}';
            productOption{{$key}}.textContent = '{{$value->title}}';
            productSelect.appendChild(productOption{{$key}});
            @endforeach

            productCol.appendChild(productSelect);
            productRow.appendChild(productCol);

            // Create a new row for the labels
            let labelsRow = document.createElement('div');
            labelsRow.className = 'row mb-3';

            // Add labels
            let labels = ['', 'آب', 'روغن'];
            for (let label of labels) {
                let labelCol = document.createElement('div');
                labelCol.className = 'col-md-4';
                let labelElement = document.createElement('p');
                labelElement.textContent = label;
                labelElement.style = 'text-align: right'
                labelCol.appendChild(labelElement);
                labelsRow.appendChild(labelCol);
            }
            // Add the new rows to the valuesContainer
            Col12.appendChild(machineRow);
            Col12.appendChild(productRow);
            Col12.appendChild(labelsRow);
            // Add time, water, and oil inputs
            @foreach($formData['12_hours_time_work'] as $key => $item)
            // Create a new row for time, water, and oil inputs
            let inputsRow{{$key}} = document.createElement('div');
            inputsRow{{$key}}.className = 'row mb-3';
            let timeCol{{$key}} = document.createElement('div');
            timeCol{{$key}}.className = 'col-md-4';
            let timeInput{{$key}} = document.createElement('input');
            timeInput{{$key}}.type = 'text';
            timeInput{{$key}}.className = 'form-control';
            timeInput{{$key}}.id = `time_${randomId}_{{$item}}`;
            timeInput{{$key}}.name = `values[${randomId}][{{$item}}][time]`;
            timeInput{{$key}}.value = '{{$item}}';
            timeCol{{$key}}.appendChild(timeInput{{$key}});

            let waterCol{{$key}} = document.createElement('div');
            waterCol{{$key}}.className = 'col-md-4';
            let waterSelect{{$key}} = document.createElement('select');
            waterSelect{{$key}}.className = 'form-control';
            waterSelect{{$key}}.id = `water_${randomId}_{{$item}}`;
            waterSelect{{$key}}.name = `values[${randomId}][{{$item}}][water]`;

            @foreach($formData['status_devices'] as $j => $i)
            let waterOption{{$j}}_{{$key}} = document.createElement('option');
            waterOption{{$j}}_{{$key}}.value = '{{$j}}';
            waterOption{{$j}}_{{$key}}.textContent = '{{$i}}';
            waterSelect{{$key}}.appendChild(waterOption{{$j}}_{{$key}});
            @endforeach

            waterCol{{$key}}.appendChild(waterSelect{{$key}});

            let oilCol{{$key}} = document.createElement('div');
            oilCol{{$key}}.className = 'col-md-4';
            let oilSelect{{$key}} = document.createElement('select');
            oilSelect{{$key}}.className = 'form-control';
            oilSelect{{$key}}.id = `oil_${randomId}_{{$item}}`;
            oilSelect{{$key}}.name = `values[${randomId}][{{$item}}][oil]`;

            @foreach($formData['status_devices'] as $m => $n)
            let oilOption{{$m}}_{{$key}} = document.createElement('option');
            oilOption{{$m}}_{{$key}}.value = '{{$m}}';
            oilOption{{$m}}_{{$key}}.textContent = '{{$n}}';
            oilSelect{{$key}}.appendChild(oilOption{{$m}}_{{$key}});
            @endforeach

            oilCol{{$key}}.appendChild(oilSelect{{$key}});

            inputsRow{{$key}}.appendChild(timeCol{{$key}});
            inputsRow{{$key}}.appendChild(waterCol{{$key}});
            inputsRow{{$key}}.appendChild(oilCol{{$key}});
            Col12.appendChild(inputsRow{{$key}});

            @endforeach

            valuesContainer.appendChild(Col12)
        }
    </script>

@endsection
