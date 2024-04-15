@extends('layouts.panel',['title' => 'گزارش گیری بازرسی واحد کنترل کیفیت'])
@section('body')
    <div class="container-fluid">
        @include('qualitycontrol::layouts.handleErrors')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">گزارش گیری بازرسی واحد کنترل کیفیت</h4>
                        <form action="{{route('qualitycontrol.report.unitinspection')}}" method="get">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="col-md-6">از تاریخ:</label>
                                    <input type="hidden" name="start_date" value="{{ old('start_date') }}"
                                           id="start_dateEnd" class="form-control"/>
                                    <input id="start_date" type="text" class="form-control"
                                           value="{{\Morilog\Jalali\Jalalian::forge('today')->format('date')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="product" class="form-label">محصول</label>
                                    <select class="form-control" id="product" name="product">
                                        <option value="">انتخاب نشده است</option>
                                        @foreach($products as $key =>$product)
                                            <option value="{{$product->id}}">{{$product->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-md-6">تا تاریخ:</label>
                                    <input type="hidden" name="end_date" value="{{ old('end_date') }}" id="end_dateEnd"
                                           class="form-control"/>
                                    <input id="end_date" type="text" class="form-control"
                                           value="{{\Morilog\Jalali\Jalalian::forge('today')->format('date')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="shift" class="form-label">شیفت کاری</label>
                                    <select class="form-control" id="shift" name="shift">
                                        <option value="">انتخاب نشده است</option>
                                        @foreach($shifts as $key =>$shift)
                                            <option value="{{$key}}">{{$shift}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="place" class="form-label">محل بازرسی</label>
                                    <select class="form-control" id="place" name="place">
                                        <option value="">انتخاب نشده است</option>
                                        @foreach($places as $key =>$place)
                                            <option value="{{$key}}">{{$place}}</option>
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
                        <h4 class="card-title">بازرسی واحد کنترل کیفیت</h4>
                        @if(count($reportGenerator))
                            <p>نتایج از  {{\Morilog\Jalali\Jalalian::forge(request()->start_date)->format('d-m-Y')}} تا  {{\Morilog\Jalali\Jalalian::forge(request()->end_date)->format('d-m-Y')}}</p>
                        @endif
                        <div class="table-responsive">
                            @if(count($reportGenerator))
                                <table class="table color-table muted-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>کد</th>
                                        <th>آب</th>
                                        <th>روغن</th>
                                        <th>آلودگی</th>
                                        <th>آسیب غشایی</th>
                                        <th>پارگی</th>
                                        <th>رطوبت</th>
                                        <th>سوختگی</th>
                                        <th>تاخوردگی و چروک</th>
                                        <th>نوسان وزن</th>
                                        <th>جمع کل</th>
                                        <th>تاریخ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($reportGenerator))

                                        @php($i = 0)
                                        @foreach($reportGenerator as $reject)
                                            @php($i++)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>
                                                    {{$reject['code']}}
                                                </td>
                                                <td>
                                                    {{$reject['water']}}
                                                </td>
                                                <td>
                                                    {{$reject['oil']}}
                                                </td>
                                                <td>
                                                    {{$reject['pollution']}}
                                                </td>
                                                <td>
                                                    {{$reject['membrane']}}
                                                </td>
                                                <td>
                                                    {{$reject['rupture']}}
                                                </td>
                                                <td>
                                                    {{$reject['humidity']}}
                                                </td>
                                                <td>
                                                    {{$reject['burn']}}
                                                </td>
                                                <td>
                                                    {{$reject['wrinkles']}}
                                                </td>
                                                <td>
                                                    {{$reject['weight']}}
                                                </td>
                                                <td>
                                                    {{$reject['total']}}
                                                </td>
                                                <td>
                                                    {{\Morilog\Jalali\Jalalian::forge($reject['created_at'])->format('Y-m-d')}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            @else
                                <h3>پیدا نشد...</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2">
                <label for="water" class="form-label">آب</label>

                <input type="number" class="form-control" id="water"
                       name="water" disabled
                       value="{{$water }}">
            </div>
            <div class="col-md-2">
                <label for="oil" class="form-label">روغن</label>

                <input type="number" class="form-control" id="oil"
                       name="oil" disabled
                       value="{{$oil }}">
            </div>
            <div class="col-md-2">
                <label for="pollution" class="form-label">آلودگی</label>

                <input type="number" class="form-control" id="pollution"
                       name="pollution" disabled
                       value="{{ $pollution }}">
            </div>
            <div class="col-md-2">
                <label for="membrane" class="form-label">آسیب غشایی</label>

                <input type="number" class="form-control" id="membrane"
                       name="membrane" disabled
                       value="{{ $membrane }}">
            </div>
            <div class="col-md-2">
                <label for="rupture" class="form-label">پارگی</label>

                <input type="number" class="form-control" id="rupture"
                       name="rupture" disabled
                       value="{{ $rupture }}">
            </div>
            <div class="col-md-2">
                <label for="humidity" class="form-label">رطوبت</label>

                <input type="number" class="form-control" id="humidity"
                       name="humidity" disabled
                       value="{{ $humidity }}">
            </div>
            <div class="col-md-2">
                <label for="burn" class="form-label">سوختگی</label>

                <input type="number" class="form-control" id="burn"
                       name="burn" disabled
                       value="{{ $burn }}">
            </div>
            <div class="col-md-2">
                <label for="wrinkles" class="form-label">تاخوردگی و چروک</label>

                <input type="number" class="form-control" id="wrinkles"
                       name="wrinkles" disabled
                       value="{{ $wrinkles }}">
            </div>
            <div class="col-md-2">
                <label for="weight" class="form-label">وزن</label>

                <input type="number" class="form-control" id="weight"
                       name="weight" disabled
                       value="{{ $weight }}">
            </div>
            <div class="col-md-2">
                <label for="number" class="form-label">جمع کل</label>

                <input type="number" class="form-control" id="number"
                       name="number" disabled
                       value="{{ $total_of_total }}">
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        var tarikh = $('#end_date').persianDatepicker({
            altField: '#end_dateEnd',
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

@endsection
