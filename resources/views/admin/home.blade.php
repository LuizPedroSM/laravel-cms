@extends('adminlte::page')

@section('plugins.Chartjs', true)

@section('title','Painel')

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1>DashBoard</h1>
    </div>
    <div class="col-md-6">
        <select class="custom-select">
            <option>Últimos 30 dias</option>
            <option>Últimos 60 dias</option>
        </select>
    </div>
</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$visitsCount}}</h3>
                    <p>Acessos</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-eye"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$onlineCount}}</h3>
                    <p>Usuários Online</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-heart"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$pageCount}}</h3>
                    <p>Páginas</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-sticky-note"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$userCount}}</h3>
                    <p>Usuários</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-user"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Páginas mais visitadas</h3>
                </div>
                <div class="card-body">
                    <canvas id="pagePie"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sobre o Sistema</h3>
                </div>
                <div class="card-body">
                    CMS feito em Laravel 6
                </div>
            </div>
        </div>
    </div>

<script>
window.onload = function() {
    let ctx = document.getElementById('pagePie').getContext('2d');
    window.pagePie = new Chart(ctx,{
        type:'pie',
        data:{
            datasets:[{
                data:{{$pageValues}},
                backgroundColor:['#000000','#ff0000','#ffff00','#ffffff','#0000ff','#00ffff','#00ff00','#ff00ff',]
            }],
            labels:{!!$pageLabels!!}
        },
        options:{
            responsive:true,
            legend:{
                display:false
            }
        }
    });
}
</script>
@endsection
