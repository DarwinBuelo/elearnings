
<div class="custom_modal" id="passfailmodal">
    <div class="modalbox" >
        <h4 id="title"></h4>
        <div class="modal-contents" id="passFailContent" style="width: 98%;max-height: 70vh; overflow-y : scroll;overflow-x: hidden;">
            
        </div>
        <div class="modal-footers">
            <button class="btn btn-danger" id="btnClosepassFail"> Close</button>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function () {
        // just close the modal
        jQuery('#btnClosepassFail').click(function () {
            jQuery('#passfailmodal').fadeOut();
            jQuery('#passFailContent').html('');
        });

        jQuery("[id=passfail]").click(function () {
            console.log('click');
            jQuery('#passfailmodal').fadeIn();
            //getExamDetailsPassFail
            var eid  = jQuery(this).data('id');
            var title = jQuery(this).html();
            jQuery.ajax({
                url :'process.php',
                method: 'post',
                async :false,
                data:{
                    task : 'getExamDetailsPassFail',
                    eid : eid
                },
                success : function(response){
                    jQuery('#passFailContent').html(response);
                    jQuery('#title').html(title);
                   
                    jQuery('#studentExamList').DataTable();
                    console.log(response);
                },
                error: function(){
                    console.log(response);
                }
            });
            jQuery('#studentExamList').DataTable();
        });

    });
</script>
