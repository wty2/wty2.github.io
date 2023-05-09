<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>LOVEWEB</title>
  <link href="css/main.css" rel="stylesheet" type="text/css">
  <link href="css/index.css" rel="stylesheet" type="text/css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div class="contentbox">
        <div id="title"></div>
        <div id="content"></div>
        <div id="image"></div>
    </div>
    <?php include 'pathinfo.php'; ?>
</body>

<script>
function openfile(ref){
    var file = new XMLHttpRequest();
    file.open("GET", "word/"+ref+".txt");
    file.onreadystatechange = function() {
        if (file.readyState === 4) {
            var allText = file.responseText+"</pre>";
            var content=document.getElementById("content");
            content.innerHTML = "<pre>" + allText+"</pre>";
        }
    }
    file.send(null);
}
function openimage(files){
    var image = document.getElementById("image");
    files.forEach(img => 
        image.innerHTML +="<img src='"+img+"'  alt='iamge'>" 
    )
}
window.onload=function(){
    var urltitle=window.location.pathname.split('/');
    urltitle = urltitle[2].split('.');
    //urltitle = urltitle[1].split('.');
    console.log(decodeURIComponent(urltitle[0]));
    var title=document.getElementById("title");
    var titlename = decodeURIComponent(urltitle[0]);
    title.innerHTML = titlename;
    openfile(urltitle[0]);
    var files = <?php $out = array();
        /*
        $name = iconv("UTF-8", "big5",$_SERVER['PHP_SELF']);
        //$name = iconv("utf-8", "big5", urldecode($_SERVER['PHP_SELF']));
        $name = mb_split("/",$_SERVER['PHP_SELF'])[2];
        //$name = iconv("big5","UTF-8",$_SERVER['PHP_SELF']);
        $name = mb_split(".",$name)[0];
        //echo ($name);*/ 
        $file = my_path_info($_SERVER['PHP_SELF']);
        //echo ($file["filename"]);
        foreach (glob("image/".$file["filename"]."/*") as $filename) {
            $p = my_path_info($filename);
            $out[] = $p["dirname"]."/".$p["basename"];
            //echo ($p["dirname"]."/".$p["basename"]);
        }
        echo json_encode($out); ?>;
    openimage(files);
}
</script>