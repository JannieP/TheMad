<?php
class POP3Processor{
    // declare data members
    private $output='';
    private $fp;
    // constructor
    public function __construct($host,$user,$password){
        if(!$this->fp=fsockopen($host,110,$errno,$errstr,30)){
            throw new Exception('Failed to connect to POP3 server '.$errstr.$errno);
        }
        stream_set_timeout($this->fp,2);
        $this->output.=fgets($this->fp,128).'<br />';
        fputs($this->fp,"USER $user\n");// send USER command
        $this->output.=fgets($this->fp,128).'<br />';
        fputs($this->fp,"PASS $password\n");// send PASS command
        $this->output.=fgets($this->fp,128).'<br />';
        $this->output.='||||';// send delimiter string
    }
    // fetch email messages
    public function fetch(){
        fputs($this->fp,"STAT\n");// send STAT command
        $ret=fgets($this->fp,128).'<br />';
        if(substr($ret,0,5)!='-ERR '){
            $messages=intval(substr($ret,4,1));
            for($i=1;$i<=$messages;$i++){
                fputs($this->fp,"RETR $i\n"); // send RETR command
                $this->output.=stream_get_contents($this->fp).'<br /><br />';// fetch email messages
                $this->output.='||||';// send delimiter string
            }
        }
        $this->output=substr($this->output,0,strlen($this->output)-4);
        return $ret.$this->output;
    }
    // close mail server connection
    public function close(){
        fputs($this->fp,"QUIT\n");
        fclose($this->fp);
    }
}
try{
    // clean up POST data
    array_map('trim',$_POST);
    // instantiate POP3 processor object
    $popProc=new POP3Processor($_POST['host'],$_POST['user'],$_POST['pass']);
    // fetch messages from mail server
    echo $popProc->fetch();
    // close mail server connection
    $popProc->close();
}
catch(Exception $e){
    echo $e->getMessage();
    exit();
}
?>