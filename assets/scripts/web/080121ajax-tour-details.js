jQuery('.gallery_tour_slider').carousel({
  interval: 6000,
});

$('.tour_date_price_slider').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass: true,
    nav: true,  
    dots:false, 
    center: true,
    startPosition: 6,
    navText: ['<i class="fal fa-long-arrow-left"></i>', '<i class="fal fa-long-arrow-right"></i>'],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});

jQuery(document).ready(function(){

	var expireDate = new Date();
	expireDate.setFullYear(expireDate.getFullYear() + 2);

	jQuery('.tour_datepicker').datepicker({
	    format: 'dd-mm-yyyy',
	    startDate: new Date(),
	    endDate: expireDate,
	    todayHighlight: true,
	    autoclose: true,             
	});
});
$.validator.addMethod("minDate", function (value, element) {
    // new Date(-356780166)..
    var min = new Date();
    var inputDate = new Date(value);
    if(inputDate==min){
        return true;
    } else if(inputDate < min){
        return false;
    } else {
        return true;
    }
    
    
}, "Date not valid");

jQuery("#tourAvailabilityForm").validate({
	rules:{
        //ignore: [],
        tour_date:{
            required:true,
            minDate:true
        },
        adults:{
            require_from_group: [1, ".select_person_group"]
        },
        kids:{
            require_from_group: [1, ".select_person_group"]
        },
        senior_person:{
            require_from_group: [1, ".select_person_group"]
        },
        infants:{
            require_from_group: [1, ".select_person_group"]
        }
    },
    invalidHandler: function(form, validator) {
          
        setTimeout(function(){ $(".tour_datepicker").datepicker('hide');
        jQuery(".tour_datepicker").valid(); 
        }, 0);

    },
    errorPlacement: function (error, element) {
        //console.log('dd', element.attr("name"))
       if (element.parent().hasClass('input-group')) {
            // error.appendTo(element.parent("div").next("div"));
             error.insertAfter( element.parent() );
        } else if (element.hasClass('select_person_group')) {
            // error.appendTo(element.parent("div").next("div"));
             error.insertAfter( element.parent());
        } else {
            error.insertAfter(element)
        }
    },
    submitHandler:function(form){
        
        // jQuery.ajax({
        //     url:BASE_URL+'web/tours/get_tour_price',
        //     method:'POST',
        //     data:{ tour_id:jQuery("#tour_id").val(),tour_date:jQuery("#tour_date").val() },
        //     dataType:'JSON',
        //     success:function(r){
        //         var startDate = new Date();
        //         var year = d.getFullYear();
        //         var month = d.getMonth();
        //         var day = d.getDate();
        //         var endDate = new Date(year + 1, month, day);


        //         var loop = new Date();
        //         while(loop <= endDate){          

        //            var newDate = loop.setDate(loop.getDate() + 1);
        //            console.log(newDate);
        //         }
        //         if(r.success){

        //         } else {

        //         }
        //     }
        // });
        
        
        jQuery(".tour_detail_m").html(jQuery("#tour_name").val()+' <span>'+jQuery("#tour_code").val()+'</span>');
        var adults=jQuery("#adults").val();
        var kids=jQuery("#kids").val();
        var senior_person=jQuery("#senior_person").val();
        var infants=jQuery("#infants").val();
        var user_detail="";

        if(senior_person){ user_detail+= senior_person + " Senior Person ";}
        if(adults){ user_detail+= adults + " Adults ";}
        if(kids){ user_detail+= kids + " Kids ";}        
        if(infants){ user_detail+= infants + " Infants ";}

        jQuery(".user_detail").html(user_detail);

        var tour_date=jQuery("#tour_date").val();
        var parts =tour_date.split('-');
        //var month_names: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        var month_names_short=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        var month_value=month_names_short[parts[1]-1]; 
        jQuery(".selected_tour_date").html(parts[0]+' '+month_value+' '+parts[2]);

        //jQuery("#tour_date_with_price").html();
        jQuery("#tour_duration_m").html(jQuery("#tour_duration").val()+" h.");
        jQuery("#tour_select_date_modal").modal('show');            
    }
});
jQuery(document).on("change",".tour_date",function(){
      
    $(this).valid();    
});

jQuery(document).on("keydown",".tour_date",function() {

    return false;
});

// jQuery(document).on("click","#tour_select_date_modal .close",function() {
// alert("hi");
//     jQuery("#tour_select_date_modal").modal('hide'); 
// });
