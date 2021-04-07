<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
/**
 * 
 */
class Pdf2 extends Dompdf
{
     
     function __construct()
     {
          parent::__construct();
     }
}


// require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';


// class Pdf extends TCPDF
// {
//     function __construct()
//     {
//         parent::__construct();
//     }
// }
/*Author:Tutsway.com */  
/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */

?>