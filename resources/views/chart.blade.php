@extends('layouts.profile')
<script type="text/javascript" src="/assets/js/chart.min.js"></script>
<script src="assets/js/utils.js" type="a79a1cc24966ec1c96011ea5-text/javascript"></script>
<script src="assets/js/rocket-loader.min.js" data-cf-settings="a79a1cc24966ec1c96011ea5-|49" defer=""></script>
<script type="text/javascript" src="/assets/js/Chart.bundle.min"></script>
<link href="assets/css/Chart.min.css" rel="stylesheet" type="text/css">
<script>
    new Chart(document.getElementById("bar-chart"), {
        type: 'bar',
        data: {
            labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
            datasets: [
                {
                    label: "Population (millions)",
                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                    data: [2478,5267,734,784,433]
                }
            ]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Predicted world population (millions) in 2050'
            }
        }
    });
</script>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">


                    <canvas id="bar-chart" width="800" height="450"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" style="text-align: right"></div>
        <div class="col-md-6" style="text-align: left"></div>
    </div>
@endsection
