<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/8c8c8c8c8c.js" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- AOS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
        integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Takvimi.net</title>
</head>

<body>

    <header class="header">
        <div class="">
            <div class="">
                <div class="" style="display: flex; justify-content: space-between">
                    <div class="header__logo">
                        Takvimi.net
                    </div>

                </div>
            </div>
        </div>
    </header>

    <!-- Get Controller Data -->
    <div class="container-fluid main">
        <div class="item1" >
            <div class="main__current-time">
            </div>
            <div class="main__english-date">
            </div>
            <div class="main__hijri-date">
            </div>
        </div>
        <div
            @if ($fajr == 1) class = "item"

            @else
                class = "item1"
                 @endif>
            @if ($fajr == 1)
                <p>Upcoming Prayer</p>
                <span class="badge badge-danger">Fajr</span>
                <div class="main__remaining-time">
                </div>
                {{ $prayers->fajr }}
            @else
            <img src="{{ asset('image/halfMoon.png') }}" style="width: 70px; height: 70px; margin-bottom: 10px" alt="">
                <h1 class="badge badge-success">Fajr</h1>
                {{ $prayers->fajr }}
            @endif
        </div>
        <div
            @if ($duhr == 1) class = "item"

            @else
                class = "item1"
                 @endif>
            @if ($duhr == 1)
                <p>Upcoming Prayer</p>

                <span class="badge badge-danger">Dhuhr</span>
                <div class="main__remaining-time">

                </div>
                {{ $prayers->dhuhr }}
            @else
            <img src="{{ asset('image/sun.png') }}" style="width: 70px; height: 70px; margin-bottom: 10px" alt="">

                <h1 class="badge badge-success">Duhr</h1>

                {{ $prayers->dhuhr }}
            @endif
        </div>
        <div
            @if ($asr == 1) class = "item"

            @else
                class = "item1"
                 @endif>
            @if ($asr == 1)
                <p>Upcoming Prayer</p>

                <span class="badge badge-danger">Asr</span>
                <div class="main__remaining-time">
                </div>
                {{ $prayers->asr }}
            @else
            <img src="{{ asset('image/sun.png') }}" style="width: 70px; height: 70px; margin-bottom: 10px" alt="">

                <h1 class="badge badge-success">Asr</h1>

                {{ $prayers->asr }}
            @endif

        </div>
        <div
            @if ($maghrib == 1) class = "item"

            @else
                class = "item1"
                 @endif>
            @if ($maghrib == 1)
                <p>Upcoming Prayer</p>

                <span class="badge badge-danger">Maghrib</span>
                <div class="main__remaining-time">
                </div>
                {{ $prayers->maghrib }}
            @else
            <img src="{{ asset('image/sunset.png') }}" style="width: 70px; height: 70px; margin-bottom: 10px" alt="">

                <h1 class="badge badge-success">Maghrib</h1>

                {{ $prayers->maghrib }}
            @endif

        </div>
        <div
            @if ($isha == 1) class = "item"

            @else
                class = "item1"
                 @endif>
            @if ($isha == 1)
                <p>Upcoming Prayer</p>

                <span class="badge badge-danger">Isha</span>
                <div class="main__remaining-time">
                </div>
                {{ $prayers->isha }}
            @else
            <img src="{{ asset('image/fullMoon.png') }}" style="width: 70px; height: 70px; margin-bottom: 10px" alt="">

                <h1 class="badge badge-success">Isha</h1>

                {{ $prayers->isha }}
            @endif
        </div>
    </div>



    <!-- AOS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"
        integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Hijri Date -->
    <script src="jquery/jquery.hijri.date.js"></script>

    <!-- Custom JS -->
    <script>
        var javascriptVariable = {!! $day !!};
        console.log(javascriptVariable)

        AOS.init();

        $(function() {
            $(".main__hijri-date").hijriDate();
        });

        // Get Current Date
        var today = new Date();
        $(".main__english-date").text(today.toDateString());

        const hijriDate = new Intl.DateTimeFormat('en-TN-u-ca-islamic', {
            // day: 'numeric',
            month: 'long',
            weekday: 'long',
            year: 'numeric'
        }).format(Date.now());
        $(".main__hijri-date").text(hijriDate);

        // Get Current Time
        function updateTime() {
            var currentTime = new Date();
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
            var seconds = currentTime.getSeconds();
            var ampm = hours >= 12 ? "PM" : "AM";
            hours = hours > 12 ? hours - 12 : hours;
            hours = hours == 0 ? 12 : hours;
            var time = hours + ":" + minutes + ":" + seconds + " " + ampm;
            $(".main__current-time").text(time);
        }
        setInterval(updateTime, 1000);

        const getTimeDifference = () => {
            var targetHours = {!! $hour !!};
            var targetMinutes = {!! $min !!};
            var targetSeconds = {!! $sec !!};

            // Get the current time
            var currentTime = new Date();
            var currentHours = currentTime.getHours();
            var currentMinutes = currentTime.getMinutes();
            var currentSeconds = currentTime.getSeconds();

            // Calculate the time difference
            var hoursDifference = targetHours - currentHours;
            var minutesDifference = targetMinutes - currentMinutes;
            var secondsDifference = targetSeconds - currentSeconds;

            // If the difference is negative, add 24 hours (86400 seconds)
            if (
                hoursDifference < 0 ||
                (hoursDifference == 0 && minutesDifference < 0) ||
                (hoursDifference == 0 && minutesDifference == 0 && secondsDifference < 0)
            ) {
                hoursDifference += 24;
            }
            if (minutesDifference < 0) {
                minutesDifference += 60;
            }
            if (secondsDifference < 0) {
                secondsDifference += 60;
                minutesDifference -= 1;
            }

            let time1 = new Date(1970, 0, 1, currentHours, currentMinutes, currentSeconds);
            let time2 = new Date(1970, 0, 1, targetHours, targetMinutes, targetSeconds);
            let diff = time2 - time1;

            let diffInSeconds = diff / 1000;
            let diffInMinutes = diffInSeconds / 60;
            let diffInHours = diffInMinutes / 60;
            let hours = Math.floor(diffInHours);
            let minutes = Math.floor(diffInMinutes % 60);
            let seconds = Math.floor(diffInSeconds % 60);

            // Format the time difference as a string
            // var timeDifference =
            //     hoursDifference +
            //     ":" +
            //     minutesDifference +
            //     ":" +
            //     secondsDifference;
            var timeDifference =
                hours +
                ":" +
                minutes +
                ":" +
                seconds;
            $(".main__remaining-time").text(timeDifference);
        };

        setInterval(getTimeDifference, 1000);
    </script>
</body>

</html>
