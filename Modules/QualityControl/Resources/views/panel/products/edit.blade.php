@extends('layouts.panel',['title' => 'ویرایش محصول‌'])
@section('body')
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h3 class="text-themecolor">ویرایش محصول @if(Request()->search)
                    <small>جستجو برای {{ Request()->search }}</small>
                @endif</h3>
        </div>
    </div>
    <div class="container-fluid">
        @include('qualitycontrol::layouts.handleErrors')
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">ویرایش محصول</h4>
                        <form class="form-horizontal"
                              action="{{ route('products.update',['product' => $product->id]) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label>عنوان:</label>
                                <input type="text" name="title" value="{{ $product->title }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>وزن:</label>
                                <input type="text" name="weight" value="{{ $product->weight }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>توضیحات:</label>
                                <textarea type="text" name="description"
                                          class="form-control">{{ $product->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-success dokme" value="Update">بروزرسانی</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
