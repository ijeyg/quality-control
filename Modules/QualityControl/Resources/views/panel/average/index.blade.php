@extends('layouts.panel',['title' => 'فرم های میانگین وزن محصولات'])
@section('body')
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h3 class="text-themecolor">فرم های میانگین وزن محصولات@if(Request()->search)
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
                        <h4 class="card-title">فرم های میانگین وزن محصولات</h4>
                        <div class="table-responsive">
                            @if(count($averages))
                                <table class="table color-table muted-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>شیفت</th>
                                        <th>تاریخ</th>
                                        <th>زمان</th>
                                        <th class="text-nowrap">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($averages))

                                        @php($i = 0)
                                        @foreach($averages as $average)
                                            @php($i++)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{config('qualitycontrol.statics.type_periods.'.$average['shift'])}}</td>
                                                <td>{{$average['created_at']}}</td>
                                                <td>
                                                    {{$average['time']}}
                                                </td>
                                                <td class="text-nowrap">
                                                    <form
                                                        action="{{ route('average.destroy', ['average' => $average['id']])  }}"
                                                        class="delete" method="post">
                                                        @method('delete')
                                                        {{ csrf_field() }}
                                                        <a href="{{ route('average.edit',['average' => $average['id']]) }}"
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
                                <h3>هیچ فرم میانگین وزن محصولاتی پیدا نشد...</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
