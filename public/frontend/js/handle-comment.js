// Load comments
$(document).ready(function () {
    loadComments();
});

function loadComments() {
    const blogId = $("#blog-id").val();

    $.ajax({
        url: `/blogs/${blogId}/comments`,
        method: "GET",
        success: function (comments) {
            $("#comment-list").html("");

            comments.forEach((comment) => {
                if (!comment.parent_id) {
                    appendParentComment(comment);
                }
            });

            comments.forEach((comment) => {
                if (comment.parent_id) {
                    appendChildComment(comment);
                }
            });
        },
        error: function () {
            alert("Loading comments error");
        },
    });
}

// Handle click Reply
document.addEventListener("click", function (e) {
    const replyBtn = e.target.closest(".reply-btn");
    if (!replyBtn) return;

    e.preventDefault();

    $("#parent-id").val(replyBtn.dataset.id);
    $("#comment-message").focus();
});

// Handle click btn comment
$("#submit-comment").on("click", function (e) {
    e.preventDefault();

    if (!window.isLoggedIn) {
        alert("Please login to comment post");
        resetCommentForm();
        return;
    }

    const content = $("#comment-message").val().trim();
    const blogId = $("#blog-id").val();
    const parentId = $("#parent-id").val() || null;

    if (!content) {
        alert("Comment can not be empty");
        return;
    }

    $.ajax({
        url: window.commentStoreUrl,
        method: "POST",
        data: {
            blog_id: blogId,
            parent_id: parentId,
            content: content,
        },
        success: function (res) {
            loadComments();
            resetCommentForm();
            alert(res.message);
        },
        error: function (err) {
            console.error(err.responseText);
            alert("Error, please try again");
        },
    });
});

// Function append list comments
function appendComment(data) {
    if (data.parent_id) {
        appendChildComment(data);
    } else {
        appendParentComment(data);
    }
}

function appendParentComment(data) {
    const html = `
        <li class="media" data-id="${data.id}">
            <a class="pull-left" href="#">
                <img class="media-object" src="${data.user_avatar}" alt="avatar user" width="100" height="100">
            </a>

            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>${data.user_name}</li>
                    <li><i class="fa fa-clock-o"></i>${data.created_at_time}</li>
                    <li><i class="fa fa-calendar"></i>${data.created_at_date}</li>
                </ul>

                <p>${data.content}</p>

                <button class="btn btn-primary reply-btn" data-id="${data.id}">
                    <i class="fa fa-reply"></i> Reply
                </button>
            </div>
        </li>
    `;

    $("#comment-list").prepend(html);
}

function appendChildComment(data) {
    const parent = document.querySelector(
        `li.media[data-id="${data.parent_id}"]`
    );

    if (!parent) return;

    const html = `
        <li class="media second-media" data-parent="${data.parent_id}">
            <a class="pull-left" href="#">
               <img class="media-object" src="${data.user_avatar}" alt="avatar user" width="100" height="100">
            </a>

            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>${data.user_name}</li>
                    <li><i class="fa fa-clock-o"></i>${data.created_at_time}</li>
                    <li><i class="fa fa-calendar"></i>${data.created_at_date}</li>
                </ul>

                <p>${data.content}</p>

                <button class="btn btn-primary reply-btn" data-id="${data.parent_id}">
                    <i class="fa fa-reply"></i> Reply
                </button>
            </div>
        </li>
    `;

    parent.insertAdjacentHTML("afterend", html);
}

// Function reset comment form after submit
function resetCommentForm() {
    $("#comment-message").val("");
    $("#parent-id").val("");
}
