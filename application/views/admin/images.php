<style>th{font-family:cairo !important;}.gallery{display: inline-block;margin-top: 20px;}</style>
<div class="row">
<div class="col-sm-12">
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption caption-md">
                <i class="icon-bar-chart font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase"> أرفع صور من هنا </span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable table-scrollable-borderless">
               <?= form_open_multipart(); ?>
               <?= form_upload(['name'=>'uploads[]','multiple'=>'multiple']);?><br>
               <?= form_submit(['class'=>'btn green','value'=>'حفظ','name'=>'submit']); ?>
               <?= form_close(); ?> 
        </div>
      </div><br><br><br>
      <div class="row">
      <?php if ( !empty ($images) ) { foreach ( $images as $img ) : ?>
        <div class="col-sm-6 col-md-4 divz">
            <div class="thumbnail">
            <?php $uri = $this->uri->segment('4');
            if     ( $uri == 1 ) : $path = 'halls';
			elseif ( $uri == 2 ) : $path = 'flowers';
			elseif ( $uri == 3 ) : $path = 'foods';
			elseif ( $uri == 4 ) : $path = 'photographers';
			elseif ( $uri == 5 ) : $path = 'buffets';
			elseif ( $uri == 6 ) : $path = 'decors';
			elseif ( $uri == 7 ) : $path = 'artists';
			elseif ( $uri == 6 ) : $path = 'cards';
			endif; ?>
                <img src="<?= base_url() ?>assets/uploads/<?= $path .'/'. $img->link?>" alt="صورة"> 
            </div>
            <div class="caption">
                <p> <a href="<?= base_url() ?>backend/dashboard/del_img/<?= $img->id ?>" class="btn btn-primary cls" role="button">حذف</a></p>
            </div>
        </div>
      <?php endforeach; } ?>
    </div>
    <!-- row / end -->
    </div>
  </div>
<div>

<script>
$('.cls').click(function(){
  $(this).parents('.divz').remove();
})
</script>