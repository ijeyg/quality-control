@extends('layouts.panel',['title' => 'گزارش گیری فرم میانگین وزن طراحی محصولات'])
@section('body')
    <div class="container-fluid">
        @include('qualitycontrol::layouts.handleErrors')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">گزارش گیری فرم میانگین وزن طراحی محصولات</h4>
                        <form action="{{route('qualitycontrol.report.average')}}" method="get">
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
                        <h4 class="card-title">فرم میزان تولید ماشین آلات Geo ها</h4>
                        @if(count($reportGenerator))
                            <p>نتایج از {{\Morilog\Jalali\Jalalian::forge(request()->start_date)->format('d-m-Y')}}
                                تا {{\Morilog\Jalali\Jalalian::forge(request()->end_date)->format('d-m-Y')}}</p>
                        @endif
                        <div class="table-responsive">
                            @if(count($reportGenerator))
                                <table class="table color-table muted-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>زمان</th>
                                        <th>وزن طراحی</th>
                                        <th>میانگین وزن</th>
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
                                                    {{$reject['time']}}
                                                </td>
                                                <td>
                                                    {{$reject['design']}}
                                                </td>
                                                <td>
                                                    {{$reject['average']}}
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
            <div class="col-md-3">
                <label for="design" class="form-label">مجموع وزن طراحی</label>
                <input type="text" class="form-control"
                       id="design"
                       value="{{ $design }}" disabled>
            </div>
            <div class="col-md-3">
                <label for="average" class="form-label">مجموع میانگین وزن</label>
                <input type="text" class="form-control"
                       id="average"
                       value="{{ $average }}" disabled>
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
