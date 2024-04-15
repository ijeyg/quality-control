@extends('layouts.panel',['title' => 'محصولات'])
@section('body')
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h3 class="text-themecolor">محصولات @if(Request()->search)
                    <small>جستجو برای {{ Request()->search }}</small>
                @endif</h3>
        </div>
        {{--        <div class="col-md-4 align-self-center search">--}}
        {{--            --}}{{--{{ route('faq.index') }}--}}
        {{--            <form action="">--}}
        {{--                <div class="input-group">--}}
        {{--                    <input type="text" name="search" class="form-control" placeholder="جستجوی محصول">--}}
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
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">محصول جدید</h4>
                        <form class="form-horizontal" action="{{ route('products.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>عنوان:</label>
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>وزن:</label>
                                <input type="text" name="weight" value="{{ old('weight') }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>توضیحات:</label>
                                <textarea type="text" name="description"
                                          class="form-control">{{ old('description') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-success dokme">ایجاد</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">محصولات</h4>
                        <div class="table-responsive">
                            @if(count($products))
                                <table class="table color-table muted-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>عنوان</th>
                                        <th>وزن طراحی</th>
                                        <th>توضیحات</th>
                                        <th class="text-nowrap">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($products))

                                        @php($i = 0)
                                        @foreach($products as $product)
                                            @php($i++)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>
                                                   {{$product['title']}}
                                                </td>
                                                <td>{{$product['weight']}}</td>
                                                <td>{{$product['description']}}</td>
                                                <td class="text-nowrap">
                                                    <form
                                                        action="{{ route('products.destroy', ['product' => $product['id']])  }}"
                                                        class="delete" method="post">
                                                        @method('delete')
                                                        {{ csrf_field() }}
                                                        <a href="{{ route('products.edit',['product' => $product['id']]) }}"
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
                                <h3>هیچ محصولی پیدا نشد...</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
