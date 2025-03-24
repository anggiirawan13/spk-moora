@extends('layouts.frontend')

@section('content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}" rel="nofollow">beranda</a>
                <a href="#"><span></span> about me </a>
            </div>
        </div>
    </div>

    <header style="text-align: center;">
        <img src="frontend/imgs/aldi.jpg" width="170" height="170" style="border-radius: 50%;" />
        <h1>Aldi Adam Fanrian</h1>
    </header>

    <hr />

    <article style="text-align: center; max-width: 1000px; margin: 3em auto">
        <h2>Overview</h2>
        <table width="100%">
            <tr>

                    <p style="text-indent: 45px;"></p>
                    <p style="text-indent: 45px;"></p>

            </tr>
        </table>
    </article>
@endsection
