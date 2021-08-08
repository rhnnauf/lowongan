<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ URL('assets/logo.png') }}">

    <title>Ujob</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/pricing/">

    <!-- Bootstrap core CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link href="{{ URL('css-js-frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ URL('css-js-frontend/css/pricing.css') }}" rel="stylesheet">
    <link href="{{ URL('css-js-frontend/css/navbar.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Ujob</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample04">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?= (session('menu_frontend') == 'home') ? 'active' : '';  ?>">
                    <a class="nav-link" href="{{ URL('/') }}">Home</a>
                </li>
                <li class="nav-item dropdown <?= (session('menu_frontend') == 'kategori') ? 'active' : '';  ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bidang Pekerjaan</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <?php $categorie1 = \App\Categorie::all(); ?>
                        @foreach ($categorie1 as $cat1)
                        <a class="dropdown-item" href="{{ URl('bidang-pekerjaan/'.$cat1->id) }}">{{ $cat1->deskripsi }}</a>
                        @endforeach
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-md-0">
                <div>
                    <h6 style=" color: #fff;"><span id="date_template"></span> <span id="clock_template"></span></h6>
                </div>
            </form>
        </div>
    </nav>

    @yield('content')

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ URL('css-js-frontend/js/jquery-3.5.1.min.js') }}"></script>
    <script>
        window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="{{ URL('css-js-frontend/js/bootrsap.min.js') }}"></script>
    <script src="{{ URL('css-js-frontend/js/popper.min.js') }}"></script>
    <script src="{{ URL('css-js-frontend/js/holder.min.js') }}"></script>
    <script>
        Holder.addTheme('thumb', {
            bg: '#55595c',
            fg: '#eceeef',
            text: 'Thumbnail'
        });
    </script>
    <script type="text/javascript">
        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }

        function startTime() {
            var today = new Date();
            var hr = today.getHours();
            var min = today.getMinutes();
            var sec = today.getSeconds();
            ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
            hr = (hr == 0) ? 12 : hr;
            hr = (hr > 12) ? hr - 12 : hr;
            //Add a zero in front of numbers<10
            hr = checkTime(hr);
            min = checkTime(min);
            sec = checkTime(sec);
            document.getElementById("clock_template").innerHTML = hr + ":" + min + ":" + sec + " " + ap;

            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            var curWeekDay = days[today.getDay()];
            var curDay = today.getDate();
            var curMonth = months[today.getMonth()];
            var curYear = today.getFullYear();
            var date = curWeekDay + ", " + curDay + " " + curMonth + " " + curYear + " /";
            document.getElementById("date_template").innerHTML = date;

            var time = setTimeout(function() {
                startTime()
            }, 500);
        }
        startTime();
    </script>
</body>

</html>