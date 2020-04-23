$(document).ready(function() {
    $("input#task_name").keypress(function(e) {
        if (e.keyCode == "13") {
            if ($(this).val() == "") {
                $("#message").html(
                    '<div class="alert alert-danger">Enter Task Name</div>'
                );
                return false;
            } else {
                var data = {
                    action: "new_task",
                    task_name: $(this).val(),
                };

                $.post("tasks.php", data, function(response) {
                    $(".list-group").prepend(response);
                    $("#active-tasks-number").html($(".incomplet").length);
                    $("input#task_name").val('');
                });
            }
        }
    });

    $(document).on("click", ".list-group-item.incomplet", function() {
        var id = $(this).data('id');
        $("#task_name").hide();
        $("#task_name_edit").show().val($(this).data('task_name')).attr('data-task_id', id);
    });

    $("#task_name_edit").keypress(function(e) {
        if (e.keyCode == "13") {
            if ($(this).val() == "") {
                $("#task_name").show();
                $("#task_name_edit").hide().val('');
                return false;
            } else {
                var data = {
                    action: "update_task",
                    task_name: $(this).val(),
                    task_id: $(this).data('task_id'),
                };

                $.post("tasks.php", data, function(response) {
                    $("#task_name").show();
                    $("#task_name_edit").hide().val('');
                    location.reload();
                });
            }
        }
    });

    $(document).on("click", ".complete-task-span", function(event) {
        event.stopPropagation();
        var task_id = $(this).parent().data("id");

        var data = {
            action: "complete_task",
            task_id: task_id,
        };

        $.post("tasks.php", data, function(response) {
            if (response) {
                $("#list-group-item-" + task_id)
                    .css("text-decoration", "line-through")
                    .removeClass("incomplet")
                    .addClass("completed");
                $("#active-tasks-number").html($(".incomplet").length);
            }
        });
    });

    $(document).on("click", ".badge", function(event) {
        event.stopPropagation();
        var task_id = $(this).data("id");

        var data = {
            action: "delete_task",
            task_id: task_id,
        };

        $.post("tasks.php", data, function(response) {
            if (response) {
                $("#list-group-item-" + task_id)
                    .removeClass("completed")
                    .removeClass("incomplet")
                    .fadeOut("slow");
                $("#active-tasks-number").html($(".incomplet").length);
            }
        });
    });

    $(document).on("click", "#clear-completed", function() {
        var task_id = $(this).data("id");

        var data = {
            action: "delete_all_task",
        };

        $.post("tasks.php", data, function(response) {
            if (response) {
                $(".list-group-item.completed").fadeOut("slow");
                $(".list-group-item").removeClass("completed");
            }
        });
    });

    $(document).on("click", "#active-task", function() {
        $(".completed").hide();
        $(".incomplet").show();
    });

    $(document).on("click", "#completed-task", function() {
        $(".completed").show();
        $(".incomplet").hide();
    });

    $(document).on("click", "#all-task", function() {
        $(".completed").show();
        $(".incomplet").show();
    });
});