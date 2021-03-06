@extends('admin.layouts.app')
@section('title', 'Overview')
@section('css')
    <style>
        .row a {
            text-decoration: none;
        }

        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-4 col-6">
            <a href="{{ route('admin.users') }}">
                <div class="info-box">
                    <div class="row">
                        <div class="col-4">
                            <div class="info-icon">
                                <i class="fa fa-user fa-fw"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <span>用户</span>
                            <div class="info-title">{{ $info['user_count'] }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-4 col-6">
            <a href="{{ route('admin.pages') }}">
                <div class="info-box">
                    <div class="row">
                        <div class="col-4">
                            <div class="info-icon">
                                <i class="fa fa-file-text fa-fw"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <span>页面</span>
                            <div class="info-title">{{ $info['page_count'] }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-4 col-6">
            <a href="{{ route('admin.posts') }}">
                <div class="info-box">
                    <div class="row">
                        <div class="col-4">
                            <div class="info-icon">
                                <i class="fa fa-book fa-fw"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <span>文章</span>
                            <div class="info-title">{{ $info['post_count'] }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-md-3 col-sm-4 col-6">
            <a href="{{ route('admin.comments') }}">
                <div class="info-box">
                    <div class="row">
                        <div class="col-4">
                            <div class="info-icon">
                                <i class="fa fa-comments fa-fw"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <span>评论</span>
                            <div class="info-title">{{ $info['comment_count'] }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-md-3 col-sm-4 col-6">
            <a href="{{ route('admin.tags') }}">
                <div class="info-box">
                    <div class="row">
                        <div class="col-4">
                            <div class="info-icon">
                                <i class="fa fa-tags fa-fw"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <span>标签</span>
                            <div class="info-title">{{ $info['tag_count'] }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-4 col-6">
            <a href="{{ route('admin.categories') }}">
                <div class="info-box">
                    <div class="row">
                        <div class="col-4">
                            <div class="info-icon">
                                <i class="fa fa-folder fa-fw"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <span>分类</span>
                            <div class="info-title">{{ $info['category_count'] }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-4 col-6">
            <a href="{{ route('admin.images') }}">
                <div class="info-box">
                    <div class="row">
                        <div class="col-4">
                            <div class="info-icon">
                                <i class="fa fa-image fa-fw"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <span>图片</span>
                            <div class="info-title">{{ $info['image_count'] }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-4 col-6">
            <a href="{{ route('admin.ips') }}">
                <div class="info-box">
                    <div class="row">
                        <div class="col-4">
                            <div class="info-icon">
                                <i class="fa fa-internet-explorer fa-fw"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <span>IP</span>
                            <div class="info-title">{{ $info['ip_count'] }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <canvas id="postChart" height="100%"></canvas>
@endsection
@section('script')
    <script src="https://cdn.bootcss.com/Chart.js/2.6.0/Chart.min.js"></script>
    <script>
        var labels = {!! json_encode($labels) !!};
        var type = 'line';
        if (labels.length < 5){
            type = 'bar'
        }
        var config = {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    label: 'One Year Posts Summary',
                    data: {!! json_encode($data) !!},
                    backgroundColor: 'rgba(82,118,142,0.2)',
                    borderColor: 'rgba(82,118,142,1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        }
                    }]
                }
            }
        };

        var ctx = document.getElementById("postChart").getContext("2d");
        new Chart(ctx, config);
    </script>
@endsection