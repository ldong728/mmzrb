
        if(g_id!=-1){
            $("#sc_id").val(sc_id);
            $("#made_in").val(mi);
            $.post('ajax_request.php',{newGoods:g_id},function(data){
            var inf=eval('('+data+')');
            $('#g_name').append('<option value = "'+inf.id+'">'+inf.name+'</option>');
            });
            //$("#g_inf").load("ajax_request.php",{g_id:g_id});
            getGInf();
            $("#g_id_img").val(g_id);
            }
        $(".country").change(function(){
            $("#g_name").load("ajax_request.php",{countryCheck: $(".country option:selected").val(),
                sc_id:$("#sc_id option:selected").val()},$("#g_name").empty())
        });
        $("#g_name").change(function(){
            g_id=$("#g_name option:selected").val();
            //$("#g_inf").load("ajax_request.php",{g_id:$("#g_name option:selected").val()});
            //$("#g_id_img").val($("#g_name option:selected").val());
            getGInf();
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

        function getGInf(){
            $('#hidden_g_id').val(g_id);
            $.post("ajax_request.php",{g_id:g_id},function(data){
               var inf=eval('('+data+')');
                $('#name').val(inf.goodsInf.name);
                um.setContent(inf.goodsInf.inf);
                $.each(inf.detail,function(k,v){
                    $('#goods_detail').empty();
                    var content='<p>规格：<input type="text" class="category" id="' + v.id+ '"value="'+ v.category+ '"/>'+
                    '售价：<input type="text" class="sale" id="' + v.id + '"value="' + v.sale + '"/>'+
                    '批发价：<input type="text" class="wholesale" id="' + v.id + '"value="' + v.wholesale+ '"/>'+
                    '<a href="consle.php?del_detail_id=' + v.id + '&g_id=' +g_id +'">删除此规格</a>'+
                    '</p>';
                   $('#goods_detail').append(content);
                });
                $.each(inf.img,function(k,v){
                    $('#goods_image').empty();
                    var isCheck=(1 == v.front_cover ? 'checked = true' : '');
                    var content='<input type="radio" name="is_cover"class="is_cover"value="' + v.id+ '"' + isCheck + '/>'
                    +'<a href="delete.php?delimg=' + v.url+ '&g_id=' +g_id+ '"><img class="demo" src= "../' + v.url + '" alt = "error" /></a>';
                    $('#goods_image').append(content);
                });
            });
        }