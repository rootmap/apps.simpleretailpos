<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use Auth;
use PDO;
class ActivityController extends Controller
{


    public $suffix;
    public $dirs;
    protected $dbInstance;
/*    public $dbhost=env('DB_HOST');
    public $dbname=env('DB_DATABASE');
    public $username=env('DB_USERNAME');
    public $password=env('DB_PASSWORD');*/
    public function __construct() {
        $this->sdc = new StaticDataController();
        try{
            $this->dbInstance = new PDO("mysql:host=".env('DB_HOST').";dbname=".env('DB_DATABASE'),env('DB_USERNAME'),env('DB_PASSWORD'));
        } catch(Exception $e) {
            die("Error ".$e->getMessage());
        }
        $this->suffix = date('Ymd');
    }

    public function forceRedirectToLogin(Request $request){
        return redirect('login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function idleCheck()
    {
        if (Auth::check()) {
            return response()->json(1);
        }
        else
        {
            return response()->json(2);
        }
        
    }


    public function dbbackup(){
        $this->backup();
    }

    public function backup($tables = '*'){
        $output = "-- database backup - ".date('Y-m-d H:i:s').PHP_EOL;
        $output .= "SET NAMES utf8;".PHP_EOL;
        $output .= "SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';".PHP_EOL;
        $output .= "SET foreign_key_checks = 0;".PHP_EOL;
        $output .= "SET AUTOCOMMIT = 0;".PHP_EOL;
        $output .= "START TRANSACTION;".PHP_EOL;
       //get all table names
        if($tables == '*') {
            $tables = [];
            $query = $this->dbInstance->prepare('SHOW TABLES');
            $query->execute();
            while($row = $query->fetch(PDO::FETCH_NUM)) {
                $tables[] = $row[0];
            }
            $query->closeCursor();
        }
        else {
            $tables = is_array($tables) ? $tables : explode(',',$tables);
        }

        foreach($tables as $table) {

            $query = $this->dbInstance->prepare("SELECT * FROM `$table`");
            $query->execute();
            $output .= "DROP TABLE IF EXISTS `$table`;".PHP_EOL;

            $query2 = $this->dbInstance->prepare("SHOW CREATE TABLE `$table`");
            $query2->execute();
            $row2 = $query2->fetch(PDO::FETCH_NUM);
            $query2->closeCursor();
            $output .= PHP_EOL.$row2[1].";".PHP_EOL;

            while($row = $query->fetch(PDO::FETCH_NUM)) {
                $output .= "INSERT INTO `$table` VALUES(";
                for($j=0; $j<count($row); $j++) {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j]))
                        $output .= "'".$row[$j]."'";
                    else $output .= "''";
                    if ($j<(count($row)-1))
                        $output .= ',';
                }
                $output .= ");".PHP_EOL;
            }
        }
        $output .= PHP_EOL.PHP_EOL;

        $output .= "COMMIT;";
       //save filename

        $filename = 'db_'.env('DB_DATABASE').'_backup_'.$this->suffix.'.sql';
        $this->writeUTF8filename($filename,$output);
    }


    private function writeUTF8filename($fn,$c){  /* save as utf8 encoding */
        ini_set('max_execution_time', '0');
        //
        if (!file_exists("databasebk/")) {
            mkdir("databasebk/", 0777, true);
        }

        $f=fopen("databasebk/".$fn,"w+");
       # Now UTF-8 - Add byte order mark
        fwrite($f, pack("CCC",0xef,0xbb,0xbf));
        fwrite($f,$c);
        fclose($f);

        $this->gzCompressFile($fn);
        $this->sdc->initMail('f.bhuyian@gmail.com','Database Backup Date - '.date('d M, Y'),'Total DB Backup - Date : '.date('d M,Y')." Time - ".date('H:i:s'),
        'This is the body in plain text for non-HTML mail clients',
        "databasebk/".$fn.".gz");
        $gzfile = "databasebk/".$fn.".gz";
        $this->ftpTransferFIle($gzfile);

    }

    private function gzCompressFile($fn){ 
        $file = "databasebk/".$fn;

        // Name of the gz file we're creating
        $gzfile = "databasebk/".$fn.".gz";

        // Open the gz file (w9 is the highest compression)
        $fp = gzopen ($gzfile, 'w9');

        // Compress the file
        gzwrite ($fp, file_get_contents($file));

        // Close the gz file and we're done
        gzclose($fp);

        unlink($file);


    }

    private function ftpTransferFIle($fileTrans=''){
        $file = $fileTrans;
        $remote_file = $fileTrans;

        $ftp_server="bhuyianhost.com";
        $ftp_user_name="serverbk@bhuyianhost.com";
        $ftp_user_pass="slURUbw5CCZ]";

        // set up basic connection
        $conn_id = ftp_connect($ftp_server);

        // login with username and password
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

        // upload a file
        if (ftp_put($conn_id, $remote_file, $file, FTP_ASCII)) {

         unlink($fileTrans);   
         echo "successfully uploaded $file\n";
        } else {
         echo "There was a problem while uploading $file\n";
        }

        // close the connection
        ftp_close($conn_id);
    } 


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
