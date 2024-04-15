@extends('layouts.panel',['title' => 'ویرایش ماشین آلات‌'])
@section('body')
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h3 class="text-themecolor">ویرایش ماشین آلات @if(Request()->search)
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
                        <h4 class="card-title">ویرایش ماشین آلات</h4>
                        <form class="form-horizontal"
                              action="{{ route('machines.update',['machine' => $machine->id]) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label>عنوان:</label>
                                <input type="text" name="title" value="{{ $machine->title }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>توضیحات:</label>
                                <textarea type="text" name="description"
                                          class="form-control">{{ $machine->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-success dokme" value="Update">بروزرسانی</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
