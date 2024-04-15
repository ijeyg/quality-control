@extends('layouts.panel',['title' => 'فرم های میزان تولید ماشین آلات Geo'])
@section('body')
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h3 class="text-themecolor">فرم های میزان تولید ماشین آلات Geo @if(Request()->search)
                    <small>جستجو برای {{ Request()->search }}</small>
                @endif</h3>
        </div>
        {{--        <div class="col-md-4 align-self-center search">--}}
        {{--            --}}{{--{{ route('faq.index') }}--}}
        {{--            <form action="">--}}
        {{--                <div class="input-group">--}}
        {{--                    <input type="text" name="search" class="form-control" placeholder="جستجوی فرم ریجکت ">--}}
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
                        <h4 class="card-title">فرم های میزان تولید ماشین آلات Geo</h4>
                        <div class="table-responsive">
                            @if(count($rejects))
                                <table class="table color-table muted-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>کد</th>
                                        <th>شیفت</th>
                                        <th>تاریخ</th>
                                        <th class="text-nowrap">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($rejects))

                                        @php($i = 0)
                                        @foreach($rejects as $reject)
                                            @php($i++)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>
                                                    {{$reject['code']}}
                                                </td>
                                                <td>{{config('qualitycontrol.statics.type_periods.'.$reject['shift'])}}</td>
                                                <td>{{$reject['created_at']}}</td>
                                                <td class="text-nowrap">
                                                    <form
                                                        action="{{ route('reject.destroy', ['reject' => $reject['id']])  }}"
                                                        class="delete" method="post">
                                                        @method('delete')
                                                        {{ csrf_field() }}
                                                        <a href="{{ route('reject.edit',['reject' => $reject['id']]) }}"
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
                                <h3>هیچ فرم ریجکتی پیدا نشد...</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
