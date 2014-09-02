$(function(){
    /*$("#indextab span").click(function(){
        $("#indextab span").removeClass("active");
        $("#prothomchhatra_div").toggleClass("invisible");
        $("#shironam_div").toggleClass("invisible");
        $(this).toggleClass("active");
    });*/
	//$("#toolbar").mytoolbar("maincontent");
	$("#toolbar1").mytoolbar("maincontent");
	//getNumberOfViews("view_count");
	highlightLastReadArticle();
	//getCommentCount("tot_comments");
});

function getNumberOfViews(view_id){
    var article_id = getParameterByName("article_id");
    if(article_id == "")
        return;

    var d = new Date();
    $.ajax({
        cache: false,
        type: "GET",
        url: "script/get_info.php?action=get_views&article_id=" + article_id + "&t=" + d.getTime(),
        success: function(data){
            $("#" + view_id).text(data);
        }
    });
}

function highlightLastReadArticle() {
	if ($.cookie('last_read_article') !== null) {
		$(".multicolumn li a").each(function(i){
			$(this).removeClass('last_read_article');
		});
		$("#article_title_" + $.cookie('last_read_article')).addClass('last_read_article');
		$("#first_line_" + $.cookie('last_read_article')).addClass('last_read_article');
	}
}

function getParameterByName(name){
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regexS = "[\\?&]" + name + "=([^&#]*)";
    var regex = new RegExp(regexS);
    var results = regex.exec(window.location.search);
    if(results == null)
        return "";
    else
        return decodeURIComponent(results[1].replace(/\+/g, " "));
}

function getCommentCount(count_id){
    var d = new Date();
    $.ajax({
        cache: false,
        type: "GET",
        url: "script/get_info.php?action=get_comment_count&t=" + d.getTime(),
        success: function(data){
            $("#" + count_id).text(data);
        }
    });
}

function gotoPage(page_combo) {
    var page = $("#" + page_combo).val();
    if (page > -1) {
        window.location = setParameterByName(document.URL, 'p', page);
    }
}

function nextPage(page_number){
    window.location = setParameterByName(document.URL, 'p', page_number);
}

function getParameterByName(name){
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regexS = "[\\?&]" + name + "=([^&#]*)";
    var regex = new RegExp(regexS);
    var results = regex.exec(window.location.search);
    if(results == null)
        return "";
    else
        return decodeURIComponent(results[1].replace(/\+/g, " "));
}

function setParameterByName(m_str, name, val){
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regexS = "([\\?&])" + name + "=([^&#]*)";
    var regex = new RegExp(regexS);
    var results = regex.exec(m_str);
    if(results == null){
        if(m_str == '')
            return m_str + "?" + name + "=" + val;
        else
            return m_str + "&" + name + "=" + val;
    }
    else{
        return m_str.replace(regex,results[1] + name + "=" + val);
    }
}
