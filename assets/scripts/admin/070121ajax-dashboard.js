jQuery(document).ready(function(){

    jQuery("#tour_category").select2();
    jQuery("#tour_name").select2({
        placeholder: "Select Tour",
    //multiple: true,
    });

    var expireDate = new Date();
    expireDate.setFullYear(expireDate.getFullYear() + 2);

    jQuery('.tour_datepicker').datepicker({
        format: 'dd-mm-yyyy',
        //startDate: '2016/08/19 10:00',
       // daysOfWeekDisabled: [1,2,3,4,5],
        startDate: new Date(),
        endDate: expireDate,
        todayHighlight: true,
        //showOnFocus: false, 
        //datesDisabled: ['2020-12-21'],
        autoclose: true,             
    });
   
    var slider = new Slider("#price", {
        min: 1,
        max: 100,
        step: 1,
        value:50,
        tooltip: 'always',
        tooltip_position:'bottom',
        formatter: function(value) {
            return value + ' %';
        }
    });

    var slider = new Slider("#price_d", {
        min: 1,
        max: 99,
        step: 1,
        value:50,
        tooltip: 'always',
        tooltip_position:'bottom',
        formatter: function(value) {
            return value + ' %';
        }
    });
      
      // Vertical Slider
    // var slider = new Slider("#vertical", {
    //     orientation: 'vertical',
    //     tooltip: 'always'
    // });
      
      // Range Slider
    // var slider = new Slider("#range", {
    //     min: 0,
    //     max: 100,
    //     value: [50, 80],
    //     range: true,
    //     tooltip: 'always'
    // });

    if(jQuery("#error").val()) 
    {
        var error=jQuery("#error").val();
        jGrowlAlert(error, 'danger');
    }
    if(jQuery("#success").val()) 
    {
        var success=jQuery("#success").val();
        jGrowlAlert(success, 'success');
    }

    
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

jQuery("#updateTourPrice").validate({
    //errorClass: "invalid",
    //validClass: "valid",
    rules:{
        tour_date: {
            required:true,
            minDate:true
        },
        //myRadioGroupName : {required :true}
        select_update_price_opt:"required",
        tour_category: {
            required:true
            //require_from_group: [1, ".select_group"]
        },
        'tour_name[]': {
            required:true
            //require_from_group: [1, ".select_group"]
        },
        select_price_opt:"required",
        price: {
            required:true,
            min:1
            //number:true
        }        
    },
    invalidHandler: function(form, validator) {
          
        setTimeout(function(){ $(".tour_datepicker").datepicker('hide'); }, 0);

    },
    messages: {
      // tour_type:{
      //   required:"Please Enter Tour Type",
      //   remote:"Tour type already exist"
      // }
    },
    submitHandler:function(form){

        jQuery('.load-main').removeClass('hidden');
        form.submit();  
    }
});

jQuery(document).on("change",".tour_date",function(){
    //console.log($('.tour_date').length);
    //$('.tour_date').each(function() {
        // $(this).rules("add", 
        //     {
        //         required:true,
        //         check_date_exists: true
        //     });
                //$(this).valid();
    //});    
    $(this).valid();    
});

jQuery(document).on("keydown",".tour_date",function() {

    return false;
});
jQuery(document).on("change","#tour_category_opt",function(){
    
    jQuery(".category_list").removeClass("hidden");
    jQuery(".tour_list").addClass("hidden");
    jQuery('#tour_category-error').hide(); 
    jQuery('#tour_name-error').hide();
    jQuery("#tour_category").prop("disabled", false);
});
jQuery(document).on("change","#tour_name_opt",function(){
    
    jQuery(".category_list").addClass("hidden");
    jQuery(".tour_list").removeClass("hidden");
    
    jQuery('#tour_category-error').hide(); 
    jQuery('#tour_name-error').hide();
    jQuery("#tour_name").prop("disabled", false);
});
jQuery("#tour_category").select2().change(function() {
    //console.log($("#tour_type").val());
    jQuery(this).valid();
     if($(this).val()!=""){
        jQuery("#tour_name").prop("disabled", true);
    } else {
        jQuery("#tour_name").prop("disabled", false);
    }
});

jQuery("#tour_name").select2().change(function() {
    //console.log($("#tour_type").val());
    jQuery(this).valid();
    if($(this).val()!=""){
        jQuery("#tour_category").prop("disabled", true);
    } else {
        jQuery("#tour_category").prop("disabled", false);
    }
});

jQuery("#tour_open_close").bootstrapSwitch({
  onSwitchChange: function(e, state) { 
    if(state){
        jQuery(".reset_rate").show();
        jQuery(".price_div").show();
        jQuery(".hr_line").show();
        $('input[name="select_price_opt"]').rules('add', 'required'); 
    } else {
        jQuery(".reset_rate").hide();
        jQuery(".price_div").hide();
        jQuery(".hr_line").hide();
        $('input[name="select_price_opt"]').rules('remove', 'required'); 
    }
  }
});

jQuery("#reset_tour_rate").bootstrapSwitch({
  onSwitchChange: function(e, state) { 
    if(state){
        jQuery(".open_close_tour").hide();
        jQuery(".price_div").hide();
        jQuery(".hr_line").hide();
        $('input[name="select_price_opt"]').rules('remove', 'required');
        
    } else {
        jQuery(".open_close_tour").show();
        jQuery(".price_div").show();
        jQuery(".hr_line").show();
        $('input[name="select_price_opt"]').rules('add', 'required');          
    }
  }
});

jQuery(document).on("click","#reset_tour_price",function(){
    //jQuery('#tour_date-error').hide();
    //jQuery('#select_update_price_opt-error').hide();
    //jQuery('#tour_category').select2("val", "");
    jQuery('#tour_category').val('').trigger('change');
    
    jQuery('#tour_name').val('').trigger('change');

    jQuery(".category_list").addClass("hidden");
    jQuery(".tour_list").addClass("hidden");
    //setTimeout(function(){ 
        //jQuery('#tour_category-error').hide(); 
        //jQuery('#tour_name-error').hide();
    //}, 0);
    
    
    var validator = $("#updateTourPrice").validate();
    validator.resetForm();
    jQuery('.price_option').hide();
    jQuery("#updateTourPrice")[0].reset();
    
});

jQuery(document).on("change","#increase_price_opt",function(){
    
    //jQuery(".price_lbl").html("");
    jQuery(".price_lbl").html("(Increase in %)");
    jQuery(".price_option").removeClass("hidden");
    jQuery(".increase_div").removeClass("hidden");
    jQuery(".decrease_div").addClass("hidden");

});
jQuery(document).on("change","#decrease_price_opt",function(){
    
    jQuery(".price_lbl").html("(Decrease in %)");
    jQuery(".price_option").removeClass("hidden");
    jQuery(".increase_div").addClass("hidden");
    jQuery(".decrease_div").removeClass("hidden");

});
