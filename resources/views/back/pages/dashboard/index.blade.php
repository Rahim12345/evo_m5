@extends('back.layouts.master')

@section('title')
    İdarəetmə panel
@endsection

@section('css')

@endsection

@section('content')
<h1>Dashboard</h1>

<div class="card">
    <div class="card-body">
        <canvas id="visitorChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('visitorChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($visitors as $date => $count)
                    '{{ date("d M", strtotime($date)) }}',
                @endforeach
            ],
            datasets: [{
                label: 'Günlük Ziyaretçi',
                data: [
                    @foreach($visitors as $count)
                        {{ $count }},
                    @endforeach
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
@endsection

@section('js')

@endsection
