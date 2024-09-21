
function selectCities(id){
   if(id>0){
     $("#cities").slideDown();
     $.ajax({
        url:`./ajax/cities/${id}`,
        method:"get",
        type:"json",
        success:function(response){
           $("#cities-box").html(response.data);
        }
     });
   }else{
    $("#cities").slideUp();
   }
}
