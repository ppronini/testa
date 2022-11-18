$(function () {
    $(".clickme").on("click",function () {

        let login=$(this).data("login");
        $.post("/app/script.php",{login:login}).done(function (data) {
            let modalw = new bootstrap.Modal(document.getElementById('modallessons'));

            $("#mbody").html(data);

            modalw.show();
        })
    })

    $(".clickmelesson").on("click",function () {

        let lesson=$(this).data("lessonid");
        console.log(lesson);
        $.post("/app/script.php",{lesson:lesson}).done(function (data) {
            let modalw = new bootstrap.Modal(document.getElementById('modallessons'));
            $("#mbody").html(data);

            modalw.show();
        })
    })
})