<div>
<a href="<?php echo $this->webroot;?>admin/banners/add" class="keteranganatas gotolink areatochangebackground" data-title="Tambah Banner" data-width="400px" data-height="375px">Tambah Banner</a>
</div>

<?php 
if($this->action != 'admin_search'){
echo $this->renderElement('header_paginate'); 
}
?> 
<div class="mask1">
  <div class="actions">
    <table class="table hovered" cellpadding="0" cellspacing="0">
      <thead>
        <tr class="title_table">
          
          <th class="largest-row"><a href="#">ID</a></th>
          <th><a href="#">Banner</a></th>
          <th><a href="#">Judul</a></th>
          <th><a href="#">Aktif</a></th>
          <th><a href="#">Didaftarkan</a></th>
          <th class="actions"><a>Actions</a></th>
        </tr>
      </thead>
      <tbody id="bannertable">
        <?php 
        $no = 0;
        ?>
        <?php foreach ($listbanner as $entry) : ?>
        <?php $no++; ?>

        <tr class="altrow " id="banner_record_<?php echo $entry['Banner']['id']?>">

          <td style="color:black"><?php echo $entry['Banner']['id_pustaka']?></td>
          <td><img src="<?php echo $this->webroot.$entry['Banner']['file']?>"/ width="50"></td>
          <td style="color:black"><?php echo $entry['Banner']['title']?></td>
          <td style="color:black"><?php $aktif = $entry['Banner']['active'];
          if($aktif  == 1){
            echo 'Aktif';
          }else{
            echo "Tidak Aktif";
          }
          ?>

          </td>
          <td style="color:black"><?php echo $entry['Banner']['created']?></td>
          
          
          <td class="actions">
            <a class="gotolinkanchor" data-title="View Banner" data-width="400px" data-height="600px" href="<?php echo $this->webroot;?>admin/banners/view/<?php echo $entry['Banner']['id'];?>"><i class=" icon-new-tab on-right"></i> Lihat</a>
            
            <a class="gotolinkanchor" data-title="Edit Banner" data-width="400px" data-height="600px" href="<?php echo $this->webroot;?>admin/banners/edit/<?php echo $entry['Banner']['id'] ?>"><i class=" icon-pencil on-right"></i> Edit</a>

            <!--div>
              <?php echo $form->create('Banner',array('id'=>'bookform_do_fav_'.$entry['Banner']['id'],'action'=>'admin_do_favorite','style'=>'margin:0;'));
                echo $form->input('BookFav.id',array('type'=>'hidden','value'=>$entry['Banner']['id']));
              ?>

              <?php if($entry['Banner']['favorite'] == 0):?>

                <?php echo $form->input('BookFav.action',array('type'=>'hidden','value'=>1));?>
                <a data-entryid="<?php echo $entry['Banner']['id'];?>" id="do_fav_<?php echo $entry['Banner']['id']?>" href="#" class="nongoldehlo"><i class=" icon-star on-right"></i> Jadikan Fav</a>
              <?php else:?>
                <?php echo $form->input('BookFav.action',array('type'=>'hidden','value'=>0));?>
                <a data-entryid="<?php echo $entry['Banner']['id'];?>" id="do_fav_<?php echo $entry['Banner']['id']?>" href="#" class="nongoldehlo"><i class=" icon-star on-right"></i>  Buang dari Fav</a>
              <?php endif;?>
              <?php echo $form->end();?>

            </div-->

            <a class="deleteitemtable" href="<?php echo $this->webroot;?>admin/banners/delete/<?php echo $entry['Banner']['id']?>" ><i class="icon-remove on-right"></i> Hapus</a>
          </td>
        </tr>

        
        <?php endforeach;?>
        


        
      </tbody>
    </table>
    <!--div class="bottom_line1">&nbsp;</div-->
  </div>
</div>


<?php 
if($this->action != 'admin_search'){
echo $this->renderElement('paginate',array('data_scope' => 'bannerscope','data_background'=>'#c53437')); 
}
?>


<script type="text/javascript">
          

$(document).ready(function() { 

   window.entryid = 0;
    var options_bannerdofav = {

      //beforeSubmit:  showRequest,  // pre-submit callback 
      success:       showResponse_bannerdofav  // post-submit callback
    };

    $( '.nongoldehlo' ).on('click', function(){

      window.entryid = $(this).data('entryid');
      
      $.Dialog.close();
      
     
      $(".formcontainer").fadeOut();
     
      $('.loadingpagecontainer').show();
      $('#bookform_do_fav_'+window.entryid).ajaxSubmit(options_bookdofav);
      //console.log("cetak1" + window.entryid);
      

      
    });
}); 

function showResponse_bookdofav(responseText, statusText, xhr, $form)  { 
  setTimeout(function() {
    $('.loadingpagecontainer').hide();
    $(".formcontainer").show();

    $('tbody#bannertable #banner_record_'+window.entryid).html(responseText);
    //console.log("cetak2"+window.entryid);
  }, 2000);
}



</script>