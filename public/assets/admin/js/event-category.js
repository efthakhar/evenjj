$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

document.addEventListener("DOMContentLoaded", () => {
    let url = window.location.href;
});

document.addEventListener("change", (e) => {});


$(".media-window-open-btn").on("click", (e) => {
    open_media_window(false).then((media) => {
        // Object.keys(media).forEach(key => {
        //     console.log(media[key])
        // });
        if (media) {
            $("#category_thumbnail_img_container").html("");
            $("#category_thumbnail_img_container").html(
                `<div class="inserted_img">
            <input type="hidden" name="category_thumbnail" value="${media.id}">
            <img src=${media.src} />
            <span class="cross-btn p-0"> 
                ${cross_svg}
            </span>
            </div>`
            );
        }
    });
});

$(document).on("click", ".delete-category", (e) => {
    showConfirmbox().then((confirmed) => {
        if (confirmed == true) {
            let id = e.target
                .closest(".delete-category")
                .getAttribute("data-category-id");
            let url = window.location.origin + `/admin/event-categories/${id}`;
            $.ajax({
                url: url,
                type: "DELETE",
                success: function (data) {
                    e.target.closest("tr").remove();
                },
            });
        }
    });
});
