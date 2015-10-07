function LoadImage(id, src) {
    id.src = src;
    id.onerror = null;
}

function ClipWidget(top, zoneId, version, callback) {
    this.utm = document.domain;
    if (callback == null || typeof (callback) == undefined)
        callback = "ClipRenderBox";
    this.RegisterStyleSheet = function (href) {
        var css = document.createElement("link");
        css.setAttribute('type', 'text/css');
        css.setAttribute('rel', 'stylesheet');
        css.setAttribute('href', href + "?v=" + version);
        var head = document.getElementsByTagName('head')[0];
        head.appendChild(css);
    };

    this.RegisterJavascript = function (src) {
        var jsElement = document.createElement("script");
        jsElement.setAttribute('type', 'text/javascript');
        jsElement.setAttribute('src', src);
        var head = document.getElementsByTagName('head')[0];
        head.appendChild(jsElement);
    };

    this.Onload = function () {
        this.RegisterStyleSheet("../2sao.vn/Styles/Widget.css");
        this.RegisterJavascript("http://2sao.vn/Services/JSon.ashx?callBack=" + callback + "&top=" + top);
    };

    this.OnRender = function (callback) {
        this.RegisterStyleSheet("../2sao.vn/Styles/Widget.css");
        this.RegisterJavascript("http://2sao.vn/Services/JSon.ashx?callBack=" + callback + "&top=" + top);
    };
}

function getCampaign() {
    return "?utm_source=BoxNhung_" + document.domain + "&utm_medium=BoxNhung_" + document.domain + "&utm_campaign=BoxNhung";
}

function ClipRenderBox(data, utm) {
    var html = "<div style='width:100%;float:left; background-color:#fff'><div style='width:" + (data.length * 143) + "px; margin:0 auto; padding-left:10px;' class='clipEmbed'>";
    $.each(data, function (i, e) {
        html += "<div><div class='thumbClip' style='position:relative'><a target='_blank' href='" + e.NewsURL + getCampaign() + "'><img src='" + e.News_Image + "'><span class='playIcon'></span></a></div>";
        html += "<p><a target='_blank' href='" + e.NewsURL + getCampaign() + "'>" + e.News_Title + "</a></p></div>";
    });
    html += "</div></div>";
    $('#divClip').html(html);
}

function ClipRenderBoxTTOL(data, utm) {
    var html = "<div style='width:100%;float:left; background-color:#ededed; padding-top: 3px;'><div style='width:" + (data.length * 217) + "px; margin:0 auto; padding-left:10px;' class='clipEmbed ttolclipEmbed'>";
    $.each(data, function (i, e) {
        html += "<div><div class='thumbClip ttolthumbClip' style='position:relative'><a target='_blank' href='" + e.NewsURL + getCampaign() + "' class='bdimg'><img src='" + e.news_image + "'></a></div>";
        html += "<p><a target='_blank' href='" + e.NewsURL + getCampaign() + "'>" + e.news_title + "</a></p></div>";
    });
    html += "</div></div>";
    $('#divClip').html(html);
}

function ClipRenderBoxGameSao(data, utm) {
    var html = "<div style='width:100%;float:left; background-color:#ededed; padding-top: 3px;'><div style='width:" + (data.length * 217) + "px; margin:0 auto; padding-left:10px;' class='clipEmbed ttolclipEmbed'>";
    $.each(data, function (i, e) {
        html += "<div><div class='thumbClip ttolthumbClip' style='position:relative'><a target='_blank' href='" + e.NewsURL + getCampaign() + "' class='bdimg'><img src='" + e.news_image + "'></a></div>";
        html += "<p><a target='_blank' href='" + e.NewsURL + getCampaign() + "'>" + e.news_title + "</a></p></div>";
    });
    html += "</div></div>";
    $('#divClip').html(html);
}
function ClipRenderBoxMobileTTOL(data, utm) {
    var html = "<div style='width:100%;float:left; background-color:#ededed; padding-top: 3px;margin-bottom:5px; padding-bottom:5px;'><div style='margin:0 auto;' class='mclipEmbed ttolmclipEmbed'>";
    var item = "<ul class ='mulbox'>";
    for (var i = 0; i < data.length; i++) {
        if (i==0) {
            html += "<div><div class='mthumbClip mttolthumbClip' style='position:relative'><a target='_blank' href='" + data[i].NewsURL + getCampaign() + "' class='bdimg mbdimg'><img src='" + data[i].news_image + "'></a></div> <p><a target='_blank' href='" + data[i].NewsURL + getCampaign() + "'>" + data[i].news_title + "</a></p></div>";
        } else {
            item += "<li><a target='_blank' href='" + data[i].NewsURL + getCampaign() + "'>" + data[i].news_title + "</a></li>";
        }
    }
    item += "</ul>";
    html = html + item;
    html += "</div></div>";
    $('#divClip').html(html);
}
function ClipRenderBoxHome(data) {
    var html = "";
    for (var i = 0; i < data.length; i++) {
        if (i == 0) {
            html += '<div class="vnnTitle"><a href="http://vietnamnettv.vn' + getCampaign() + '" style="color: #da0000; text-decoration: none" target="_blank">Truyền hình VietNamNet</a></div><div class="VMCIframePlayerBox"><div style="position: relative; width: 298px;"><a target="_blank" href="' + data[i].NewsURL + getCampaign() + '"><span class="playIcon" style="left:50%; margin-left:-11px"></span><img onerror="LoadImage(this,\'http://vietnamnettv.vn/GetThumbNail.ashx?ImgFilePath=' + data[i].News_Image.replace("_133.", ".").replace("http://tintuconline.com.vn/ThumbImages/", "index.html").replace("http://vietnamnettv.vn/", "http://clip.vietnamnetjsc.vn/") + '&amp;width=298\')" src="' + data[i].News_Image.replace("_133.", "_298.") + '"/></a><p><a href="' + data[i].NewsURL + getCampaign() + '" target="_blank">' + data[i].News_Title + '</a></p></div></div><div class="VMCIframeVideoListBox">';
        }
        else {
            html += '<div class="VMCIframeVideoItemBox"><a target="_blank" class="VMCIframeVideoItemText" href="' + data[i].NewsURL + getCampaign() + '"><span class="playIcon"></span><img class="VMCIframeVideoItemThumb" src="' + data[i].News_Image + '"/><span class="VMCIframeVideoItemText">' + data[i].News_Title + '</span></a></div>';
        }
    }
    html += " </div>";
    document.getElementById("VMCIframeWraper").innerHTML = html;
}
function ClipRenderBoxBottom(data) {
    var html = '<div class="boxtv"><p class="boxtv_head"><a href="http://vietnamnettv.vn/">Vietnamnet TV</a></p><div class="clearfix">';
    for (var i = 0; i < data.length; i++) {
        html += '<div class="itemtv" ' + (i == (data.length - 1) ? ' style="margin:0;" ' : '') + '><a target="_blank" href="' + data[i].NewsURL + getCampaign() + '_Bottom"><span></span><img class="bg' + i + '"  width="139px"  onerror="LoadImage(this,\'http://vietnamnettv.vn/GetThumbNail.ashx?ImgFilePath=' + data[i].News_Image.replace("_133.", ".").replace("http://tintuconline.com.vn/ThumbImages/", "index.html").replace("http://vietnamnettv.vn/", "http://clip.vietnamnetjsc.vn/") + '&amp;width=133\')"  src="' + data[i].News_Image + '"></a><h2 class="title"> <a target="_blank"  href="' + data[i].NewsURL + getCampaign() + '_Bottom">' + data[i].News_Title + '</a></h2></div>';
    }
    html += "</div></div>";
    $("#vietnamnettvId").html(html);
}
