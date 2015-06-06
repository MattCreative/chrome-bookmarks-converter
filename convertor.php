<?php

$json = json_decode(file_get_contents('Bookmarks.txt'));

echo '<pre>';
print_r($json->roots);
echo '</pre>';

$header = '<!DOCTYPE NETSCAPE-Bookmark-file-1>
<!-- This is an automatically generated file.
     It will be read and overwritten.
     DO NOT EDIT! -->
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<TITLE>Bookmarks</TITLE>
<H1>Bookmarks</H1>
<DL><p>';

$out = fopen("export.html", "w");
writeIt($header);

if($json->roots->bookmark_bar){

	writeIt('<DT><H3 ADD_DATE="' . $json->roots->bookmark_bar->date_added . '" LAST_MODIFIED="' . $json->roots->bookmark_bar->date_modified . '" PERSONAL_TOOLBAR_FOLDER="true">Bookmarks bar</H3>');
	writeIt('<DL><p>');

	deeper($json->roots->bookmark_bar->children, 1, 10);
	
	writeIt('</DL><p>');

}

if($json->roots->other){

	writeIt('<DT><H3 ADD_DATE="' . $json->roots->other->date_added . '" LAST_MODIFIED="' . $json->roots->other->date_modified . '">Other bookmarks</H3>');
	writeIt('<DL><p>');

	deeper($json->roots->other->children, 1, 10);
	
	writeIt('</DL><p>');

}

writeIt('</DL><p>');
fclose($out);


function deeper($array, $depth = 0, $max_depth = false){
	
	if($max_depth && ($depth == $max_depth)) return;
	
	foreach($array as $node){
		if(property_exists($node, 'children')){
			writeIt('<DT><H3 ADD_DATE="' . $node->date_added . '" LAST_MODIFIED="' . $node->date_modified . '">' . $node->name . '</H3>', $depth);
			writeIt('<DL><p>', $depth);
			deeper($node->children, $depth + 1, $max_depth);
			writeIt('</DL><p>', $depth);
		}else if(property_exists($node, 'url')){
			writeIt('<DT><A HREF="' . $node->url . '" ADD_DATE="' . $node->date_added . '">' . $node->name . '</A>', $depth);
		}
	}
	
}

function writeIt($line, $depth = 0){
	global $out;
	
	$tab = "	";
	for($p=0;$p<$depth;$p++){
		$prepend .= $tab;
	}
	
	fwrite($out, $prepend . $line . PHP_EOL);
	
}



?>
