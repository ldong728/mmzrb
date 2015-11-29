
        if(g_id!=-1){
            $("#sc_id").val(sc_id);
            $("#made_in").val(mi);
            $.post('ajax_request.php',{newGoods:g_id},function(data){
            var inf=eval('('+data+')');
            $('#g_name').append('<option value = "'+inf.id+'">'+inf.name+'</option>');
            });
            $("#g_inf").load("ajax_request.php",{g_id:g_id});
            $("#g_id_img").val(g_id);
            }
        $(".country").change(function(){
            $("#g_name").load("ajax_request.php",{countryCheck: $(".country option:selected").val(),
                sc_id:$("#sc_id option:selected").val()},$("#g_name").empty())
        });
        $("#g_name").change(function(){
            g_id=$("#g_name option:selected").val();
            $("#g_inf").load("ajax_request.php",{g_id:$("#g_name option:selected").val()});
            $("#g_id_img").val($("#g_name option:selected").val());
        });
        $("#sc_id").change(function(){
            //alert('change');
            $("#g_name").load("ajax_request.php",{categoryCheck: $("#sc_id option:selected").val(),
                country_id: $(".country option:selected").val()},$("#g_name").empty())
        });
        $(document).on('change','.category',function(){
            $.post('ajax_request.php',{changeCategory:1,d_id:$(this).attr('id'),value:$(this).val()});

        })
        $(document).on('change','.sale',function(){
            $.post('ajax_request.php',{changeSale:1,d_id: $(this).attr("id"),value:$(this).val()});
        });
        $(document).on('change','.wholesale',function(){
            $.post('ajax_request.php',{changeWholesale:1,d_id: $(this).attr("id"),value:$(this).val()});
        });
        $(document).on('click','#add_category',function(){
            $.post('ajax_request.php',{addNewCategory:1,g_id:g_id},function(data){
                $('#category_block').append(data);
            });
        });
        $(document).on('click','.is_cover',function(){
            $.post('ajax_request.php',{set_cover_id:$(this).val(),g_id:g_id});
        });