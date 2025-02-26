@extends('layouts.front')
@section('title','Главная')
@section('content')

    <div class="px-4 py-5 my-5 text-center">
        <!-- <img class="d-block mx-auto mb-4" src="{{ asset('assets/img/SM-logo2.png') }}" alt="" height="80"> -->
        <h1 class="display-5 fw-bold text-bg-dark">MPFIT</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Тестовое задание компании "MPFIT"</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <!-- <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button> -->
                <!-- <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button> -->

                <a href="{{url('/products')}}" class="btn btn-primary btn-lg px-4 gap-3">Товары</a>
                <a href="https://smwordpress.smartexweb.kz/resume/" class="btn btn-outline-secondary btn-lg px-4" target="_blank">Резюме</a>
            </div>
        </div>
    </div>

@endsection