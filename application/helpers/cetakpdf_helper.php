<?php

function make_pdf_html($path,$data,$title="Laporan.pdf",$pl='potrait'){	
	$_CI = get_instance();
	$_CI->load->library('pdf2');
    $_CI->pdf2->setPaper('A4', $pl);

	$document=$_CI->load->view($path,$data,TRUE);
    $_CI->pdf2->filename = $title;
    $_CI->pdf2->loadHtml($document);
    $_CI->pdf2->render();
    $_CI->pdf2->stream($title , array('Attachment' => FALSE));

}

?>


