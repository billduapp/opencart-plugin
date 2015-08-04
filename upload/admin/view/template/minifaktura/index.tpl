<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">

  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>

  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-html" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">

	<div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>

      <div class="panel-body">

		<form action="<?php echo $form_action; ?>" method="post" enctype="multipart/form-data" id="form-html" class="form-horizontal">

		  <div class="form-group">
			<label class="col-sm-2 control-label" for="input-name"><?php echo $apiKey_title; ?></label>
            <div class="col-sm-10">
              <input type="text" name="minifaktura_apiKey" value="<?php echo $apiKey; ?>" placeholder="<?php echo $apiKey_title; ?>" id="input-name" class="form-control" />
			</div>
          </div>

		  <div class="form-group">
			<label class="col-sm-2 control-label" for="input-html"><?php echo $apiSecret_title; ?></label>
			<div class="col-sm-10">
              <input type="text" name="minifaktura_apiSecret" value="<?php echo $apiSecret; ?>" placeholder="<?php echo $apiSecret_title; ?>" id="input-name" class="form-control" />
            </div>
		  </div>

			<div class="form-group">
			<label class="col-sm-2 control-label" for="input-html"><?php echo $apiDomain_title; ?></label>
			<div class="col-sm-10">
              <input type="text" name="minifaktura_apiDomain" value="<?php echo $apiDomain; ?>" placeholder="<?php echo $apiDomain_title; ?>" id="input-name" class="form-control" />
            </div>
		  </div>
		</form>

	  </div>
	</div>

  </div>
</div>
<?php echo $footer; ?>