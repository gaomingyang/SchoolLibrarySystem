$(function(){
	 //生成删除提交form
    $("[data-method='delete']").append(function () {
        var dform = "\n"
        dform += "<form action='" + $(this).attr('href') + "' method='POST' style='display:none'>\n"
        dform += " <input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n"
        if ($(this).attr('data-token')) {
            dform += "<input type='hidden' name='_token' value='" + $(this).attr('data-token') + "'>\n"
        }
        dform += "</form>\n"
        return dform
    }).removeAttr('href').click(function(){$(this).find("form").submit(); });

});