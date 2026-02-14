(function ($) {
    const Post_Rating = function ($scope, $) {

        $(document).on('click', '#aae-post-rating-btn',function (event) {
            event.preventDefault();

            const postID = $scope.find("#post_id").val();
            const rating = $scope.find("input[name='rating']:checked").val();
            const reviewText = $scope.find("#review_text").val();

            if (!rating) {
                alert("Please select a rating!");
                return;
            }

            $.ajax({
                url: WCF_ADDONS_JS.ajaxUrl,
                type: "POST",
                data: {
                    action: "aaeaddon_submit_post_review_rating",
                    post_id: postID,
                    rating: rating,
                    review: reviewText,
                    nonce : WCF_ADDONS_JS._wpnonce
                },
                success: function (response) {
                    if (response.success) {
                        $scope.find("#aae-review-success-message").html("<p>" + response.data.message + "</p>");
                    } else {
                        $scope.find("#aae-review-error-message").html("<p" + response.data.message + "</p>");
                    }
                    // $('.review-list').prepend(`<li> ${reviewText} </li>`);
                }
            });
        });
    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/aae--post-rating-form.default', Post_Rating);
    });

})(jQuery);