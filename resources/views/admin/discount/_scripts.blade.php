@push('js')
<script>

    var $fromMB= $('#from_mb');
    var $fromSeller = $('#from_seller');
    var $ttl = $('#ttl_discount');

    function calcVal() {
            var a=$fromSeller.val();
            var b=$fromMB.val();
            var num1 =!b.trim() ? 0 : $fromMB.val();
            var num2 = !a.trim() ? 0 : $fromSeller.val();
            var result = parseInt(num1) + parseInt(num2);

           if (!isNaN(result)) {
                $ttl.val(result);
            }
        }


    $fromMB.on("keydown keyup", function() {
        calcVal();
    });
    $fromSeller.on("keydown keyup", function() {
        calcVal();
    });


    var $fromMB_edit= $('#from_mb_edit');
    var $fromSeller_edit = $('#from_seller_edit');
    var $ttl_edit = $('#ttl_discount_edit');

    function calcValEdit() {
            var a=$fromSeller_edit.val();
            var b=$fromMB_edit.val();
            var num1 =!b.trim() ? 0 : $fromMB_edit.val();
            var num2 = !a.trim() ? 0 : $fromSeller_edit.val();
            var result = parseInt(num1) + parseInt(num2);

           if (!isNaN(result)) {
                $ttl_edit.val(result);
            }
        }


    $fromMB_edit.on("keydown keyup", function() {
        calcValEdit();
    });
    $fromSeller_edit.on("keydown keyup", function() {
        calcValEdit();
    });


    //checked and unchecked all
    $(document).on('click','#select_all',function(){
            if($(this).prop("checked") == true){
                var items = document.getElementsByClassName('select_item');
                for (var i = 0; i < items.length; i++) {
                    if (items[i].type == 'checkbox')
                        items[i].checked = true;
                }
            }
            else if($(this).prop("checked") == false){
                var items = document.getElementsByClassName('select_item');
                for (var i = 0; i < items.length; i++) {
                    if (items[i].type == 'checkbox')
                        items[i].checked = false;
                }
            }
        });
</script>
@endpush
