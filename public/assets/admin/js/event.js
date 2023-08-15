$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

document.addEventListener("DOMContentLoaded", () => {
    let url = window.location.href;
});

document.addEventListener("change", (e) => {});




$(document).on("click", ".delete-event", (e) => {
    showConfirmbox().then((confirmed) => {
        if (confirmed == true) {
            let id = e.target
                .closest(".delete-event")
                .getAttribute("data-event-id");
            let url = window.location.origin + `/admin/events/${id}`;
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
