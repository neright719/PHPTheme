$(function(){
    console.log("hoge");


$(document).on("click", ".delete_btn", function(){

    if (!confirm("削除しますか？")) {
        return false;
    }

    let self = $(this);
    
    $.ajax("?action=delete", {
        method: "POST",
        data: {
            id: self.attr("data-id"),
            csrf_token: self.attr("data-csrf_token")
        }
    }).done(function(){
        self.closest(".table_row").fadeOut(1);
    });
    return false;
});

})();
