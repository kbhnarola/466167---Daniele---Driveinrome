$(function () {
    $('[data-toggle="popover"]').popover({
        html: true
    });
  });

jQuery('#gallery_tour_slider').owlCarousel({
    loop: true,
    items: 1,
    responsiveClass: true,
    nav: true,
    margin: 0,   
    dots:false, 
    autoplay: true,
    autoplayTimeout: 4000,
    smartSpeed: 400,
    center: true,
    autoHeight:false,
    //slideBy: 1,
    navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
    // responsive:{
    //     0:{
    //         items:1
    //     },
    //     600:{
    //         items:1
    //     },
    //     1000:{
    //         items:1
    //     }
    // }
});
jQuery('.tour_date_price_slider').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass: true,
    nav: true,  
    dots:false, 
    center: true,
    //startPosition: 6,
    slideBy: 5,
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
	expireDate.setFullYear(expireDate.getFullYear() + 1);

	if(jQuery("#tour_date_1").val()){
        jQuery('.tour_datepicker').datepicker({
            format: 'dd-mm-yyyy',
            startDate: new Date(),
            endDate: expireDate,
            todayHighlight: true,
            autoclose: true,  
            pickerPosition: 'bottom', 
            defaultDate: new Date(),  
        }).datepicker('setDate', jQuery("#tour_date_1").val());
    } else {
        jQuery('.tour_datepicker').datepicker({
            format: 'dd-mm-yyyy',
            startDate: new Date(),
            endDate: expireDate,
            todayHighlight: true,
            autoclose: true,  
            pickerPosition: 'bottom', 
            defaultDate: new Date()
        });
    }
    
    // jQuery("#tour_date").focus(function() {
    //     $("#tour_date").datepicker("hide");
    // });
    // jQuery("#tour_date").click(function() {
    //     $("#tour_date").datepicker("show");
    // });
});

$.validator.addMethod('total_person_check', function(value, element) {
      var adults=jQuery("#adults").val();
      var senior_person=jQuery("#senior_person").val();
      var kids=jQuery("#kids").val();
      var infants=jQuery("#infants").val();

      var ad_member=0;
      var sn_member=0;
      var kd_member=0;
      var inf_member=0;
        if(adults){
            ad_member=adults;
        }
        if(senior_person){
            sn_member=senior_person;
        }
        if(kids){
            kd_member=kids;
        }
        if(infants){
            inf_member=infants;
        }
        var total_person=parseInt(ad_member)+parseInt(sn_member)+parseInt(kd_member)+parseInt(inf_member);
        
        if(total_person>8){
            return false;
        } else {
            return true;
        }


}, 'You can not fill more than 8 people for the tour.');

$.validator.addMethod("minDate", function (value, element) {
        
    //var parts =value.split('-');
    var dt=jQuery("#tour_date_1").val();
    var parts =dt.split('-');
    var min = new Date();
    var inputDate = new Date(parts[2]+'-'+parts[1]+'-'+parts[0]);
    
    if(inputDate.setHours(0,0,0,0) === min.setHours(0,0,0,0)) {
        return true;
    } else if(inputDate <= min){
        return false;
    } else {
        return true;
    }  
}, "Date not valid");

jQuery("#tourAvailabilityForm").validate({
    errorElement: 'span',
	rules:{
        tour_date:{
            required:true,
            minDate:true
        },
        adults:{
            require_from_group: [1, ".select_person_group"],
            total_person_check:true
        },
        kids:{
            require_from_group: [1, ".select_person_group"],
            total_person_check:true
        },
        senior_person:{
            require_from_group: [1, ".select_person_group"],
            total_person_check:true
        },
        infants:{
            require_from_group: [1, ".select_person_group"],
            total_person_check:true
        }
    },
    messages:{
        adults :{
            require_from_group:'Please choose any of these option.'
        },
        kids :{
            require_from_group:'Please choose any of these option.'
        },
        senior_person :{
            require_from_group:'Please choose any of these option.'
        },
        infants :{
            require_from_group:'Please choose any of these option.'
        }
    },
    groups: {
        adults: "adults kids senior_person infants"
    },
    invalidHandler: function(form, validator) {
          
        // setTimeout(function(){ $(".tour_datepicker").datepicker('hide');
        // jQuery(".tour_datepicker").valid(); 
        // }, 0);

    },
    errorPlacement: function (error, element) {
        //console.log('dd', element.attr("name"))
       if (element.parent().hasClass('input-group')) {
            // error.appendTo(element.parent("div").next("div"));
             error.insertAfter( element.parent() );
        } else if (element.hasClass('select_person_group')) {
             error.appendTo("#passenger_validate_err");
        } else {
            error.insertAfter(element)
        }
    },
    submitHandler:function(form){        

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
        var tour_id=jQuery("#tour_id").val();

        jQuery.ajax({
            url:BASE_URL+'web/tours/get_tour_price',
            method:'POST',
            data:{ tour_id:tour_id },
            dataType:'JSON',
            beforeSend:function(){
                ajxLoader('show', 'body');
                $('.tour_date_price_slider').data('owl.carousel').destroy(); 
                jQuery('.tour_date_price_slider').css({"height":"5px","opacity": 0});
            },
            success:function(r){
                
                if(r.success){
                    var t_date=jQuery("#tour_date_1").val();
                    var c=t_date.split('-');
                    var c_date=c[2]+'-'+c[1]+'-'+c[0];
                    
                    
                    var date_array=[];
                    //var date_array=r.custom_date;
                    
                    var base_count=0;
                    var base_price='';
                    var item_price="";
                    var price_array=[];
                    var base_price_array=[];                    

                    jQuery('.tour_date_price_slider').owlCarousel({
                        loop:true,
                        margin:10,
                        responsiveClass: true,
                        nav: true,  
                        dots:false, 
                        center: true,
                        touchDrag  : false,
                        mouseDrag  : false,
                        slideBy: 5,
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
                   
                    var tour_base_price_ar=jQuery("#tour_base_price").val();
                    if(tour_base_price_ar){
                        tour_base_price_ar=jQuery("#tour_base_price").val().split(',');
                    }
                    

                    var adult_price_b = 0;
                    var senior_price_b = 0;
                    var kids_price_b = 0;
                    var infant_price_b = 0;

                    var ad_member=0;
                    var sn_member=0;
                    var kd_member=0;
                    var inf_member=0;

                    var total_price_b="";
                    var get_total_price_b="";

                    if(adults){
                        ad_member=adults;
                    }
                    if(senior_person){
                        sn_member=senior_person;
                    }
                    if(kids){
                        kd_member=kids;
                    }
                    if(infants){
                        inf_member=infants;
                    }
                    
                    var total_person=parseInt(ad_member)+parseInt(sn_member)+parseInt(kd_member);
                    if(atob(jQuery("#tour_type_id").val())==1){
                       if(total_person<=2){
                           total_price_b = tour_base_price_ar[0];
                        } else if(total_person<=4){
                            total_price_b = tour_base_price_ar[1];
                        } else if(total_person<=6) {
                            total_price_b = tour_base_price_ar[2];
                        } else if(total_person<=8) {
                            total_price_b = tour_base_price_ar[3];
                        } 
                        
                        if(infants>0){
                            infant_price_b=tour_base_price_ar[4];
                        } 
                        get_total_price_b=parseFloat(total_price_b)+parseFloat(infant_price_b);
                    } else if(atob(jQuery("#tour_type_id").val())==3) {
                        if(total_person<=3){
                            total_price_b = tour_base_price_ar[0];
                        } else if(total_person<=5){
                            total_price_b = tour_base_price_ar[1];
                        } else if(total_person<=8) {
                            total_price_b = tour_base_price_ar[2];
                        } 
                        
                        if(infants>0){
                            infant_price_b=tour_base_price_ar[3];
                        }
                        get_total_price_b=parseFloat(total_price_b)+parseFloat(infant_price_b);

                    } else if(atob(jQuery("#tour_type_id").val())==7) {

                        if(adults>0){
                            adult_price_b = tour_base_price_ar[0]*adults;
                        } 
                        if(senior_person>0){
                            senior_price_b=tour_base_price_ar[1]*senior_person;
                        } 
                        if(kids>0) {
                            kids_price_b=tour_base_price_ar[2]*kids;
                        } 

                        if(infants>0){
                            infant_price_b=tour_base_price_ar[3]*infants;
                        }
                        get_total_price_b=parseFloat(adult_price_b)+parseFloat(senior_price_b)+parseFloat(kids_price_b)+parseFloat(infant_price_b);

                    } else if(atob(jQuery("#tour_type_id").val())==8) {

                        var ttl_person_package_b=parseInt(total_person)+parseInt(inf_member);
                        total_price_b = tour_base_price_ar[(ttl_person_package_b-1)];
                        
                        get_total_price_b=parseFloat(total_price_b);

                    } else {
                        get_total_price_b=0;
                    }

                    
                    jQuery(".single_tour_price").removeClass( 'selectedThumb' );
                    jQuery(".single_tour_price").html('€ '+(get_total_price_b).toFixed(2));
                    
                    jQuery(".single_tour_price").css("color", "");
                    jQuery(".single_tour_date").css("color", "");
                    jQuery(".tour_calender_dates").addClass("date_hover");
                    jQuery( 'div[ data-tour-date="' + c_date + '"]' ).addClass( 'selectedThumb' );
                    var cn=jQuery('.selectedThumb').data('cnt');
                    jQuery('.tour_date_price_slider').trigger('to.owl.carousel',cn);
                    jQuery(".t_dp"+cn).css("color", "#2b7797");
                    jQuery("#last_select_date_index").val(cn);
                    jQuery(".item_d"+cn).removeClass("date_hover");
                    
                    jQuery("#tour_availability_m").val(1);
                    var v=[];
                    var pkg=[];
                    var adult_price_v = 0;
                    var senior_price_v = 0;
                    var kids_price_v = 0;
                    var infant_price_v = 0;

                    var total_price_v="";
                    var get_total_price_v="";

                    jQuery.each(r.data, function(j, item) {
                        
                        if(item.price_type==1) {
                            base_price_array.push(item.price);
                        }  
                        if(item.tour_date==c_date){
                            price_array.push(item.price);
                            if(item.tour_availability==0){
                                jQuery("#tour_availability_m").val(0);
                            } else {
                                jQuery("#tour_availability_m").val(1);
                            }
                        } 
                        
                        if(jQuery.inArray(item.tour_date, date_array) != -1) {
                               // console.log("is in array");
                        } else {
                            if(item.price_type==2){
                                if(item.tour_availability==0){
                                    item_price='<i class="fa fa-ban" aria-hidden="true"></i>';
                                    jQuery( 'div[ data-tour-date="' + item.tour_date + '"]' ).html(item_price);
                                    date_array.push(item.tour_date);
                                } else {
                                    
                                    if(atob(jQuery("#tour_type_id").val())==1){
                                        var variation_id=1;
                                        if(total_person<=2){
                                            variation_id=1;
                                        } else if(total_person<=4){
                                            variation_id=2;
                                        } else if(total_person<=6) {
                                            variation_id=3;
                                        } else if(total_person<=8) {
                                            variation_id=4;
                                        } 
                                        
                                        if(infants){
                                            if(item.variation_id==variation_id && item.variation_id!=5){
                                                
                                                v.push(item.price);
                                                
                                            }
                                        } else {
                                            if(item.variation_id==variation_id){
                                                item_price='€ '+item.price;  
                                                jQuery( 'div[ data-tour-date="' + item.tour_date + '"]' ).html(item_price);
                                                date_array.push(item.tour_date);
                                            }
                                            
                                            
                                        }
                                        if(v.length){

                                            if(item.variation_id==5){
                                                
                                                item_price='€ '+(parseFloat(v[0])+parseFloat(item.price)).toFixed(2);

                                                jQuery( 'div[ data-tour-date="' + item.tour_date + '"]' ).html(item_price);
                                                date_array.push(item.tour_date);
                                                v=[];
                                            } 
                                        }
                                    }

                                    if(atob(jQuery("#tour_type_id").val())==3){
                                        var variation_id=6;
                                        if(total_person<=3){
                                            variation_id=6;
                                        } else if(total_person<=5){
                                            variation_id=7;
                                        } else if(total_person<=8) {
                                            variation_id=8;
                                        } 
                                        
                                        if(infants){
                                            if(item.variation_id==variation_id && item.variation_id!=9){
                                                v.push(item.price);
                                            }
                                        } else {
                                            if(item.variation_id==variation_id){
                                                item_price='€ '+item.price;  
                                                jQuery( 'div[ data-tour-date="' + item.tour_date + '"]' ).html(item_price);
                                                date_array.push(item.tour_date);
                                            }                                            
                                        }
                                        if(v.length){
                                            if(item.variation_id==9){
                                                item_price='€ '+(parseFloat(v[0])+parseFloat(item.price)).toFixed(2);

                                                jQuery( 'div[ data-tour-date="' + item.tour_date + '"]' ).html(item_price);
                                                date_array.push(item.tour_date);
                                                v=[];
                                            } 
                                        }
                                    }
                                    if(atob(jQuery("#tour_type_id").val())==7){
                                       
                                        if(adults>0 && item.variation_id==10){
                                            adult_price_v = item.price*adults;
                                        } 
                                        if(senior_person>0 && item.variation_id==11){
                                            senior_price_v=item.price*senior_person;
                                        } 
                                        if(kids>0 && item.variation_id==12) {
                                            kids_price_v=item.price*kids;
                                        } 

                                        if(item.variation_id==13){
                                             if(infants>0){
                                                infant_price_v=item.price*infants;
                                             }
                                             
                                            item_price='€ '+(parseFloat(adult_price_v)+parseFloat(senior_price_v)+parseFloat(kids_price_v)+parseFloat(infant_price_v)).toFixed(2);  
                                            jQuery( 'div[ data-tour-date="' + item.tour_date + '"]' ).html(item_price);
                                            date_array.push(item.tour_date);
                                        }
                                    }
                                    if(atob(jQuery("#tour_type_id").val())==8){
                                        var ttl_person_package_v=parseInt(total_person)+parseInt(inf_member);
                                        if(ttl_person_package_v==1 && item.variation_id==14){total_price_v = item.price;
                                             pkg.push(item.price);
                                        }
                                        if(ttl_person_package_v==2 && item.variation_id==15){total_price_v = item.price;
                                             pkg.push(item.price);
                                        }
                                        if(ttl_person_package_v==3 && item.variation_id==16){total_price_v = item.price;
                                             pkg.push(item.price);
                                        }
                                        if(ttl_person_package_v==4 && item.variation_id==17){total_price_v = item.price;
                                             pkg.push(item.price);
                                        }
                                        if(ttl_person_package_v==5 && item.variation_id==18){total_price_v = item.price;
                                             pkg.push(item.price);
                                        }
                                        if(ttl_person_package_v==6 && item.variation_id==19){total_price_v = item.price;
                                             pkg.push(item.price);
                                        }
                                        if(ttl_person_package_v==7 && item.variation_id==20){total_price_v = item.price;
                                             pkg.push(item.price);
                                        }
                                        
                                        
                                        if(item.variation_id==21){
                                            if(ttl_person_package_v==8){
                                                item_price='€ '+item.price;  
                                                jQuery( 'div[ data-tour-date="' + item.tour_date + '"]' ).html(item_price);
                                                date_array.push(item.tour_date);
                                            } else {
                                                console.log(pkg);
                                                item_price='€ '+pkg[0];  
                                                jQuery( 'div[ data-tour-date="' + item.tour_date + '"]' ).html(item_price);
                                                date_array.push(item.tour_date);
                                                pkg=[];
                                            }
                                        }
                                    }
                                }
                            }                            
                        }    
                    });
                    jQuery("#base_price_value").val(base_price_array.join(','));
                    
                    var adult_price = 0;
                    var senior_price = 0;
                    var kids_price = 0;
                    var infant_price = 0;
                    
                    
                    
                    var total_price="";
                    var get_total_price="";
                    
                    if(price_array.length>0){
                        if(atob(jQuery("#tour_type_id").val())==1){
                           if(total_person<=2){
                               total_price = price_array[0];
                            } else if(total_person<=4){
                                total_price = price_array[1];
                            } else if(total_person<=6) {
                                total_price = price_array[2];
                            } else if(total_person<=8) {
                                total_price = price_array[3];
                            } 
                            
                            if(infants>0){
                                infant_price=price_array[4];
                            } 
                            get_total_price=parseFloat(total_price)+parseFloat(infant_price);
                        } else if(atob(jQuery("#tour_type_id").val())==3) {
                            if(total_person<=3){
                                total_price = price_array[0];
                            } else if(total_person<=5){
                                total_price = price_array[1];
                            } else if(total_person<=8) {
                                total_price = price_array[2];
                            } 
                            
                            if(infants>0){
                                infant_price=price_array[3];
                            }
                            get_total_price=parseFloat(total_price)+parseFloat(infant_price);

                        } else if(atob(jQuery("#tour_type_id").val())==7) {

                            if(adults>0){
                                adult_price = price_array[0]*adults;
                            } 
                            if(senior_person>0){
                                senior_price=price_array[1]*senior_person;
                            } 
                            if(kids>0) {
                                kids_price=price_array[2]*kids;
                            } 

                            if(infants>0){
                                infant_price=price_array[3]*infants;
                            }
                            get_total_price=parseFloat(adult_price)+parseFloat(senior_price)+parseFloat(kids_price)+parseFloat(infant_price);

                        } else if(atob(jQuery("#tour_type_id").val())==8) {

                            var ttl_person_package=parseInt(total_person)+parseInt(inf_member);
                            total_price = price_array[(ttl_person_package-1)];
                            
                            get_total_price=parseFloat(total_price);

                        } else {

                        }                      
                        
                    } else {
                        if(atob(jQuery("#tour_type_id").val())==1){
                            if(total_person<=2){
                               total_price = base_price_array[0];
                            } else if(total_person<=4){
                                total_price = base_price_array[1];
                            } else if(total_person<=6) {
                                total_price = base_price_array[2];
                            } else if(total_person<=8) {
                                total_price = base_price_array[3];
                            } 
                            
                            if(infants>0){
                                infant_price=base_price_array[4];
                            } 
                            get_total_price=parseFloat(total_price)+parseFloat(infant_price); 
                        } else if(atob(jQuery("#tour_type_id").val())==3) {
                            if(total_person<=3){
                                total_price = base_price_array[0];
                            } else if(total_person<=5){
                                total_price = base_price_array[1];
                            } else if(total_person<=8) {
                                total_price = base_price_array[2];
                            } 
                            
                            if(infants>0){
                                infant_price=base_price_array[3];
                            }
                            get_total_price=parseFloat(total_price)+parseFloat(infant_price);

                        } else if(atob(jQuery("#tour_type_id").val())==7) {

                            if(adults>0){
                                adult_price = base_price_array[0]*adults;
                            } 
                            if(senior_person>0){
                                senior_price=base_price_array[1]*senior_person;
                            }
                            if(kids>0) {
                                kids_price=base_price_array[2]*kids;
                            } 

                            if(infants>0){
                                infant_price=base_price_array[3]*infants;
                            }
                            get_total_price=parseFloat(adult_price)+parseFloat(senior_price)+parseFloat(kids_price)+parseFloat(infant_price);

                        } else if(atob(jQuery("#tour_type_id").val())==8) {

                            var ttl_person_package=parseInt(total_person)+parseInt(inf_member);
                            total_price = base_price_array[(ttl_person_package-1)];
                            
                            get_total_price=parseFloat(total_price);

                        } else {

                        }

                    }                    
                    
                    //jQuery("#total_price").html(' € '+ (Math.round(get_total_price)));
                    jQuery(".total_price_single_tour").html(' € '+ (get_total_price.toFixed(2)));
                    jQuery("#final_price").val((get_total_price.toFixed(2)));
                    jQuery("#selected_date").val(jQuery("#tour_date").val());
                    jQuery("#tour_notes").val(jQuery("#tour_availability_notes").val());

                    jQuery("#adult_ttl_person").val(adults);
                    jQuery("#senior_ttl_person").val(senior_person);
                    jQuery("#kids_ttl_person").val(kids);
                    jQuery("#infants_ttl_person").val(infants);
                    
                    jQuery("#total_person_m").val((parseInt(ad_member)+parseInt(sn_member)+parseInt(kd_member)+parseInt(inf_member)));
                    jQuery("#tour_id_m").val(tour_id);
                    
                    if(jQuery("#tour_availability_m").val()==0){
                        jQuery(".price_div_m").hide();
                        jQuery("#continue_tour_add").addClass('d-none');
                    } else {
                        jQuery(".price_div_m").show();
                        jQuery("#continue_tour_add").removeClass('d-none');
                    }
                    setTimeout(function() {
                        ajxLoader('hide', 'body');  
                        jQuery('.tour_date_price_slider').css({"height":"100%","opacity": 1});
                    }, 1000);
                } else {
                    ajxLoader('hide', 'body');
                    jQuery('.tour_date_price_slider').owlCarousel({
                        loop:true,
                        margin:10,
                        responsiveClass: true,
                        nav: true,  
                        dots:false, 
                        center: true,
                        //startPosition: 6,
                        slideBy: 5,
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
                    
                    jQuery('.tour_date_price_slider').css({"height":"100%","opacity": 1});
                    console.log("Something Went Wrong");
                }
            }
        });
        
        //jQuery(".tour_detail_m").html(jQuery("#tour_name").val()+' <span>'+jQuery("#tour_code").val()+'</span>');
        jQuery(".tour_detail_m").html(jQuery("#tour_name").val());
        jQuery(".tour_code_val").html(jQuery("#tour_code").val());        

        var tour_date=jQuery("#tour_date_1").val();
        var parts =tour_date.split('-');
        
        var month_names_short=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        var month_value=month_names_short[parts[1]-1]; 
        jQuery(".selected_tour_date").html(parts[0]+' '+month_value+' '+parts[2]);

        var hr_str='';
        if(atob(jQuery("#tour_type_id").val())==8){
            if(jQuery("#tour_duration").val()>1){
                hr_str="Days";
            } else {
                hr_str="Day";
            }
        } else {
            if(jQuery("#tour_duration").val()>1){
                hr_str="Hours";
            } else {
                hr_str="Hour";
            }
        }
        jQuery(".tour_duration_m").html(jQuery("#tour_duration").val()+" "+hr_str);
        
        if(jQuery("#edit_booking_detail").val()){
             jQuery("#edit_booking_detail_m").val(1);
             jQuery("#add_booking_detail_m").val('');
        } else {
             jQuery("#edit_booking_detail_m").val('');
             jQuery("#add_booking_detail_m").val(1);
        }
        jQuery("#tour_select_date_modal").modal('show'); 

    }
});
jQuery(document).on("change",".tour_date",function(){
      
      var date = $("#tour_date").val();
     
      if(date){
       var date_1= date.split('-');
       
        var suffix = "";
        if(date_1[0]==1 || date_1[0]==21 || date_1[0]==31){
            suffix = 'st';
        } else if(date_1[0]==2 || date_1[0]==22){
            suffix = 'nd';
        } else if(date_1[0]==3 || date_1[0]==23){
            suffix = 'rd';
        } else {
            suffix = 'th';
        }

        var month_names= ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        var month_value=month_names[date_1[1]-1]; 
        // var dt="";
        // if(date_1[0]<=9){
        //     dt="0"+date_1[0];
        // } else {
        //     dt=date_1[0];
        // }
        $("#tour_date_1").val($("#tour_date").val());
        $("#tour_date").val(month_value +" "+ date_1[0] + suffix +" "+ date_1[2]);
    } else {
        $("#tour_date").val('');
        $("#tour_date_1").val('');
    }
    $(this).valid();    
});

jQuery(document).on("keydown",".tour_date",function() {

    return false;
});

function get_tour_price(tour_date,cnt=0){

    var tour_id=jQuery("#tour_id").val();

    jQuery.ajax({
            url:BASE_URL+'web/tours/get_tour_price_byDate',
            method:'POST',
            data:{ tour_id:tour_id,tour_date:tour_date },
            dataType:'JSON',
            beforeSend:function(){
                ajxLoader('show', 'body');
            },
            success:function(r){
                ajxLoader('hide', 'body');
                var adults=jQuery("#adults").val();
                var kids=jQuery("#kids").val();
                var senior_person=jQuery("#senior_person").val();
                var infants=jQuery("#infants").val();

                var adult_price = 0;
                var senior_price = 0;
                var kids_price = 0;
                var infant_price = 0;

                var ad_member=0;
                var sn_member=0;
                var kd_member=0;
                var inf_member=0;

                if(adults){
                    ad_member=adults;
                }
                if(senior_person){
                    sn_member=senior_person;
                }
                if(kids){
                    kd_member=kids;
                }
                if(infants){
                    inf_member=infants;
                }
                var total_person=parseInt(ad_member)+parseInt(sn_member)+parseInt(kd_member);

                var total_price="";
                var get_total_price="";
                var last_index_dt=jQuery("#last_select_date_index").val();
                jQuery(".t_dp"+last_index_dt).css("color", "");
                jQuery(".t_dp"+cnt).css("color", "#2b7797");
                jQuery(".item_d"+last_index_dt).addClass("date_hover");
                jQuery(".item_d"+cnt).removeClass("date_hover");
                jQuery("#last_select_date_index").val(cnt);

                if(r.success){

                    var item_price="";
                    var price_array=[];
                    
                    jQuery.each(r.data, function(i, item) {
                        price_array.push(item.price);

                        if(item.tour_availability==0) {
                            jQuery("#tour_availability_m").val(0);
                        } else {
                            jQuery("#tour_availability_m").val(1);
                        }                      
                    });

                        if(atob(jQuery("#tour_type_id").val())==1){
                            if(total_person<=2){
                               total_price = price_array[0];
                            } else if(total_person<=4){
                                total_price = price_array[1];
                            } else if(total_person<=6) {
                                total_price = price_array[2];
                            } else if(total_person<=8) {
                                total_price = price_array[3];
                            } 

                            if(infants>0){
                                infant_price=price_array[4];
                            } 
                            get_total_price=parseFloat(total_price)+parseFloat(infant_price);
                        } else if(atob(jQuery("#tour_type_id").val())==3) {
                            if(total_person<=3){
                                total_price = price_array[0];
                            } else if(total_person<=5){
                                total_price = price_array[1];
                            } else if(total_person<=8) {
                                total_price = price_array[2];
                            } 
                            if(infants>0){
                                infant_price=price_array[3];
                            }
                            
                            get_total_price=parseFloat(total_price)+parseFloat(infant_price);

                        } else if(atob(jQuery("#tour_type_id").val())==7) {

                            if(adults>0){
                                adult_price = price_array[0]*adults;
                            } 
                            if(senior_person>0){
                                senior_price=price_array[1]*senior_person;
                            } 
                            if(kids>0) {
                                kids_price=price_array[2]*kids;
                            } 

                            if(infants>0){
                                infant_price=price_array[3]*infants;
                            }
                            get_total_price=parseFloat(adult_price)+parseFloat(senior_price)+parseFloat(kids_price)+parseFloat(infant_price);

                        } else if(atob(jQuery("#tour_type_id").val())==8) {

                            var ttl_person_package=parseInt(total_person)+parseInt(inf_member);
                            total_price = price_array[(ttl_person_package-1)];
                            
                            get_total_price=parseFloat(total_price);

                        } else {

                        } 
                } else {
                    jQuery("#tour_availability_m").val(1);
                        var base_price_array=jQuery("#base_price_value").val().split(',');

                        if(atob(jQuery("#tour_type_id").val())==1){
                            if(total_person<=2){
                               total_price = base_price_array[0];
                            } else if(total_person<=4){
                                total_price = base_price_array[1];
                            } else if(total_person<=6) {
                                total_price = base_price_array[2];
                            } else if(total_person<=8) {
                                total_price = base_price_array[3];
                            } 

                            if(infants>0){
                                infant_price=base_price_array[4];
                            } 
                            get_total_price=parseFloat(total_price)+parseFloat(infant_price);
                        } else if(atob(jQuery("#tour_type_id").val())==3) {
                            if(total_person<=3){
                                total_price = base_price_array[0];
                            } else if(total_person<=5){
                                total_price = base_price_array[1];
                            } else if(total_person<=8) {
                                total_price = base_price_array[2];
                            } 
                            if(infants>0){
                                infant_price=base_price_array[3];
                            }
                            get_total_price=parseFloat(total_price)+parseFloat(infant_price);

                        } else if(atob(jQuery("#tour_type_id").val())==7) {

                            if(adults>0){
                                adult_price = base_price_array[0]*adults;
                            } 
                            if(senior_person>0){
                                senior_price=base_price_array[1]*senior_person;
                            } 
                            if(kids>0) {
                                kids_price=base_price_array[2]*kids;
                            } 

                            if(infants>0){
                                infant_price=base_price_array[3]*infants;
                            }
                            get_total_price=parseFloat(adult_price)+parseFloat(senior_price)+parseFloat(kids_price)+parseFloat(infant_price);

                        } else if(atob(jQuery("#tour_type_id").val())==8) {

                            var ttl_person_package=parseInt(total_person)+parseInt(inf_member);
                            total_price = base_price_array[(ttl_person_package-1)];
                            
                            get_total_price=parseFloat(total_price);

                        } else {

                        }
                }
                
                var parts =tour_date.split('-');
                var month_names_short=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

                var month_value=month_names_short[parts[1]-1]; 
                jQuery(".selected_tour_date").html(parts[2]+' '+month_value+' '+parts[0]);
                
                //jQuery("#total_price").html(' € '+(Math.round(get_total_price)));
                jQuery(".total_price_single_tour").html(' € '+(get_total_price.toFixed(2)));
                jQuery("#final_price").val((get_total_price).toFixed(2));
                jQuery("#selected_date").val(tour_date);
                jQuery("#tour_notes").val(jQuery("#tour_availability_notes").val());
                
                jQuery("#adult_ttl_person").val(adults);
                jQuery("#senior_ttl_person").val(senior_person);
                jQuery("#kids_ttl_person").val(kids);
                jQuery("#infants_ttl_person").val(infants);
                
                jQuery("#total_person_m").val((parseInt(ad_member)+parseInt(sn_member)+parseInt(kd_member)+parseInt(inf_member)));
                jQuery("#tour_id_m").val(tour_id);
                if(jQuery("#tour_availability_m").val()==0){
                    jQuery(".price_div_m").hide();
                    jQuery("#continue_tour_add").addClass('d-none');
                } else {
                    jQuery(".price_div_m").show();
                    jQuery("#continue_tour_add").removeClass('d-none');
                }                    
            }
        });
}


// jQuery(document).on('click','.toggle_price',function(){
//     var angle_icon=jQuery(this).data('angle');
//     if(angle_icon=="right"){
//         jQuery(this).data('angle','down');
//         jQuery(this).html('<i class="fas fa-angle-down"></i>');
//         jQuery("#price_details").removeClass('d-none');
//     } else {
//         jQuery(this).data('angle','right');
//         jQuery(this).html('<i class="fas fa-angle-right"></i>');
//         jQuery("#price_details").addClass('d-none');
//     }

//   //jQuery("#price_details").toggle();
// });

jQuery("#send_me_quote").click(function(){
    jQuery("#availabilityForm").attr('action',BASE_URL+'send-me-quote');
});
jQuery("#continue_tour_add").click(function(){
 
    jQuery("#availabilityForm").attr('action',BASE_URL+'add_ticket');
});

jQuery(document).on('click',".edit_tour_date_m",function(){

    setTimeout(function() {
          jQuery("#tour_date").focus();
      }, 0);
    jQuery("#tour_select_date_modal").modal('hide');
});

jQuery(document).on('click',".edit_tour_person_m",function(){
    //jQuery("#adults").focus();
    setTimeout(function() {
          jQuery("#adults").focus().select();
      }, 0);
    jQuery("#tour_select_date_modal").modal('hide');
});
//jQuery("#kids, #senior_person, #infants").select2();

// jQuery("#adults, #kids, #senior_person, #infants").on('select2:opening select2:closing', function( event ) {
//     var $searchfield = $(this).parent().find('.select2-search__field');
//     $searchfield.prop('disabled', true);
// });

jQuery(document).ready(function() {
    //jQuery('#adults').select2({minimumResultsForSearch: -1});
    jQuery("#adults, #kids, #senior_person, #infants").select2({minimumResultsForSearch: -1});
     // ajxLoader('show', 'body');
});
// $(window).on("load", function (e) {
//     ajxLoader('hide', 'body');
// });
jQuery(document).on('click','.dt_Picker',function () {
    jQuery('input[name="tour_date"]').datepicker('show');
});

jQuery(".select_person_group").select2().change(function() {
    
    jQuery(this).valid();
    
});
