<?php 
    
if(isset($video_status)){
    $video_status = $video_status;
}else{
    $video_status = 0;
}

if($video_status == 1){
  $video_url = $video_url;
}

?>

<div class="small_video_div m-dialog d-none" id="small_video_div">
    <div class="m-0 p-0">
        <div class="full-screen-wrapper">
            <button type="button" id="modal-btn-full" class="btn modal_btn modal-btn-full">
                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="fff"
                    xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_429_11088)">
                        <path d="M4 9.00006L4 6.00006C4 4.89549 4.89543 4.00006 6 4.00006L9 4.00006"
                            stroke="#fff" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M20 15.0001V18.0001C20 19.1046 19.1046 20.0001 18 20.0001H15" stroke="#fff"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M15 4.00006L18 4.00006C19.1046 4.00006 20 4.89549 20 6.00006L20 9.00006"
                            stroke="#fff" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M9 20.0001L6 20.0001C4.89543 20.0001 4 19.1046 4 18.0001L4 15.0001"
                            stroke="#fff" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </g>
                    <defs>
                        <clipPath id="clip0_429_11088">
                            <rect width="24" height="24" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
            </button>
        </div>

<?php    

    if($video_status==1){
        $civitavecchia_video = $video_url;
        $file_url = $civitavecchia_video;
        $file = basename($civitavecchia_video);
        if (strpos($civitavecchia_video, 'youtube') > 0 || strpos($civitavecchia_video, 'youtu') > 0) {
            $file_url  = 'https://www.youtube.com/embed/'.$file;
        }
?>
        <iframe src="<?=$file_url?>?autoplay=1&loop=1&mute=1&toolbar=0&playlist=<?=$file?>" id="video_url"
            allow="autoplay"></iframe>
        <?php
    }
?>
    </div>
    
</div>

<div id="video_modal_lg" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
            <div class="modal-body">
            <?php                
                if($video_status==1){
                    $civitavecchia_video = $video_url;
                    $file_url = $civitavecchia_video;
                    $file = basename($civitavecchia_video);                            
                    if (strpos($civitavecchia_video, 'youtube') > 0 || strpos($civitavecchia_video, 'youtu') > 0) {
                        $file_url  = 'https://www.youtube.com/embed/'.$file;
                    }
            ?>
                <iframe src="<?=$file_url?>?autoplay=1&loop=1&mute=1&toolbar=0&playlist=<?=$file?>" id="video_url"
                    allow="autoplay; encrypted-media" width="100%" height="100%" frameborder="0"
                    allowfullscreen></iframe>
                <?php
                }
            ?>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var video_status = '<?php echo $video_status?>';
    if (video_status == 1) {        
        $('#small_video_div').removeClass('d-none');
    }

    $(document).on('click', '#modal-btn-full', function (event) {
        event.preventDefault();
        $('#small_video_div').addClass('d-none');
        $('#video_modal_lg').modal('show');
    });
</script>