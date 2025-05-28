
{{-- ['Task', 'Hours per Day'],
['المستخدمين المسجلين',     {{$users->count()}}],
['الفئات',      {{$category->count()}}],
['الألعاب',  {{$games->count()}}],
['الأسئلة', {{$questions->count()}}], --}}
@extends('admin.master_admin')
@section('admin')
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['المقابر', {{$tombs->count()}}],
        ['البلوكات', {{$blocks->count()}}],

        ['المستخدمين المسجلين', {{$users->count()}}],
    ]);

    var options = {
        title: '',
        //#endregion

       // colors: ['#5636D3', '#67B586', '#3357FF', '#15232A'] // Add your desired colors here
        colors: ['#67B586', '#5636D3', '#3357FF', '#15232A'] // Add your desired colors here

    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
}
  </script>
<div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
    <div class="col">
        <a href="{{route('all.users')}}">
        <div class="card radius-10 bg-gradient-deepblue">
         <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 text-white">{{$users->count()}}</h5>
                <div class="ms-auto">
                    <i class='bx bx-user fs-3 text-white'></i>

                </div>
            </div>
            <div class="progress my-2 bg-opacity-25 bg-white" style="height:4px;">
                <div class="progress-bar bg-white" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="d-flex align-items-center text-white">
                <p class="mb-0">عدد المستخدمين</p>

            </div>
        </div>
    </a>
      </div>
    </div>
    <div class="col">
        <a href="{{route('all.block')}}">

        <div class="card radius-10 bg-gradient-ohhappiness">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 text-white"> {{$blocks->count()}}</h5>
                <div class="ms-auto">
                    <i class='bx bx-category fs-3 text-white'></i>
                </div>
            </div>
            <div class="progress my-2 bg-opacity-25 bg-white" style="height:4px;">
                <div class="progress-bar bg-white" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="d-flex align-items-center text-white">
                <p class="mb-0">عدد البلوكات</p>
            </div>
        </div>
    </a>

      </div>
    </div>
    <div class="col">
        <a href="{{ route('all.tomb') }}">
            <div class="card radius-10" style="background: linear-gradient(135deg, #000000, #434343);">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{ $tombs->count() }}</h5>
                        <div class="ms-auto">
                            <i class='bx bx-category fs-3 text-white'></i>
                        </div>
                    </div>
                    <div class="progress my-2 bg-opacity-25 bg-white" style="height:4px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">عدد القبور</p>
                    </div>
                </div>
            </div>
        </a>
    </div>

    </div>

    </div>
</div><!--end row-->




{{--
   <div class="row row-cols-1 row-cols-lg-1">
    <div class="col">
        <div id="piechart" style="width: 100%; height: 500px;"></div>

     </div> --}}


    </div><!--End Row-->



    <hr>

    <div class="row row-cols-1 row-cols-md-1 row-cols-xl-1 ">

        <div class="container my-4">
            <div class="row justify-content-center items-center">
                <div class="col-8 text-center">
                    <img src="https://www.belmasry.news/UploadCache/libfiles/3/3/600x338o/766.jpg"
                         class="img-fluid rounded shadow border"
                         style="width: 80%; height: auto;"
                         alt="Cemetery Image">
                </div>
            </div>
        </div>
    </div>




@endsection
