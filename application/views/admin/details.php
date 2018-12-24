<style>th{font-family:cairo !important;}</style>
<div class="row">
<div class="col-sm-6">
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption caption-md">
                <i class="icon-bar-chart font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase"> تفاصيل الطلب رقم / <?=$id?> </span>
            </div>
            <div style="float:left" class="hidden-print">
              <a class="print-anchor" onClick="window.print();">
				<div class="fbutton">
					<div>
					    <img src="<?=base_url()?>assets/grocery_crud/themes/flexigrid/css/images/print2.png" title="Print" width="30" height="30">
						<span class="">طباعة</span>
					</div>
				</div>
              </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable table-scrollable-borderless">
                <table class="table table-hover table-light">
                    <thead>
                        <tr class="uppercase">
                            <th> المسلسل</th>
                            <th>أسم الشركة</th>
                            <th> الكمية</th>
                            <th> سعر الوحدة </th>
                            <th> السعر الكامل </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $tbl = ['1'=>'halls', '2'=>'flowers', '3'=>'food_companies', '4'=>'photography', '5'=>'buffets',                 '6'=>'decors','7'=>'artists', '8'=>'invite_cards', '9'=>'flowers', '10'=>'flowers', 
                                  '11'=>'flowers','12'=>'food_companies','13'=>'food_companies', '14'=>'food_companies', '15'=>'food_companies', '16'=>'food_companies'
                                 ];
                          $link = ['1'=>'halls', '2'=>'flowers', '3'=>'foods', '4'=>'photography', '5'=>'buffets',                    '6'=>'decors','7'=>'artists', '8'=>'invite_cards', '9'=>'flowers', '10'=>'flowers', 
                                   '11'=>'flowers','12'=>'foods','13'=>'foods', '14'=>'foods', '15'=>'foods', '16'=>'foods'
                                ];     
                          foreach ( $details as $detail ) { ?>
                        <tr class="cst">
                            <td class="text-left">
                                <?=$detail->id ?>
                            </td>
                            <td class="text-left">
                                <a href="<?= base_url() ?>backend/<?=$link[$detail->category_id]?>/index/read/<?= $detail->shop_id ?>" class="primary-link">
                                    <?= get_this($tbl[$detail->category_id], ['id'=> $detail->shop_id],'name') ?>
                                </a>
                            </td>
                            <td class="text-left">
                                <?= $detail->quantity ?>
                            </td>
                            <td class="text-left">
                                <?= get_this($tbl[$detail->category_id], ['id'=> $detail->shop_id],'price') ?>
                            </td>
                            <td class="text-left" id="cst">
                                <?= $detail->quantity * get_this($tbl[$detail->category_id], ['id'=> $detail->shop_id],'price') . " KWD";?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <hr>
                <table class="table table-hover table-light">
                    <thead>
                        <tr class="uppercase">
                            <th>الاجمالى</th>
                            <th></th>
                            <th class="col-md-3" style="float: left;" id="ttl">0</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption caption-md">
                <i class="icon-bar-chart font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase"> طلبات التقديم الأخرى </span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable table-scrollable-borderless">
               <h4> <?= ($others) ? $others : 'لا يوجد'; ?> </h4>
            </div>
        </div>
    </div>
</div>


<div>
<script>
    var total = 0 ;
    $(".cst").each(function(){
            total += parseFloat($(this).find('#cst').text());
        });
        document.getElementById("ttl").innerHTML = total+" KWD";
</script>