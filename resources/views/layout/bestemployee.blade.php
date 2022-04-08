@extends('layout.main')

@section('head')
@yield('headbestemployee')

@endsection

@section('content')
<div class="container-fluid" style="padding: 9px 37px 9px 37px; height:100%">
    <div class="container-fluid" style="border-radius: 10px; background-color:#4d59cac2; height:100% ">
        <div class="row" style="height: 100%">
            <div class="col-sm-2" style="border-radius: 10px 0 0 10px;height: 100%; padding:0; text-align:center">
                <div class="row" style="text-align:center; color:white; min-height: 10%;max-height:fit-content; font-size:100%;">
                    <h2 style="font-size: 2vw">BEST EMPLOYEE</h2>
                    <hr style="color: #ffffff;margin:0">
                </div>
                @if (isset($index))
                <div style="background-color: #ffffff; min-height:7.5%; max-height:fit-content; font-size: 100%">
                    <div style="width: fit-content; min-height:100%; max-height:fit-content; margin:auto" onclick="location.href='/best_employee';">
                        <h6 style="font-size: 1vw">HASIL PEMILIHAN BEST EMPLOYEE</h6>
                    </div>
                </div>
                @else
                <div style="color:white;background-color: #929292; min-height:7.5%; max-height:fit-content; box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset;font-size: 100%;" >
                    <div style="width: fit-content; min-height:100%; max-height:fit-content; margin:auto" onclick="location.href='/best_employee';">
                        <h6 style="font-size: 1vw">HASIL PEMILIHAN BEST EMPLOYEE</h6> 
                    </div>
                </div>
                @endif
                @if (isset($pemilihan))
                <div style="background-color: #ffffff; min-height:7.5%; max-height:fit-content ;font-size: 100%">
                    <div style="width: fit-content; min-height:100%; max-height:fit-content; margin:auto" onclick="location.href='/pemilihan_best_employee';">
                        <h6 style="font-size: 1vw">PEMILIHAN BEST EMPLOYEE</h6> 
                    </div>
                </div>
                @else
                <div style="color:white;background-color: #929292; height:7.5%; box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset;font-size: 100%;" >
                    <div style="width: fit-content; min-height:100%; max-height:fit-content; margin:auto" onclick="location.href='/pemilihan_best_employee';">
                        <h6 style="font-size: 1vw">PEMILIHAN BEST EMPLOYEE</h6>
                    </div>
                </div>           
                @endif
            </div>
            <div class="col-sm-10" style="border-radius: 0 10px 10px 0;height: 100%; background-color:#ffffff; ">
                @yield('contentbestemployee')

            </div>
        </div>
    </div>
</div>

@endsection


@section('foot')
    @yield('footbestemployee')
    <script src="best employee/js/main.js"></script>
@endsection