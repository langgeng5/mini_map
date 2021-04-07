<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 *  Author      : Muhammad Surya Ihsanuddin
 *  Email       : mutofiyah@gmail.com
 *  FB          : http://facebook.com/AdenKejawen
 *  Since       : Version 1.X
 *  Copyright   : 2012@VinotiLivingGroup
 * 
 *  This code is part of Vinoti Living Group report management tool
 *  
 *  Dilarang merubah apapun tanpa sepengetahuan author
 */
require_once APPPATH.'third_party/tcpdf/tcpdf.php';
class Pdf extends TCPDF{
    public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = TRUE, $encoding = 'UTF-8', $diskcache = FALSE, $pdfa = FALSE) {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
    }
 //Page header
  public function Header() {
    $html = 'Some Header';
    $this->SetFontSize(8);
    $this->WriteHTML($html, true, 0, true, 0);
  }
 
  // Page footer
  public function Footer() {

$tahun= Date('Y');
  $bln= Date('n');
  $tgl= Date('d');

  switch($bln) {
    case "1" : $bulan="Jan"; break;
    case "2" : $bulan="Feb"; break;
    case "3" : $bulan="Mar"; break;
    case "4" : $bulan="Apr"; break;
    case "5" : $bulan="Mei"; break;
    case "6" : $bulan="Jun"; break;
    case "7" : $bulan="Jul"; break;
    case "8" : $bulan="Ags"; break;
    case "9" : $bulan="Sep"; break;
    case "10" : $bulan="Okt"; break;
    case "11" : $bulan="Nop"; break;
    case "12" : $bulan="Des"; break;
  }
    
  $tanggal=$tgl.'&nbsp;'.$bulan.'&nbsp;'.$tahun;

    // Position at 15 mm from bottom
    $this->SetY(-10);
    /*$html = '<table width="100%"><tr><td width="50%" align="left"><strong>SI KePO Provinsi Bali</strong> 
    :: hal '.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'</td>
    <td align="right"><i>Dicetak '.$tanggal.'</i></td></tr></table>';*/

     $html = '<table width="100%"><tr><td width="50%" align="left"><strong>PSB-BADEWA 2020/2021</strong> 
    :: hal '.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'</td>
    </tr></table>';
 
    $this->SetFontSize(8);
    $this->WriteHTML($html, true, 0, true, 0);
  }

}
