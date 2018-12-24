<style>th{font-family:cairo !important;}.gallery{display: inline-block;margin-top: 20px;}</style>
<?= $map['js']; ?> 

<div class="row">
<div class="col-sm-12">
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption caption-md">
                <i class="icon-bar-chart font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase"> حرك المؤشر فى المكان الذى تريده </span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable table-scrollable-borderless">
                <?= $map['html']; ?><br>
                <?= form_open(); ?>
                <?= form_input(['name'=>'lat','class'=>'lat','type'=>'hidden'], $place['lat'] );?>
                <?= form_input(['name'=>'lang','class'=>'lang','type'=>'hidden'], $place['lang'] );?>
                <?= form_submit(['class'=>'btn green','value'=>'حفظ','name'=>'submit']); ?>
                <?= form_close(); ?> 
            </div>
        </div>
    </div>
  </div>
<div>