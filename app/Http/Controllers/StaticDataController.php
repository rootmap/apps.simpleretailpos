<?php

namespace App\Http\Controllers;
use App\LoginActivity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use Session;
use App\Cart;
use Auth;
use Illuminate\Http\Request;
use App\PosSetting;
use App\UserTour;
use App\InvoiceLayoutOne;
use App\InvoiceLayoutTwo;
use App\PrinterPrintSize;
use App\InvoiceEmailTeamplate;
use App\SiteSetting;
use App\Seo;
use Mpdf\Mpdf;
use Excel;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use CodeItNow\BarcodeBundle\Utils\QrCode;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//MenuPageController::loggedUser('company_prefix')

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

use Illuminate\Support\Facades\URL;

class StaticDataController extends Facade {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected static function getFacadeAccessor() {
        //what you want
        return $this;
    }

    public $AutorizeNet_LOGIN_API_ID="2a7Yx36V9W";
    public $AutorizeNet_TRANSACTION_KEY="6bS9C28V2sU753rY";

    public static function storeID() 
    {
        return Auth::user()->store_id;
    }

    public static function storeName() 
    {
        return "Simple Retail Pos";
    }

    public static function slideCheck()
    {

        $newLimit=session::get('slide')?session::get('slide'):1;
        session::put('slide',$newLimit);
        return $newLimit;
        
    }

    public static function createImageFromBase64($file_name='test.png',$path='',$data=''){ 
        $image = $data; // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = $file_name;
        \File::put($path. '/' . $imageName, base64_decode($image));
        return $file_name;
    }

    public static function UserID() 
    {
        return Auth::user()->id;
    }

    public static function urlForChangeData()
    {
        return "http://localhost/laravel/simpleretailpos/public/";
    }

    public static function userguideInit() 
    {
        $currentFullURLReplacer=self::urlForChangeData();
        $fullURL=str_replace($currentFullURLReplacer,"", URL::current());
        $chkeck=UserTour::where('user_id',self::UserID())
                        ->where('page_name',$fullURL)
                        ->count(); 

        $sttopTour=UserTour::where('user_id',self::UserID())
                        ->where('page_name',$fullURL)
                        ->where('user_tour_status',2)
                        ->count();
        $stReturn=0; 
        if($sttopTour==1)
        {
            $stReturn=0;
        }
        else
        {
            if($chkeck==0)
            {
                $stReturn=1;
            }
            else
            {
                $chkeckSND=UserTour::where('user_id',self::UserID())
                            ->where('page_name',$fullURL)
                            ->where('user_tour_status',1)
                            ->count();
                if($chkeckSND==1)
                {
                    $stReturn=1;
                }

                
            }
        }


        return $stReturn;
        
    }

    public static function useralreadyguideInit() 
    {
        $currentFullURLReplacer=self::urlForChangeData();
        $fullURL=str_replace($currentFullURLReplacer,"", URL::current());

        $chkeck=UserTour::where('user_id',self::UserID())
                        ->where('page_name',$fullURL)
                        //->where('user_tour_status',1)
                        ->count();
        $stReturn=0;
        if($chkeck==0)
        {
            $stReturn=0;
        }
        else
        {
            $chkeckSND=UserTour::where('user_id',self::UserID())
                        ->where('page_name',$fullURL)
                        ->first();
            $stReturn=$chkeckSND->user_tour_status;
        }
        
        return $stReturn;
    }


    public static function currentPageURL() 
    {
        return serialize(URL::current());
    }

    public static function dataMenuAssigned()
    {
        $dataMenuAssigned = Session()->has('dataMenuAssigned') ?  Session()->get('dataMenuAssigned') : null;
        return $dataMenuAssigned;

    }

    public static function Invlayout($store_id=0)
    {
        if(empty($store_id))
        {
            $id=self::InvoiceLayout();
            $store_id=self::storeID();
        }
        else
        {
            $id=self::InvoiceLayout($store_id);
        }
        
        if($id==1)
        {
            $tabCheck=InvoiceLayoutOne::where('store_id',$store_id)->count();
            if($tabCheck==0)
            {
                $tab=new InvoiceLayoutOne;
                $tab->store_id=$store_id;
                $tab->save();
            }
            $tabData=InvoiceLayoutOne::where('store_id',$store_id)->first();
            return $tabData;
        }
        elseif($id==2)
        {
            $tabCheck=InvoiceLayoutTwo::where('store_id',$store_id)->count();
            if($tabCheck==0)
            {
                $tab=new InvoiceLayoutTwo;
                $tab->store_id=$store_id;
                $tab->save();
            }
            $tabData=InvoiceLayoutTwo::where('store_id',$store_id)->first();
            return $tabData;
        }
    }

    public static function GenarateBarcode($text='')
    {
        $barcode = new BarcodeGenerator();
        $barcode->setText($text);
        $barcode->setType(BarcodeGenerator::Code128);
        $barcode->setScale(2);
        $barcode->setThickness(25);
        $barcode->setFontSize(10);
        $code = $barcode->generate();

        return $code;
        //echo '<img src="data:image/png;base64,'.$code.'" />';
        //die();
    }

    public static function GenarateQrcode($text='',$returnType=0)
    {
        $qrCode = new QrCode();
        $qrCode->setText($text)
               ->setSize(300)
               ->setPadding(10)
               ->setErrorCorrection('high')
               ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
               ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
               ->setLabel('Scan Qr Code')
               ->setLabelFontSize(16)
               ->setImageType(QrCode::IMAGE_TYPE_PNG);

        if(empty($returnType))
        {
           $datareturn=array('getContentType'=>$qrCode->getContentType(),'code'=>$qrCode->generate()); 
           return $datareturn;
        }
        else
        {
            return '<img src="data:'.$qrCode->getContentType().';base64,'.$qrCode->generate().'" />';
        }

        

        
        //echo '<img src="data:image/png;base64,'.$code.'" />';
        //die();
    }

    public static function DefaultPrinterPrintSize()
    {
        $store_id=Auth::user()->store_id;
        $user_id=Auth::user()->id;

        $check=PrinterPrintSize::where('store_id',$store_id)->count();
        if($check==0)
        {
            $tab=new PrinterPrintSize;
            $tab->pos_width='595';
            $tab->pos_height='842';
            $tab->thermal_width='70';
            $tab->thermal_height='130';
            $tab->barcode_width='58';
            $tab->barcode_height='160';
            $tab->store_id=$store_id;
            $tab->created_by=$user_id;
            $tab->save();
        }

        $data=PrinterPrintSize::where('store_id',$store_id)->first();
        
        return $data;

    }

    public static function log($type='',$msg='')
    {
        $user_id=Auth::user()->id;
        $user_name=Auth::user()->name;
        $store_id=Auth::user()->store_id;
        $tab=new LoginActivity;
        $tab->user_id=$user_id;
        $tab->name=$user_name;
        $tab->store_id=$store_id;
        $tab->activity=$msg;
        $tab->activity_type=$type;
        $tab->ip_address=\Request::ip();
        $tab->user_agent=\Request::server('HTTP_USER_AGENT');
        $tab->save();

        return 1;
    }

    public static function InvoiceLayout($store_id=0) 
    {
        if(empty($store_id))
        {
            $store_id=self::storeID();
            $user_id=self::UserID();
            $InvoiceLayout=1;
            $countInvoiceLayout=PosSetting::where('store_id',$store_id)->count();
            if($countInvoiceLayout>0)
            {
                
                $tab=PosSetting::select("invoice_layout")->where('store_id',$store_id)->orderBy("id","DESC")->first();
                $InvoiceLayout=$tab->invoice_layout;
            }
            elseif($countInvoiceLayout<1)
            {
                $tab=new PosSetting;
                $tab->invoice_layout="1";
                $tab->pos_item="16";
                $tab->sales_tax="3.00";
                $tab->sales_discount="5.00";
                $tab->discount_type="2";
                $tab->store_id=$store_id;
                $tab->created_by=$user_id;
                $tab->save();
                $InvoiceLayout=$tab->invoice_layout;
            }
        }
        else
        {
            $InvoiceLayout=1;
            $countInvoiceLayout=PosSetting::where('store_id',$store_id)->count();
            if($countInvoiceLayout>0)
            {
                
                $tab=PosSetting::select("invoice_layout")->where('store_id',$store_id)->orderBy("id","DESC")->first();
                $InvoiceLayout=$tab->invoice_layout;
            }
        }
        

        return $InvoiceLayout;
    }

    public static function navClass() 
    {
        $navClass="bg-purple bg-darken-1";
        $tabCount=SiteSetting::count();
        if($tabCount>0)
        {
            $tab=SiteSetting::orderBy("id","DESC")->first();
            $navClass=$tab->nav_class_name;
        }

        return $navClass;
    }


    public static function ExcelLayout($excelArray=array())
    {

        
        Excel::create($excelArray['report_name'], function($excel) use($excelArray) {

            $excel->sheet(date('d-M-Y').'_'.time(), function($sheet) use($excelArray) {
        
                $alpha = array('A','B','C','D','E','F','G','H','I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X ','Y','Z');

                $datacol=count($excelArray['data'][0]);

                $colSP=$alpha[$datacol-1]."1";


                $sheet->mergeCells('A1:'.$colSP);
                $sheet->setBorder('A1', 'thin');
                $sheet->cell('A1', function($cell) use ($excelArray) {
                    $cell->setValue($excelArray['report_title']);
                    //$cell->setBackground('#000000');
                   // $cell->setFontColor('#FFF');
                    $cell->setFontSize(16);
                    $cell->setFontWeight('bold');
                    //$cell->setBorder('solid', 'solid', 'solid', 'solid');
                    $cell->setAlignment('center');
                    $cell->setValignment('center');
                });

                $sheet->fromArray($excelArray['data']);
                //$sheet->setBorder('A1:F10', 'thin');

            });

        })->export('xlsx');


    }
    
    
    public static function PDFLayout($report_name,$table='')
    {
                $mpdf=new Mpdf;
                $mpdf->SetTitle($report_name);
                //$mpdf->SetDisplayMode('fullpage');
                //$mpdf->list_indent_first_level=0; // 1 or 0 - whether to indent the first level of a list
                // LOAD a stylesheet
                $stylesheet=file_get_contents(url('assets/css/bootstrap.min.css'));
                $stylesheet2=file_get_contents(url('assets/css/style.css'));
                $html='<table  class="col-md-12" cellpadding="10" style="width:100%;" width="100%;">
                        <tr>
                        
                <td valign="top" style="border-bottom: 5px #000 solid; color: #008000; font-size: 20px; font-weight: bold; padding-left: 0px;">
                
                '.$report_name.' : WIRELESS GEEKS WHOLESALE
                <hr style="height:5px;">

                <b>Report Genarated : '.date('Y-m-d H:i:s').'<br /><br /></b></td>
                <tr>
                </table>';
                
                $html.=$table;
                $mpdf->WriteHTML($stylesheet, 1);
                $mpdf->WriteHTML($stylesheet2, 1); // The parameter 1 tells that this is css/style only and no body/html/text
                $mpdf->WriteHTML($html, 2);
                $mpdf->Output('invoice_' . time() . '.pdf', 'I');
                exit();
    }

    public function initMail(
        $to='',
        $subject='',
        $body='',
        $AltBody='This is the body in plain text for non-HTML mail clients',
        $attachment='',
        $debug=0
    )
    {
          $mail = new PHPMailer(true);
          try {
              $mail->SMTPDebug = $debug;
              $mail->isSMTP(); 
              $mail->Host = 'mail.simpleretailpos.com';
              $mail->SMTPAuth = true;
              $mail->Username = 'automail@simpleretailpos.com';
              $mail->Password = 'automail';
              $mail->SMTPSecure = 'tls';
              $mail->Port = 587;

              $mail->setFrom('automail@simpleretailpos.com', 'Simple Retail POS');

              //$mail->addAddress($to, 'Fahad Bhuyian');
              $mail->addAddress($to);               // Name is optional
              $mail->addReplyTo('support@simpleretailpos.com', 'Reply - Simple Retail Pos');
             // $mail->addCC('cc@example.com');
             // $mail->addBCC('bcc@example.com');

              //Attachments
              if(!empty($attachment))
              {
                 $mail->addAttachment($attachment);
              }
              //$mail->addAttachment('/var/tmp/file.tar.gz');
              //$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); 

              //Content
              $mail->isHTML(true);
              $mail->Subject = $subject;
              $mail->Body    = $body;
              $mail->AltBody = $AltBody;
              $mail->send();
              return 1;
          } catch (Exception $e) {
              if($debug>0)
              {
                  return 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
              }
              else
              {
                  return 0;
              }
          }
    }
    
    public static function invoiceEmailTemplate($storeID=0,$UserID=0)
    {
        if(!empty($storeID) && !empty($UserID))
        {
            $chk=InvoiceEmailTeamplate::where('store_id',$storeID)->count();
            if($chk==0)
            {
                $tab=new InvoiceEmailTeamplate;
                $tab->store_id=$storeID;
                $tab->created_by=$UserID;
                $tab->email_time=1;
                $tab->company_name='Simple Retail POS';
                $tab->city='Starling Heights';
                $tab->address='14 Block A, New Test Road. USA';
                $tab->phone='555-555******';
                $tab->terms_title='Terms & Condition';
                $tab->terms_text='Some text here some text here some text here some text here some text here some text here some text here some text here some text here some text here some text here some text here some text here some text here.';
                $tab->save();
            }

            $editData=InvoiceEmailTeamplate::where('store_id',$storeID)->first();

            $qrCode=self::GenarateQrcode($editData->company_name." | ".$editData->phone." | ".$editData->address);
        }
        else
        {
            $chk=InvoiceEmailTeamplate::where('store_id',self::storeID())->count();
            if($chk==0)
            {
                $tab=new InvoiceEmailTeamplate;
                $tab->store_id=self::storeID();
                $tab->created_by=self::UserID();
                $tab->email_time=1;
                $tab->company_name='Simple Retail POS';
                $tab->city='Starling Heights';
                $tab->address='14 Block A, New Test Road. USA';
                $tab->phone='555-555******';
                $tab->terms_title='Terms & Condition';
                $tab->terms_text='Some text here some text here some text here some text here some text here some text here some text here some text here some text here some text here some text here some text here some text here some text here.';
                $tab->save();
            }

            $editData=InvoiceEmailTeamplate::where('store_id',self::storeID())->first();

            $qrCode=self::GenarateQrcode($editData->company_name." | ".$editData->phone." | ".$editData->address);
        }

        //dd($qrCode['code']);

        return ['editData'=>$editData,'qrCode'=>$qrCode];
    } 

    public function checkFile($fileWpath='')
    {

        if (file_exists($fileWpath)) {
            return true;
        }    
    }

}
