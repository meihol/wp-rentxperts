(function ($) {
    const VideoStory = function ($scope, $) {
        const videos = $scope.find('.aae--video-story .thumb video');

        videos.each(function () {
            let video = $(this).get(0);
            let clicked = false;

            video.addEventListener('loadedmetadata', () => {
                const duration = video.duration;
                const minutes = Math.floor(duration / 60);
                const seconds = Math.floor(duration % 60);
                const formattedDuration = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
                const durationDiv = $(video).closest('.aae--post').find('.duration');
                durationDiv.text(formattedDuration);
            });

            $(this).hover(
                function () {
                    if (!clicked) {
                        video.play();
                    }
                },
                function () {
                    if (!clicked) {
                        video.pause();
                        video.currentTime = 0;
                    }
                }
            );

            $(this).click(function () {
                videos.each(function () {
                    let otherVideo = $(this).get(0);
                    if (otherVideo !== video) {
                        otherVideo.pause();
                        otherVideo.currentTime = 0;
                        otherVideo.muted = true;
                    }
                });

                if (!clicked) {
                    video.currentTime = 0;
                    video.play();
                }
                video.muted = false;
                $(this).attr("controls", "controls");
                clicked = true;

                $scope.find(".aae--post").removeClass("active");
                $(this).closest(".aae--post").addClass("active");
            });
        });
    };

    // Elementor Frontend Ready
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/aae--video-story.default', VideoStory);
    });

})(jQuery);
