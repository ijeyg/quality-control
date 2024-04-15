<li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-edit"
                                                                                   aria-hidden="true"></i><span
            class="hide-menu">محصولات</span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('products.index') }}">محصول جدید</a></li>
        <li><a href="{{ route('products.index') }}">لیست محصولات</a></li>
    </ul>
</li>
<li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-edit"
                                                                                   aria-hidden="true"></i><span
            class="hide-menu">ماشین آلات</span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('machines.index') }}">ماشین آلات جدید</a></li>
        <li><a href="{{ route('machines.index') }}">لیست ماشین آلات</a></li>
    </ul>
</li>
<li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-edit"
                                                                                   aria-hidden="true"></i><span
            class="hide-menu">روزانه</span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('daily.create') }}">فرم روزانه جدید</a></li>
        <li><a href="{{ route('daily.index') }}">لیست فرم روزانه ها</a></li>
    </ul>
</li>
<li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-edit"
                                                                                   aria-hidden="true"></i><span
            class="hide-menu"> بازرسی واحد کنترل کیفیت</span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('unitinspection.create') }}">فرم بازرسی واحد کنترل کیفیت جدید</a></li>
        <li><a href="{{ route('unitinspection.index') }}">لیست فرم های بازرسی واحد کنترل کیفیت</a></li>
    </ul>
</li>
<li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-edit"
                                                                                   aria-hidden="true"></i><span
            class="hide-menu">فرم میانگین وزن محصولات</span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('average.create') }}">فرم میانگین وزن محصولات جدید</a></li>
        <li><a href="{{ route('average.index') }}">فرم میانگین وزن محصولات</a></li>
    </ul>
</li>
<li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-edit"
                                                                                   aria-hidden="true"></i><span
            class="hide-menu">میزان تولید ماشین آلات Geo</span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('reject.create') }}">فرم میزان تولید ماشین آلات Geo جدید</a></li>
        <li><a href="{{ route('reject.index') }}">لیست فرم میزان تولید ماشین آلات Geo ها</a></li>
    </ul>
</li>
<li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-edit"
                                                                                   aria-hidden="true"></i><span
            class="hide-menu">تست آب و روغن</span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('testing.create') }}">فرم تست آب و روغن جدید</a></li>
        <li><a href="{{ route('testing.index') }}">لیست فرم تست آب و روغن ها</a></li>
    </ul>
</li>
<li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-inbox"
                                                                                   aria-hidden="true"></i><span
            class="hide-menu">گزارش گیری</span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('qualitycontrol.report.reject') }}">فرم میزان تولید ماشین آلات Geo</a></li>
        <li><a href="{{ route('qualitycontrol.report.unitinspection') }}">بازرسی واحد کنترل کیفیت</a></li>
        <li><a href="{{ route('qualitycontrol.report.average') }}">فرم میانگین وزن طراحی محصولات</a></li>
        <li><a href="{{ route('qualitycontrol.report.testing') }}">نمودار تست آب و روغن</a></li>

    </ul>
</li>
