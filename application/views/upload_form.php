<?php echo form_open_multipart('submittest');  ?>

<p>
    <?php echo form_label('File 1', 'userfile') ?>
    <?php echo form_upload('userfile') ?>
</p>
<p>
    <?php echo form_label('File 2', 'userfile1') ?>
    <?php echo form_upload('userfile1') ?>
</p>
<p><?php echo form_submit('submit', 'Upload them files!') ?></p>

<?php echo form_close() ?>