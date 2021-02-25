<?php if ($this->session->has_userdata('success')) { ?>
    <div class="alert alert-success alert-dismissable fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <?= $this->session->flashdata('success'); ?>
    </div>
<?php } ?>

<?php if ($this->session->has_userdata('error')) { ?>
    <div class="alert alert-danger alert-dismissable fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <?= strip_tags(str_replace('</p>', '', $this->session->flashdata('error'))); ?>
    </div>
<?php } ?>