@extends('layout')

@section('content')

    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="col-md-8">
                <img src="/img/contacts.jpg" alt="">
                <h4>
                    <p>
                        Контактная информация: <br>
                        Контактный номер:  096-250-03-50 <br>
                        Контактный email: olegperkolaba888@gmail.com <br>
                        Адрес: г. Киев
                    </p>
                </h4>
            </div>
            @include('pages._sidebar')
        </div>
    </div>
    <!-- end main content-->

@endsection