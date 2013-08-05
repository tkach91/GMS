<?php

function tag($tag = null, $page = 1)
{
    //if($tag == null) 
	//	redirect();
	
	return rawurldecode($tag);
}
	
?>