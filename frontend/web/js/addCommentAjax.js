function getCommentsAjax(url, data) {
    $("#linkLoadComments").hide();
    $.ajax({
        type: "GET",
        url: url,
        data: {postId: data},
        success: function (response) {
            $("#comment-container").html(response);
        },
        error: function (exception) {
            alert("Something went wrong!");
        }
    });
}

function addCommentFromForm() {
    var form = $('#comment-form-id');
    var formData = form.serialize();
    addCommentAjax(form, formData);
    $("#commentform-content").val("");
}

function addCommentAjax(form, formData) {
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
            $('#title-comments').after(data);
        },
        error: function () {
            alert("Something went wrong!");
        }
    });
}