@extends('layouts.panel',['title' => 'گزارش گیری تست آب و روغن ظروف حین تولید'])
@section('body')
    <div class="container-fluid">
        @include('qualitycontrol::layouts.handleErrors')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            نمودار تست آب و روغن ظروف حین تولید
                        </h4>
                        <form action="{{route('qualitycontrol.report.testing')}}" method="get">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="col-md-6"> تاریخ:</label>
                                    <input type="hidden" name="start_date" value="{{ old('start_date') }}"
                                           id="start_dateEnd" class="form-control"/>
                                    <input id="start_date" type="text" class="form-control"
                                           value="{{\Morilog\Jalali\Jalalian::forge('today')->format('date')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="product" class="form-label">محصول</label>
                                    <select class="form-control" id="product" name="product">
                                        @foreach($products as $key =>$product)
                                            <option value="{{$product->id}}">{{$product->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="shift" class="form-label">شیفت کاری</label>
                                    <select class="form-control" id="shift" name="shift">
                                        @foreach($shifts as $key =>$shift)
                                            <option value="{{$key}}">{{$shift}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="machine" class="form-label">ماشین آلات</label>
                                    <select class="form-control" id="machine" name="machine">
                                        @foreach($machines as $key =>$machine)
                                            <option value="{{$machine->id}}">{{$machine->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <br>
                                    <button type="submit" class="btn btn-primary">جستجو</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            @if(isset($reportGenerator))
                                نمودار تست آب و روغن ظروف حین تولید
                                - @foreach($products as $key =>$product)
                                    @if($reportGenerator[0]['product_id'] == $product->id)
                                        {{$product->title}}
                                    @endif
                                @endforeach
                                -@foreach($machines as $key =>$machine)
                                    @if($reportGenerator[0]['machine_id'] == $machine->id)
                                        {{$machine->title}}
                                    @endif
                                @endforeach
                                - {{\Morilog\Jalali\Jalalian::forge(request()->input('start_date'))->format('Y/m/d')}}
                            @endif
                        </h4>
                        <canvas id="myChart" style="width:100%;max-width:2000px"></canvas>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
        var tarikh = $('#start_date').persianDatepicker({
            altField: '#start_dateEnd',
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
        <?php
        if (!empty($reportGenerator)) {
            $water = [];
            $oil = [];
            foreach ($reportGenerator as $val) {
                $water[] .= config('qualitycontrol.statics.status_devices.' . $val['water']);
                $oil[] .= config('qualitycontrol.statics.status_devices.' . $val['oil']);
            }
        }
        ?>
    <script>
        @if(!empty($water) || !empty($oil))
        var yValues = @json(config('qualitycontrol.statics.status_devices_names'));
        var xValues = @json(array_reverse(config('qualitycontrol.statics.24_hours_time_work')));
        var water = @json($water);
        var oil = @json($oil);
        new Chart("myChart", {
            type: "line",

            data: {
                datasets: [{
                    data: water,
                    label: 'آب',
                    borderColor: "blue",
                    fill: false,
                }, {
                    data: oil,
                    label: 'روغن',
                    borderColor: "orange",
                    fill: false
                }]
            },
            options: {
                legend: {display: true},
                scales: {
                    yAxes: [{
                        type: 'category',
                        labels: yValues,
                    }],
                    xAxes: [{
                        type: 'category',
                        labels: xValues,
                    }]
                }
            }
        });
        @endif
    </script>
@endsection
