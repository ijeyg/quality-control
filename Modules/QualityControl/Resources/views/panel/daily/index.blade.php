@extends('layouts.panel',['title' => 'فرم روزانه ‌ها'])
@section('body')
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h3 class="text-themecolor">فرم روزانه ها @if(Request()->search)
                    <small>جستجو برای {{ Request()->search }}</small>
                @endif</h3>
        </div>
        {{--        <div class="col-md-4 align-self-center search">--}}
        {{--            --}}{{--{{ route('faq.index') }}--}}
        {{--            <form action="">--}}
        {{--                <div class="input-group">--}}
        {{--                    <input type="text" name="search" class="form-control" placeholder="جستجوی فرم روزانه ">--}}
        {{--                    <span class="input-group-btn">--}}
        {{--                      <button class="btn btn-success" type="submit"><i class="fa fa-search"--}}
        {{--                                                                       aria-hidden="true"></i></button>--}}
        {{--                    </span>--}}
        {{--                </div>--}}
        {{--            </form>--}}
        {{--        </div>--}}
    </div>
    <div class="container-fluid">
        @include('qualitycontrol::layouts.handleErrors')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">فرم روزانه ها</h4>
                        <div class="table-responsive">
                            @if(count($dailies))
                                <table class="table color-table muted-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>کد</th>
                                        <th>سرپرست شیفت</th>
                                        <th>سرپرست شیفت روز</th>
                                        <th>وزن تحویلی</th>
                                        <th>وزن اکسپت</th>
                                        <th>وزن ریجکت</th>
                                        <th class="text-nowrap">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($dailies))

                                        @php($i = 0)
                                        @foreach($dailies as $daily)
                                            @php($i++)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>
                                                    {{$daily['code']}}
                                                </td>
                                                <td>{{$daily['head_shift_name']}}</td>
                                                <td>{{$daily['head_noonday']}}</td>
                                                <td>{{$daily['delivery_weight']}}</td>
                                                <td>{{$daily['accept_weight']}}</td>
                                                <td>{{$daily['reject_weight']}}</td>
                                                <td class="text-nowrap">
                                                    <form
                                                        action="{{ route('daily.destroy', ['daily' => $daily['id']])  }}"
                                                        class="delete" method="post">
                                                        @method('delete')
                                                        {{ csrf_field() }}
                                                        <a href="{{ route('daily.edit',['daily' => $daily['id']]) }}"
                                                           data-toggle="tooltip" data-original-title="ویرایش"> <i
                                                                class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                            <button type="button" data-toggle="tooltip"
                                                                    data-original-title="حذف"
                                                                    onclick="confirm('آیا اطمینان دارید؟') ? submit() : false;">
                                                                <i class="fa fa-close text-danger"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            @else
                                <h3>هیچ فرم روزانه ی پیدا نشد...</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
