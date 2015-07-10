
<?php
$this->load->helper('form');
echo '<h1>FckEditor</h1>';
#echo "jjjj";
echo form_open();
$this->fckeditor->BasePath = base_url() . '/plugins/fckeditor/';
echo $this->fckeditor->Value        = 'This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.' ;
echo $this->fckeditor->Create() ;


#echo $this->fckeditor->Create() ;

echo form_submit(array('value'=>'submit'));
echo form_close();

?>