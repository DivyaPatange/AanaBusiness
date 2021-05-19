<?php
    $level1 = DB::table('joiner_levels')->where('user_id', Auth::user()->id)->where('level', 1)->first();
    $level2 = DB::table('joiner_levels')->where('user_id', Auth::user()->id)->where('level', 2)->first();
    $level3 = DB::table('joiner_levels')->where('user_id', Auth::user()->id)->where('level', 3)->first();
    $level4 = DB::table('joiner_levels')->where('user_id', Auth::user()->id)->where('level', 4)->first();
    $level5 = DB::table('joiner_levels')->where('user_id', Auth::user()->id)->where('level', 5)->first();
    $level6 = DB::table('joiner_levels')->where('user_id', Auth::user()->id)->where('level', 6)->first();
    $level7 = DB::table('joiner_levels')->where('user_id', Auth::user()->id)->where('level', 7)->first();
    if(!empty($level1))
    {
        $value1 = $level1->joiner_added;
    }
    else{
        $value1 = 0;
    }
    if(!empty($level2))
    {
        $value2 = $level2->joiner_added;
    }
    else{
        $value2 = 0;
    }
    if(!empty($level3))
    {
        $value3 = $level3->joiner_added;
    }
    else{
        $value3 = 0;
    }
    if(!empty($level4))
    {
        $value4 = $level4->joiner_added;
    }
    else{
        $value4 = 0;
    }
    if(!empty($level5))
    {
        $value5 = $level5->joiner_added;
    }
    else{
        $value5 = 0;
    }
    if(!empty($level6))
    {
        $value6 = $level6->joiner_added;
    }
    else{
        $value6 = 0;
    }
    if(!empty($level7))
    {
        $value7 = $level7->joiner_added;
    }
    else{
        $value7 = 0;
    }
?>

<!--   Core JS Files   -->
<script src="{{ asset('userAsset/assets/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('userAsset/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('userAsset/assets/js/core/bootstrap.min.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ asset('userAsset/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('userAsset/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('userAsset/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>


<!-- Chart JS -->
<script src="{{ asset('userAsset/assets/js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset('userAsset/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle -->
<script src="{{ asset('userAsset/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

<!-- Datatables -->
<script src="{{ asset('userAsset/assets/js/plugin/datatables/datatables.min.js') }}"></script>

<!-- Bootstrap Notify -->
<script src="{{ asset('userAsset/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

<!-- jQuery Vector Maps -->
<script src="{{ asset('userAsset/assets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('userAsset/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ asset('userAsset/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<!-- Atlantis JS -->
<script src="{{ asset('userAsset/assets/js/atlantis.min.js') }}"></script>

<!-- Atlantis DEMO methods, don't include it in your project! -->
<!-- <script src="{{ asset('userAsset/assets/js/setting-demo.js') }}"></script> -->
<!-- <script src="{{ asset('userAsset/assets/js/demo.js') }}"></script> -->
<script>
    Circles.create({
        id:'circles-1',
        radius:45,
        value:{{ $value1 }},
        maxValue:4,
        width:7,
        text: {{ $value1 }},
        colors:['#f1f1f1', '#FF9E27'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    Circles.create({
        id:'circles-2',
        radius:45,
        value:{{ $value2 }},
        maxValue:16,
        width:7,
        text: {{ $value2 }},
        colors:['#f1f1f1', '#2BB930'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    Circles.create({
        id:'circles-3',
        radius:45,
        value:{{ $value3 }},
        maxValue:64,
        width:7,
        text: {{ $value3 }},
        colors:['#f1f1f1', '#F25961'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    Circles.create({
        id:'circles-4',
        radius:45,
        value:{{ $value4 }},
        maxValue:256,
        width:7,
        text: {{ $value4 }},
        colors:['#f1f1f1', '#48abf7'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })
    Circles.create({
        id:'circles-5',
        radius:45,
        value:{{ $value5 }},
        maxValue:1024,
        width:7,
        text: {{ $value5 }},
        colors:['#f1f1f1', '#FF9E27'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })
    Circles.create({
        id:'circles-6',
        radius:45,
        value:{{ $value6 }},
        maxValue:4096,
        width:7,
        text: {{ $value6 }},
        colors:['#f1f1f1', '#2BB930'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })
    Circles.create({
        id:'circles-7',
        radius:45,
        value:{{ $value7 }},
        maxValue:16384,
        width:7,
        text: {{ $value7 }},
        colors:['#f1f1f1', '#F25961'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

    var mytotalIncomeChart = new Chart(totalIncomeChart, {
        type: 'bar',
        data: {
            labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
            datasets : [{
                label: "Total Income",
                backgroundColor: '#ff9e27',
                borderColor: 'rgb(23, 125, 255)',
                data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            scales: {
                yAxes: [{
                    ticks: {
                        display: false //this will remove only the label
                    },
                    gridLines : {
                        drawBorder: false,
                        display : false
                    }
                }],
                xAxes : [ {
                    gridLines : {
                        drawBorder: false,
                        display : false
                    }
                }]
            },
        }
    });

    $('#lineChart').sparkline([105,103,123,100,95,105,115], {
        type: 'line',
        height: '70',
        width: '100%',
        lineWidth: '2',
        lineColor: '#ffa534',
        fillColor: 'rgba(255, 165, 52, .14)'
    });
</script>