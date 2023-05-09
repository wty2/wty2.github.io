<?php include 'pathinfo.php'; ?>
<?php 
    $out = array();
    //echo iconv("UTF-8", "big5", urldecode($_SERVER['PHP_SELF']));
    //echo rawurlencode(mb_convert_encoding($_SERVER['PHP_SELF'], "big5", "utf-8"));
    foreach (glob('word/*') as $filename) {
        $p = my_path_info($filename);
        $out[] = $p["filename"];
        //$out[] = "告白警察214177";
        //echo urlencode($p["filename"]);
        //echo iconv("UTF-8", "big5",$p["filename"]); 
        //echo iconv("utf-8","big5", $p["filename"] );
        //echo iconv("big5", "UTF-8", $p["filename"]); 
        //$name = mb_split(".",$_SERVER['PHP_SELF'])[0];
        //echo ($name);
        //echo json_encode($p["filename"]);
    }
    $template = fopen("template.txt", "r");
    $size = filesize( "template.txt" );
    $filetext = fread( $template, $size );

    foreach($out as $filename){
        $filename = $filename.".php";
        $filename = mb_split("/",$filename)[1];
        echo($filename);
        //$filename = iconv("UTF-8", "big5", $filename);
        $myfile = fopen( $filename, "w") or die("Unable to open file!");
        fwrite($myfile,$filetext);
        //echo("file name: $filename");
        fclose($myfile);

    }
    fclose($template);
    fclose($list);

    echo "DONE";
?>

<?php  //實際應用中很可能是查詢資料庫取內容。  
/*
$rows = array(array("替換標題1","替換內容1"),array("替換標題2","替換內容2"));  
$filename = ".php";  
foreach($rows as $id => $val){    
    $title = $val[0];    
    $content = $val[1];    
    $pagename = "測試".$id.".html";     //對檔案名稱的編碼，避免中文檔案名稱亂碼    
    $pagename = iconv("UTF-8", "big5", $pagename)or die("Unable to open file!");          //讀模數板    
    $tmpfile = fopen($filename,"r");    
    $string = fread($tmpfile,filesize($filename));    
    $string = str_replace("{title}",$title,$string);    
    $string = str_replace("{content}",$content,$string);    
    fclose($tmpfile);    //寫新檔案    
    $newpage = fopen($pagename,"w");    
    fwrite($newpage,$string);    
    fclose($newpage);      
}  
echo "建立成功！";
*/
?>