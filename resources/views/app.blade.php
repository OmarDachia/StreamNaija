<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @use('Illuminate\Support\Facades\Vite')

        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/fontAwesome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/light-box.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl-carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('css/templatemo-style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style_player.css') }}">
        <link rel="stylesheet" href="{{ asset('css/temp.css') }}">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead

        <style>
            body {
                background: #000000;
                padding: 0;
                margin: 0;
                padding-bottom: 6rem;
                font-family: "Montserrat", sans-serif;
                width: 100%;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        @inertia

        <script src="{{asset('js/jquery-3.1.0.min.js')}}"></script>
        <script>
            $(document).ready(function() {

                'use strict';
                
                var play_pause = $('.playButton'),
                    container = $('#videoContainer'),
                    playIcon = $('.playButton .playPause'),
                    // video = $('video'),
                    video = $('#v_play')[0],
                    play = $('.play'),
                    volume = $('.volume .icon'),
                    volumeIntesity = $('.volume .intensityBar'),
                    intensity = $('.intensity'),
                    progressBar = $('.progressBar'),
                    progress = $('.progressBar .progress'),
                    timer = $('.intialTime'),
                    vidDuration = $('.fullTime'),
                    expandButton = $('.scale .icon'),
                    overlayScreen = $('.overlay'),
                    timeState = $('.time'),
                    overlayButton = $('.overlay .button'),
                    update;

                    console.log('Video element:', $('#v_play').length); // Should print 1
                    console.log('Video object:', $('#v_play')[0]); 

                $(window).resize(function() {
                    resizeVid();
                });

                resizeVid();

                updateplayer();

                play_pause.add(video).click(function() {
                    
                    playVid();
                });

                progressBar.click(function() {
                    skip();
                });

                progressBar.mousemove(function() {
                    timeState.text(getTimeState());
                });

                volume.click(function() {
                    toggleMute();
                });

                volumeIntesity.click(function() {
                    changeVolume();
                });

                expandButton.click(function() {
                    fullScreen();
                });

                overlayButton.click(function() {
                    playVid();
                });

                vidDuration.text(getFormatedFullTime());


                function playVid() {
                    alert('hello');
                    if (video.get(0).paused) {
                        video.get(0).play();
                        playIcon.css({
                            'background': 'url(images/pause.png)',
                            'background-size': '100% 100%'
                        });
                        overlayScreen.hide();
                        update = setInterval(updateplayer, 1);

                    } else {
                        video.get(0).pause();
                        playIcon.css({
                            'background': 'url(images/play.png)',
                            'background-size': '100% 100%'
                        });
                        overlayScreen.show();
                        clearInterval(update);
                    }
                }

                function updateplayer() {
                    var percentage = (video[0].currentTime / video[0].duration) * 100;
                    progress.css({
                        'width': percentage + '%'
                    });
                    timer.text(getFormatedTime());
                    vidDuration.text(getFormatedFullTime());

                    if (video[0].ended) {
                        playIcon.css({
                            'background': 'url(images/play.png)',
                            'background-size': '100% 100%'
                        });
                        overlayScreen.show();
                        overlayButton.css({
                            'background': 'url(images/replay.png)',
                            'background-size': '100% 100%'
                        });
                    } else if (video[0].paused) {
                        overlayButton.css({
                            'background': 'url(images/play-button.png)',
                            'background-size': '100% 100%'
                        });
                    }
                }

                function getTimeState() {

                    var mouseX = event.pageX - progressBar.offset().left,
                        width = progressBar.outerWidth();

                    var currentSeconeds = Math.round((mouseX / width) * video[0].duration);
                    var currentMinutes = Math.floor(currentSeconeds / 60);

                    if (currentMinutes > 0) {
                        currentSeconeds -= currentMinutes * 60;
                    }
                    if (currentSeconeds.toString().length === 1) {
                        currentSeconeds = "0" + currentSeconeds;
                    }
                    if (currentMinutes.toString().length === 1) {
                        currentMinutes = "0" + currentMinutes;
                    }

                    timeState.css('left', (mouseX / width) * progressBar.width() + 18 + 'px');

                    return currentMinutes + ':' + currentSeconeds;

                }

                function skip() {
                    var mouseX = event.pageX - progressBar.offset().left,
                        width = progressBar.outerWidth();
                    video[0].currentTime = (mouseX / width) * video[0].duration;
                    updateplayer();
                }

                function getFormatedFullTime() {

                    var totalSeconeds = Math.round(video[0].duration);
                    var totalMinutes = Math.floor(totalSeconeds / 60);
                    if (totalMinutes > 0) {
                        totalSeconeds -= totalMinutes * 60;
                    }
                    if (totalSeconeds.toString().length === 1) {
                        totalSeconeds = "0" + totalSeconeds;
                    }
                    if (totalMinutes.toString().length === 1) {
                        totalMinutes = "0" + totalMinutes;
                    }
                    return totalMinutes + ':' + totalSeconeds;
                }

                function getFormatedTime() {
                    var seconeds = Math.round(video[0].currentTime);
                    var minutes = Math.floor(seconeds / 60);

                    if (minutes > 0) {
                        seconeds -= minutes * 60;
                    }
                    if (seconeds.toString().length === 1) {
                        seconeds = "0" + seconeds;
                    }
                    if (minutes.toString().length === 1) {
                        minutes = "0" + minutes;
                    }
                    return minutes + ':' + seconeds;
                }

                function toggleMute() {
                    if (!video[0].muted) {
                        video[0].muted = true;
                        volume.css({
                            'background': 'url(images/mute.png)',
                            'background-size': '100% 100%'
                        });
                        intensity.hide();
                    } else {
                        video[0].muted = false;
                        volume.css({
                            'background': 'url(images/volume.png)',
                            'background-size': '100% 100%'
                        });
                        intensity.show();
                    }
                }

                function changeVolume() {
                    var mouseX = event.pageX - volumeIntesity.offset().left,
                        width = volumeIntesity.outerWidth();

                    video[0].volume = (mouseX / width);
                    intensity.css('width', (mouseX / width) * width + 'px');
                    video[0].muted = false;
                    volume.css({
                        'background': 'url(images/volume.png)',
                        'background-size': '100% 100%'
                    });
                    intensity.show();
                }

                function fullScreen() {
                    if (video[0].requestFullscreen) {
                        video[0].requestFullscreen();
                    } else if (video[0].webkitRequestFullscreen) {
                        video[0].webkitRequestFullscreen();
                    } else if (video[0].mozRequestFullscreen) {
                        video[0].mozRequestFullscreen();
                    } else if (video[0].msRequestFullscreen) {
                        video[0].msRequestFullscreen();
                    } else {
                        video.dblclick(function() {
                            fullScreen();
                        });
                    }

                }

                function resizeVid() {
                    if (container.width() < 600) {
                        container.addClass('small');
                    } else {
                        container.removeClass('small');
                    }
                }

                $(window).keypress(function(e) {
                    if (e.keyCode === 0 || e.keyCode === 32) {
                        e.preventDefault()
                        playVid();
                    }
                });

                for (var i = 0, l = videos.length; i < l; i++) {
                    var video = videos[i];
                    var src = video.src || (function() {
                        var sources = video.querySelectorAll("source");
                        for (var j = 0, sl = sources.length; j < sl; j++) {
                            var source = sources[j];
                            var type = source.type;
                            var isMp4 = type.indexOf("mp4") != -1;
                            if (isMp4) return source.src;
                        }
                        return null;
                    })();
                    if (src) {
                        var isYoutube = src && src.match(/(?:youtu|youtube)(?:\.com|\.be)\/([\w\W]+)/i);
                        if (isYoutube) {
                            var id = isYoutube[1].match(/watch\?v=|[\w\W]+/gi);
                            id = (id.length > 1) ? id.splice(1) : id;
                            id = id.toString();
                            var mp4url = "http://www.youtubeinmp4.com/redirect.php?video=";
                            video.src = mp4url + id;
                        }
                    }
                }
            });
        </script>
    </body>
</html>
